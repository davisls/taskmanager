<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;

class HomeController extends Controller
{

    public function home()
    {
        //$tasks = Task::all();
        $tasks = Task::where('completed', 'false')->orderBy('max_date')->paginate(9);
        return view('home', ['tasks' => $tasks]);
    }

    public function cadastrar()
    {
        $users = User::all();
        return view('store', ['users' => $users]);
    }

}
