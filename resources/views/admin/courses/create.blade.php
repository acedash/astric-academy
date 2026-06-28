@extends('layouts.admin')

@section('header', 'Create New Course')

@section('content')
<div class="max-w-4xl bg-white rounded-xl shadow-[0_2px_10px_rgb(0,0,0,0.02)] border border-gray-100 p-8">
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-1">Course Fundamentals</h3>
            <p class="text-sm text-gray-500">Don't worry, you can always edit this later. Next, you'll be able to add lessons.</p>
        </div>
        <a href="{{ route('admin.courses.index') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Back to Courses
        </a>
    </div>
    
    <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Course Title *</label>
            <input type="text" name="title" required value="{{ old('title') }}" class="w-full rounded-lg border-gray-200 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm" placeholder="e.g. Masterclass in Web Development">
            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Course Description</label>
            <textarea name="description" rows="4" class="w-full rounded-lg border-gray-200 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm" placeholder="Provide a compelling overview of what students will achieve in this course...">{{ old('description') }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Pricing (USD) *</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500">$</span>
                    </div>
                    <input type="number" name="price" step="0.01" min="0" required value="{{ old('price', '0.00') }}" class="w-full pl-7 rounded-lg border-gray-200 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                </div>
                <p class="mt-1 text-xs text-gray-500">Set to 0.00 to make this course completely free.</p>
                @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Number of Tools *</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-tools text-gray-400"></i>
                    </div>
                    <input type="number" name="tools_count" min="0" required value="{{ old('tools_count', '0') }}" class="w-full pl-9 rounded-lg border-gray-200 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                </div>
                <p class="mt-1 text-xs text-gray-500">How many tools are taught in this program?</p>
                @error('tools_count') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-3 mt-8">
            <a href="{{ route('admin.courses.index') }}" class="px-5 py-2 text-gray-600 font-medium hover:bg-gray-50 border border-gray-200 rounded-lg transition text-sm">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg transition shadow-sm flex items-center gap-2 text-sm">
                <span>Create & Continue</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </form>
</div>
@endsection
