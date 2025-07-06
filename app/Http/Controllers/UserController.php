<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class UserController extends Controller
{
    //
    public function index()
    {
        $todos = Todo::with('assignedUser', 'authorUser')->get(); // pake relasi kalau sudah ada
        return view('user.dashboard', compact('todos'));
    }
}
