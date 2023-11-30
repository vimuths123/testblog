<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blogs list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="mx-auto">
                    <div class="max-w-screen-xl mx-auto">
                        <a href="{{ route('blogs.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-full float-right mb-4">
                            {{ __('Create new blog') }}
                        </a>
                    </div>


                    @if(session('success'))
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <span class="font-medium">Success alert!</span> {{ session('success') }}
                    </div>
                    @endif
                    @if($userBlogs->isEmpty())
                    <p class="text-center mt-4">No blogs to display.</p>
                    @else
                    <table class="min-w-full border border-gray-300">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border border-gray-300">Title</th>
                                <th class="py-2 px-4 border border-gray-300">Content</th>
                                <th class="py-2 px-4 border border-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userBlogs as $blog)
                            <tr>
                                <td class="py-2 px-4 border border-gray-300">{{ $blog->title }}</td>
                                <td class="py-2 px-4 border border-gray-300">{{ strlen($blog->content) > 80 ? substr($blog->content, 0, 80) . '...' : $blog->content }}</td>
                                <td class="py-2 px-4 border border-gray-300">
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="text-blue-500 hover:underline mr-2">Edit</a>

                                    @if ($blog->published_date)
                                    <form id="unpublishForm_{{ $blog->id }}" action="{{ route('blogs.unpublish', $blog->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="button" onclick="confirmAction('{{ $blog->id }}', 'unpublish')" class="text-red-500 hover:underline">Unpublish</button>
                                    </form>
                                    @else
                                    <form id="publishForm_{{ $blog->id }}" action="{{ route('blogs.publish', $blog->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="button" onclick="confirmAction('{{ $blog->id }}', 'publish')" class="text-green-500 hover:underline">Publish</button>
                                    </form>
                                    @endif

                                    <form id="deleteForm_{{ $blog->id }}" action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('{{ $blog->id }}')" class="text-red-500 hover:underline">Delete</button>
                                    </form>

                                    <script>
                                        function confirmDelete(blogId) {
                                            if (confirm("Are you sure you want to delete this blog?")) {
                                                document.getElementById('deleteForm_' + blogId).submit();
                                            }
                                        }
                                    </script>

                                    <script>
                                        function confirmAction(blogId, action) {
                                            var actionText = action === 'publish' ? 'publish this blog' : 'unpublish this blog';
                                            if (confirm("Are you sure you want to " + actionText + "?")) {
                                                document.getElementById(action + 'Form_' + blogId).submit();
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>



            </div>
        </div>
    </div>
</x-app-layout>