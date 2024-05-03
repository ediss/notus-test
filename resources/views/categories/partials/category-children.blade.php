<ul>
    @foreach ($categories as $category)
        <li>{{ $category->name }}</li>
        @if ($category->children->isNotEmpty())
            @include('categories.partials.category-children', ['categories' => $category->children])
        @endif
    @endforeach
</ul>