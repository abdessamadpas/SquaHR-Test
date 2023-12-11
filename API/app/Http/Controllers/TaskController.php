<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $tasks = Task::where('user_id', auth()->user()->id)->get();
        return response()->json($tasks, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|in:in_progress,done',
        ]);

        $task = Task::create([
            'description' => $request->input('description'),
            'due_date' => Carbon::createFromFormat('m/d/Y', $request->input('due_date'))->format('Y-m-d H:i:s'),
            'status' => $request->input('status'),
            'user_id' => auth()->user()->id,
        ]);

        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|in:in_progress,done',
        ]);

        $task = Task::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->update([
            'description' => $request->input('description'),
            'due_date' => Carbon::createFromFormat('m/d/Y', $request->input('due_date'))->format('Y-m-d H:i:s'),
            'status' => $request->input('status'),
        ]);

        return response()->json($task, 200);
    }

    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
