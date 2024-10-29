<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks; // Get tasks for the authenticated user
        return view('todo.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate(['task' => 'required|string|max:255']);
        Auth::user()->tasks()->create(['task' => $request->task]);
        return redirect()->back();
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->only('completed'));
        return redirect()->back();
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }
}
