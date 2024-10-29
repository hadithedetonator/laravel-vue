<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        .completed {
            text-decoration: line-through;
        }
        .sidebar {
            transition: transform 0.3s ease;
        }
        .sidebar.hidden {
            transform: translateX(-100%);
        }
    </style>
</head>
<body class="flex bg-gray-100">
    <div id="app" class="flex w-full">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar bg-white shadow-md w-64 h-screen p-4">
            <h2 class="text-lg font-semibold">Menu</h2>
            <ul>
                <li><a href="{{ route('todo.index') }}" class="block p-2 hover:bg-gray-200">To Do List</a></li>
                <li><a href="#" class="block p-2 hover:bg-gray-200">Another Link</a></li>
                <li><a href="#" class="block p-2 hover:bg-gray-200">Settings</a></li>
                <li><a href="{{ route('logout') }}" class="block p-2 hover:bg-gray-200">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            @if (Auth::check())
                <h1>Welcome, {{ Auth::user()->name }}!</h1>
                <p>This is your home page.</p>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <!-- To Do List Section -->
                <h2 class="text-2xl font-semibold mt-6">Your To Do List</h2>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <form action="{{ route('todo.store') }}" method="POST" id="todo-form">
                        @csrf
                        <div class="flex mb-4">
                            <input type="text" name="task" class="w-full px-4 py-2 mr-2 rounded-lg border-gray-300 focus:outline-none focus:border-blue-500" placeholder="Add new task" required>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add</button>
                        </div>
                    </form>
                    <ul id="todo-list">
                        @foreach ($tasks as $task)
                            <li class="border-b border-gray-200 flex items-center justify-between py-4">
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2" {{ $task->completed ? 'checked' : '' }} onchange="updateTask({{ $task->id }}, this.checked)">
                                    <span class="{{ $task->completed ? 'completed' : '' }}">{{ $task->task }}</span>
                                </label>
                                <div>
                                    <form action="{{ route('todo.destroy', $task) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700 mr-2 delete-btn">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <h1>Welcome to the application!</h1>
                <p>Please log in or register to continue.</p>
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endif
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        function updateTask(taskId, completed) {
            fetch(`/todo/${taskId}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ completed: completed })
            }).then(response => {
                if (!response.ok) {
                    console.error('Error updating task');
                }
            });
        }

        document.getElementById('toggle-sidebar').addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>
</html>
