@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Profile</h1>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Avatar -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Avatar</label>
                    <div class="flex items-center">
                        <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-avatar.png') }}"
                             class="w-16 h-16 rounded-full mr-4">
                        <input type="file" name="avatar">
                    </div>
                </div>

                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full px-3 py-2 border rounded" required>
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full px-3 py-2 border rounded" required>
                    @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bio -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Bio</label>
                    <textarea name="bio" class="w-full px-3 py-2 border rounded" rows="3">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Update Profile
                </button>
            </form>
        </div>
    </div>
@endsection
