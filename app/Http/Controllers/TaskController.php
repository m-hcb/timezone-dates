<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = \App\Task::all();
        return view('welcome', compact("tasks"));
    }

    public function save(Request $request)
    {

        session(['timezone' => $request->timezone]);

        $task = new \App\Task;
        $task->title = $request->title;
        $task->local_time = \Carbon\Carbon::now($request->tz);
        $task->save();

        return redirect('/');
    }
}
