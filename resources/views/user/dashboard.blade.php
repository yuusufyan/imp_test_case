<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    @if ($todos->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400">No todos assigned to you.</p>
                    @else
                        <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-700 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                                    <th class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-center text-sm font-semibold uppercase ">Title</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-center text-sm font-semibold uppercase ">Description</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-center text-sm font-semibold uppercase ">Assigned By</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-center text-sm font-semibold uppercase ">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todos as $todo)
                                    <tr class="...">
                                        <td>{{ $todo->title }}</td>
                                        <td>{{ $todo->description }}</td>
                                        <td>{{ $todo->authorUser->name ?? '-' }}</td>
                                        <td class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-center text-sm space-x-3">
                                            @if ($todo->status !== 'done')
                                                <form method="POST" action="{{ route('todo.markDone', $todo->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                                        Mark as Done
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-green-500 font-semibold">Done</span>
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
