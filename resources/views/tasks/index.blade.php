<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Task Manager</h1>
            <!-- Logout Button (Breeze) -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 underline">
                    Logout
                </button>
            </form>
        </div>

        <!-- Add Task Form -->
        <form method="POST" action="/tasks" class="flex gap-2 mb-6">
            @csrf
            <input type="text" name="title" 
                   class="border border-gray-300 p-2 flex-1 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                   placeholder="What needs to be done?" required>
            <button class="bg-blue-600 text-white px-5 py-2 rounded font-semibold hover:bg-blue-700 transition">
                Add
            </button>
        </form>

        <hr class="mb-6">

        <!-- Task List -->
        <div class="space-y-3">
            @foreach($tasks as $task)
                <div class="flex items-center justify-between p-3 border border-gray-200 rounded-md hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <!-- Toggle Status -->
                        <form method="POST" action="/tasks/{{ $task->id }}">
                            @csrf
                            @method('PATCH')
                            <button class="text-2xl leading-none">
                                {{ $task->is_done ? '✅' : '⬜' }}
                            </button>
                        </form>
                        
                        <span class="{{ $task->is_done ? 'line-through text-gray-400' : 'text-gray-700' }} font-medium">
                            {{ $task->title }}
                        </span>
                    </div>

                    <!-- Delete Button -->
                    <form method="POST" action="/tasks/{{ $task->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-400 hover:text-red-600 transition p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach

            @if($tasks->isEmpty())
                <p class="text-center text-gray-500 py-4">No tasks yet. Add one above!</p>
            @endif
        </div>
    </div>
</body>
</html>