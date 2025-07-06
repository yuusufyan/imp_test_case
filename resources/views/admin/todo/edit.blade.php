<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Edit Todo') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('admin.todo.update', $todo->id) }}" method="POST" class="space-y-4">
          @csrf
          @method('PUT')

          <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $todo->title) }}"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
              required>
            @error('title')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
          </div>

          <div>
            <label for="description"
              class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea name="description" id="description" rows="4"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
              required>{{ old('description', $todo->description) }}</textarea>
            @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
          </div>

          <div>
            <label for="assigned_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Assign
              To</label>
            <select name="assigned_id" id="assigned_id"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
              <option value="">-- Select User --</option>
              @foreach ($users as $user)
          <option value="{{ $user->id }}" {{ old('assigned_id', $todo->assigned_id) == $user->id ? 'selected' : '' }}>
          {{ $user->name }}
          </option>
        @endforeach
            </select>
            @error('assigned_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
          </div>

          <div>
            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
            <select name="status" id="status"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
              required>
              <option value="ongoing" {{ old('status', $todo->status) == 'ongoing' ? 'selected' : '' }}>On Going</option>
              <option value="done" {{ old('status', $todo->status) == 'done' ? 'selected' : '' }}>Done</option>
            </select>
            @error('status')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
          </div>

          <div>
            <button type="submit"
              class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
              Update Todo
            </button>
            <a href="{{ route('admin.dashboard') }}" class="ml-4 text-gray-700 dark:text-gray-300 hover:underline">
              Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>