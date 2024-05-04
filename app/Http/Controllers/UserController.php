<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Services\RoleService;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('users.index', [
            'users' => User::latest('id')->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(RoleService $service): View
    {
        return view('users.create', [
            'roles' => $service->getRoles()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->all();

        //this can be done in Model...
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);
        $user->assignRole($request->roles);

        return redirect()->route('users.index')
                ->withSuccess('User is created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, RoleService $service): View
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => $service->getRoles(),
            'userRoles' => $user->roles->pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
 
        if(!empty($request->password)){
            $data['password'] = Hash::make($request->password);
        }else{
            $data = $request->except('password');
        }
        
        $user->update($request->all());

        $user->syncRoles($request->roles);

        return redirect()->back()
                ->withSuccess('User is updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        // About if user is Super Admin or User ID belongs to Auth User
        if ($user->hasRole('Super Admin') || $user->id == auth()->user()->id)
        {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }

        $user->syncRoles([]);
        $user->delete();
        return redirect()->route('users.index')
                ->withSuccess('User is deleted successfully.');
    }
}