<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-4 flex justify-end px-6 py-4">
                    <a href="{{ route('admin.todo.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                        + Tambah Todo
                    </a>
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    @if ($todos->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400">No todos found.</p>
                    @else
                        <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-700 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-left text-sm font-semibold uppercase">
                                        Title</th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-left text-sm font-semibold uppercase">
                                        Description</th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-left text-sm font-semibold uppercase">
                                        Assigned To</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-left text-sm font-semibold uppercase">
                                        Status</th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-center text-sm font-semibold uppercase">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todos as $todo)
                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <td class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-sm">
                                            {{ $todo->title }}</td>
                                        <td class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-sm">
                                            {{ $todo->description }}</td>
                                        <td class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-sm">
                                            {{ $todo->assignedUser->name ?? '-' }}</td>
                                        <td class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-sm text-green-500 font-semibold">
                                            {{ $todo->status }}
                                        </td>
                                        <td
                                            class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-center text-sm space-x-3">
                                            @if ($todo->status === 'done')
                                                <span class="text-gray-500 italic">Task Already Done</span>
                                            @else
                                                <a href="{{ route('admin.todo.edit', $todo->id) }}"
                                                    class="text-blue-600 hover:underline">Edit</a>
                                                <form action="{{ route('admin.todo.destroy', $todo->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Delete this todo?')"
                                                        class="text-red-600 hover:underline">Delete</button>
                                                </form>
                                            @endif
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