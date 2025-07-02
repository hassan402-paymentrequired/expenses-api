<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function getAllUserWithExpenses()
    {
        return response()->json([
            'users' => User::with('tasks')->paginate(100)->map(function ($user) {
                $user->expenses = $user->tasks;
                unset($user->tasks);
                return $user;
            })
        ], 200);
    }

    public function index()
    {
        return response()->json([
            'enpenses' => auth()->user()->tasks,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'item_amount' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'string', 'min:3'],
            'expense_date' => ['required', 'string', 'date'],
        ]);

        $task = auth()->user()->tasks()->create($request->all());

        return response()->json([
            'message' => 'expense created successfully',
            'expense' => $task
        ], 201);
    }

    public function show(Task $task)
    {
        return response()->json([
            'expense' => $task,
        ], 200);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'item_name' => ['nullable', 'string', 'max:255'],
            'item_amount' => ['nullable', 'string', 'min:3'],
            'category' => ['nullable', 'string', 'min:3'],
            'expense_date' => ['nullable', 'string', 'min:3'],
        ]);

        $task->update($request->all());

        return response()->json([
            'message' => 'Expense updated successfully',
            'expense' => $task
        ], 200);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'message' => 'Expense deleted successfully',
        ], 200);
    }
}
