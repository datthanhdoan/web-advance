@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="flex items-center">
                <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-avatar.png') }}"
                     class="w-20 h-20 rounded-full mr-6">
                <div>
                    <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    @if($user->bio)
                        <p class="mt-2 text-gray-700">{{ $user->bio }}</p>
                    @endif
                </div>
            </div>
        </div>

        <h2 class="text-xl font-semibold mb-4">Bài viết</h2>
        <div class="space-y-6">
            @foreach($posts as $post)
                <div class="border-b pb-6">
                    <h3 class="text-lg font-medium">{{ $post->title }}</h3>
                    <p class="text-gray-600 mt-1">{{ Str::limit($post->content, 200) }}</p>
                    <div class="flex items-center mt-2 text-sm text-gray-500">
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                        <span class="mx-2">·</span>
                        <span>{{ $post->claps_count }} 👏</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $posts->links() }}
    </div>
@endsection
