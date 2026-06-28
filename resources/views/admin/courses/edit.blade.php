@extends('layouts.admin')

@section('header', 'Edit Course')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <div class="flex items-center justify-between mb-8">
        <h3 class="text-xl font-bold text-gray-900">Edit Course Details</h3>
        <a href="{{ route('admin.courses.index') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition">
            <i class="fas fa-arrow-left mr-1"></i> Back to List
        </a>
    </div>
    
    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Course Title</label>
            <input type="text" name="title" required value="{{ old('title', $course->title) }}" class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="4" class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $course->description) }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price (USD)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input type="number" name="price" step="0.01" min="0" required value="{{ old('price', $course->price) }}" class="w-full pl-7 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Number of Tools</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-tools text-gray-400"></i>
                    </div>
                    <input type="number" name="tools_count" min="0" required value="{{ old('tools_count', $course->tools_count ?? 0) }}" class="w-full pl-9 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                @error('tools_count') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-6">
            <a href="{{ route('admin.courses.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
            <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-sm font-medium text-white transition shadow-sm">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
