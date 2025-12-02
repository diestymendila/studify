<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Category Management</h2>
                <p class="text-gray-600 mt-2">Organize course categories for better classification</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-semibold">Course Categories</h3>
                        <p class="text-gray-600 text-sm mt-1">Total: {{ $categories->total() }} categories</p>
                    </div>
                    <a href="{{ route('admin.categories.create') }}" class="btn-gradient text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                        Create Category
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($categories as $category)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="gradient-bg h-20"></div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $category->name }}</h4>
                        <p class="text-gray-600 text-sm mb-4">
                            {{ $category->description ?: 'No description available' }}
                        </p>
                        
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span class="font-semibold">{{ $category->courses_count }} courses</span>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm transition">
                                Edit
                            </a>
                            @if($category->courses_count == 0)
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this category?')" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm transition">
                                    Delete
                                </button>
                            </form>
                            @else
                            <button disabled class="flex-1 bg-gray-300 text-gray-500 px-4 py-2 rounded text-sm cursor-not-allowed" title="Cannot delete category with courses">
                                Delete
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-white rounded-lg shadow-sm p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No categories yet</h3>
                    <p class="text-gray-500 mb-6">Create your first category to organize courses</p>
                    <a href="{{ route('admin.categories.create') }}" class="inline-block btn-gradient text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                        Create First Category
                    </a>
                </div>
                @endforelse
            </div>

            @if($categories->hasPages())
            <div class="mt-6 bg-white rounded-lg shadow-sm p-4">
                {{ $categories->links() }}
            </div>
            @endif
        </div>
    </div>

    <footer style="background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);" 
        class="text-white py-2 fixed inset-x-0 bottom-0 z-50">
    <div class="max-w-7xl mx-auto px-8 text-center">
        <p class="text-sm">&copy; 2025 Studify. All rights reserved.</p>
    </div>
    </footer>
</x-app-layout>

<style>
    .gradient-bg {
        background: linear-gradient(135deg, #2a9df4 0%, #1e7ac4 100%);
    }
    .btn-gradient {
        background: linear-gradient(135deg, #2a9df4 0%, #1e7ac4 100%);
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);
    }
</style>