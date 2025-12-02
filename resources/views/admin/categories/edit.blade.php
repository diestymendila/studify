<x-app-layout>
    <x-slot name="header">
        Edit Category: {{ $category->name }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" id="editCategoryForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name"
                            value="{{ old('name', $category->name) }}" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                        >
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                            Description (Optional)
                        </label>
                        <textarea 
                            name="description" 
                            id="description"
                            rows="4" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                        >{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4 border-t pt-6">
                        <button type="submit" class="btn-gradient text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            Update Category
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-8 py-3 rounded-lg font-semibold transition">
                            Cancel
                        </a>
                        @if($category->courses()->count() == 0)
                        <button type="button" onclick="confirmDelete()" class="bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-lg font-semibold transition ml-auto">
                            Delete Category
                        </button>
                        @endif
                    </div>
                </form>

                
                @if($category->courses()->count() == 0)
                <form id="deleteCategoryForm" action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                @endif
            </div>

            <!-- Info Card -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mt-6">
                <h4 class="font-bold text-gray-900 mb-2">ℹ️ Category Information</h4>
                <p class="text-sm text-gray-700 mb-3">
                    This category currently has <strong>{{ $category->courses()->count() }}</strong> course(s) associated with it.
                </p>
                @if($category->courses()->count() > 0)
                <p class="text-sm text-yellow-800 bg-yellow-50 p-3 rounded">
                    ⚠️ You cannot delete this category because it has courses. Please reassign or delete the courses first.
                </p>
                @endif
            </div>
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
    .btn-gradient {
        background: linear-gradient(135deg, #2a9df4 0%, #1e7ac4 100%);
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);
    }
</style>

<script>
function confirmDelete() {
    if (confirm('Are you sure you want to delete this category?')) {
        document.getElementById('deleteCategoryForm').submit();
    }
}
</script>