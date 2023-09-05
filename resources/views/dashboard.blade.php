<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="list-book-container">
        @foreach ($books as $book)
            <div class="list-book-card">
                <div class="list-book-title">
                    <p>{{ $book->title }}</p>
                </div>
                <div class="list-book-resume">
                    <p>{{ $book->resume }}</p>
                </div>
                <div class="list-book-meta">
                    <div class="list-book-author">
                        <p>{{ $book->author->name_author }}</p>
                    </div>
                    <div class="list-book-category">
                        {{ $book->category->name_category }}
                    </div>
                    <div class="list-book-editor">
                        {{ $book->editor->name_editor }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
