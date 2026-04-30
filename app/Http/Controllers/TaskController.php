<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // PHASE 7: Only get tasks belonging to the logged-in user
        $tasks = auth()->user()->tasks()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        // PHASE 7: Create the task through the user relationship
        auth()->user()->tasks()->create([
            'title' => $request->title
        ]);
        return redirect()->back();
    }

    public function update($id)
    {
        // Find the task and toggle its status
        $task = Task::findOrFail($id);
        $task->is_done = !$task->is_done;
        $task->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        Task::destroy($id);
        return redirect()->back();
    }
}