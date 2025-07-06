<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Todo;

class ToDoController extends Controller
{
    public function create()
    {
        $users = [];
        if (Auth::user()->role === 'admin') {
            $users = User::where('role', 'user')->get();
        }
        return view('admin.todo.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'nullable|string',
            'assigned_id' => 'nullable|exists:users,id',
        ]);

        $assignedId = Auth::user()->role === 'admin'
            ? $request->assigned_id
            : Auth::id();

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_id' => $assignedId,
            'author_id' => Auth::id(),
            'status' => 'ongoing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Todo berhasil ditambahkan');
    }

    public function edit($id)
    {
        $todo = Todo::findOrFail($id);
        $users = [];
        if (Auth::user()->role === 'admin') {
            $users = User::where('role', 'user')->get();
        }
        return view('admin.todo.edit', compact('todo', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:ongoing,done',
        ]);

        $todo = Todo::findOrFail($id);
        $todo->update($request->only('title', 'description', 'assigned_to', 'status'));

        return redirect()->route('admin.dashboard')->with('success', 'Todo updated successfully.');
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Todo deleted successfully.');
    }

    public function markDone($id)
    {
        $todo = Todo::where('id', $id)
            ->where('assigned_id', auth()->id())
            ->firstOrFail();

        $todo->status = 'done'; 
        $todo->save();

        return redirect()->route('dashboard')->with('success', 'Todo marked as done!');
    }
}
