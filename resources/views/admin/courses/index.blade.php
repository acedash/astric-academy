@extends('layouts.admin')

@section('header', 'Manage Courses')

@section('content')
<div class="flex flex-col lg:flex-row gap-8">
    <!-- List of Courses -->
    <div class="w-full lg:w-2/3 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Course Master</h3>
            <span class="text-sm text-gray-500 font-medium">Total: {{ $courses->total() }}</span>
        </div>
        <div class="p-0 overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-max">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <th class="px-6 py-4 font-medium">Course Title</th>
                        <th class="px-6 py-4 font-medium">Description</th>
                        <th class="px-6 py-4 font-medium">Price</th>
                        <th class="px-6 py-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($courses as $course)
                    <tr class="hover:bg-gray-50 transition group">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $course->title }}
                        </td>
                        <td class="px-6 py-4 text-gray-500 max-w-xs truncate" title="{{ $course->description }}">
                            {{ Str::limit($course->description, 60) }}
                        </td>
                        <td class="px-6 py-4 text-indigo-700 font-semibold">
                            ${{ number_format($course->price, 2) }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.courses.edit', $course->id) }}" class="text-gray-400 hover:text-indigo-600 transition p-2" title="Edit Course">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition p-2" title="Delete Course">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">No courses available.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($courses->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $courses->links() }}
        </div>
        @endif
    </div>

    <!-- Create Course Form -->
    <div class="w-full lg:w-1/3">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Create New Course</h3>
            
            <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Course Title</label>
                    <input type="text" name="title" required value="{{ old('title') }}" class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g. Advanced Laravel">
                    @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Briefly describe the course...">{{ old('description') }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price (USD)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number" name="price" step="0.01" min="0" required value="{{ old('price', '0.00') }}" class="w-full pl-7 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition shadow-sm flex items-center justify-center gap-2">
                    <i class="fas fa-plus"></i> Create Course
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
