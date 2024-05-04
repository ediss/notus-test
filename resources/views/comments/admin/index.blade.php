@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Manage Comments</div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Content</th>
                        <th scope="col">Rating</th>
                        <th scope="col">From</th>
                        <th scope="col">Approved</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($comments as $comment)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $comment->product->name }}</td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->rating }}</td>
                            <td>{{ $comment->user ? $comment->user->name : 'guest' }}</td>
                            <td>
                                @can('approve-comment')

                                <div class="form-check form-switch">
                                    <input class="form-check-input comment-approval-switch" type="checkbox" {{ $comment->approved ? 'checked' : '' }} data-comment-id="{{ $comment->id }}">
                                </div>
                                @endcan

                            </td>
                            <td>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    @can('edit-comment')
                                        <a href="{{ route('comments.edit', $comment->id) }}"
                                            class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                    @endcan

                                    @can('delete-comment')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Do you want to delete this comment?');"><i
                                                class="bi bi-trash"></i> Delete</button>
                                    @endcan

                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-danger">
                                <strong>No Comments Found!</strong>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $comments->links() }}

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var switches = document.querySelectorAll('.comment-approval-switch');

    switches.forEach(function (element) {
        element.addEventListener('change', function () {
            var commentId = this.getAttribute('data-comment-id');
            var approved = this.checked ? 1 : 0;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('comments.approveOrUnapprove', ['comment' => ':commentId']) }}'.replace(':commentId', commentId), true);
            
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // You can handle success response here
                } else {
                    console.error(xhr.responseText);
                }
            };

            xhr.onerror = function () {
                console.error('Request failed');
            };

            xhr.send(JSON.stringify({ approved: approved }));
        });
    });
});

    </script>
@endsection
