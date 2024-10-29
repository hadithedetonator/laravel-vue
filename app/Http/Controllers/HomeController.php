<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // Make sure to import your Task model

class HomeController extends Controller
{
    public function index()
    {
        // Fetch tasks for the authenticated user
        $tasks = Task::where('user_id', auth()->id())->get();

        return view('welcome', compact('tasks'));
    }
}