<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
    <div id="app">
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
            <div class="flex items-center justify-
