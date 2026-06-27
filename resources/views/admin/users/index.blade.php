@extends('layouts.admin')

@section('header', 'Manage Students')

@section('content')
<div class="flex flex-col lg:flex-row gap-8">
    <!-- List of Students -->
    <div class="w-full lg:w-2/3 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900">Registered Students</h3>
        </div>
        <div class="p-0 overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-max">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <th class="px-6 py-4 font-medium">Name</th>
                        <th class="px-6 py-4 font-medium">Email</th>
                        <th class="px-6 py-4 font-medium">Enrolled Courses</th>
                        <th class="px-6 py-4 font-medium">Joined</th>
                        <th class="px-6 py-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($students as $student)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $student->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $student->email }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-2">
                                @forelse($student->courses as $course)
                                    <span class="px-2 py-1 bg-indigo-50 text-indigo-700 rounded-md text-xs font-medium border border-indigo-100">
                                        {{ $course->title }}
                                    </span>
                                @empty
                                    <span class="text-gray-400 italic text-xs">None</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $student->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $student->id) }}" class="text-gray-400 hover:text-indigo-600 transition p-2" title="Edit Student">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition p-2" title="Delete Student">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">No students found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($students->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $students->links() }}
        </div>
        @endif
    </div>

    <!-- Registration Form -->
    <div class="w-full lg:w-1/3">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Manually Register Student</h3>
            
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" required class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" required class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2 border-t border-gray-100 mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Assign Courses (Optional)</label>
                    <div class="space-y-2 max-h-48 overflow-y-auto pr-2">
                        @foreach($courses as $course)
                        <label class="flex items-start gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                            <input type="checkbox" name="courses[]" value="{{ $course->id }}" class="mt-0.5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $course->title }}</p>
                                <p class="text-xs text-gray-500">{{ Str::limit($course->description, 50) }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('courses') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition shadow-sm">
                    Register & Assign
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
