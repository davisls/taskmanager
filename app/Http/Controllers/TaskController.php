<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{

    public function update(Request $request)
    {
        $this->validat($request);

        $task = Task::findOrFail($request->id);

        $task->update($request->all());
        $task->update(['name_colaborator_designated' => User::findOrFail($request->designated_for)->name]);

        $tasks = Task::all();
        return redirect('/')->with('msg-success', 'Tarefa Editada Com Sucesso');;

    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        $tasks = Task::all();
        return redirect('/')->with('msg-success', 'Tarefa Excluído Com Sucesso');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $user = auth()->user();

        return view('show', ['task' => $task, 'user' => $user]);

    }

    public function edit($id)
    {
        $users = User::all();
        $task = Task::findOrFail($id);
        $user = auth()->user();

        return view('edit', ['task' => $task, 'user' => $user, 'users' => $users]);

    }

    public function store(Request $request)
    {

        $this->validat($request);

        $task = new Task;
        $user = auth()->user();

        $task->user_id = $user->id;
        $task->created_by = $user->name;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->designated_for = $request->designated_for;
        $task->name_colaborator_designated = User::findOrFail($request->designated_for)->name;
        $task->max_date = $request->max_date;
        $task->priority = $request->priority;

        $task->save();

        return back()->with('msg-success', 'Tarefa Cadastrada com Sucesso');

    }

    public function validat(Request $request)
    {

        if(!$request->name)
        {
            return back()->with('msg-failed', 'Nome da Tarefa Inválido');
        }

        if(!$request->description || $request->description < 15)
        {
            return back()->with('msg-failed', 'Descrição da Tarefa Inválida');
        }

        if(!$request->designated_for)
        {
            return back()->with('msg-failed', 'Escolha um Colaborador para a Tarefa');
        }

        if(!$request->max_date || !$request->max_date == 10 || $request->max_date < date('Y-m-d'))
        {
            return back()->with('msg-failed', 'Data Inválida');
        }

        if(!$request->priority)
        {
            return back()->with('msg-failed', 'Escolha uma Prioridade');
        }

    }

    public function concluida($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['completed' => true]);
        return redirect('/')->with('msg-success', 'Tarefa Editada Com Sucesso');;
    }

    public function tarefas($id)
    {
        $tasks = Task::where('designated_for', "$id")->orderBy('max_date')->paginate(9);
        return view('tarefas', ['tasks' => $tasks]);
    }

    public function filter($filtro)
    {
        if(str_ends_with($filtro, 'd'))
        {
            $filtro = rtrim($filtro, 'd');
            $tasks = Task::where('max_date', "$filtro")->orderBy('max_date')->paginate(9);
        }
        else if(str_ends_with($filtro, 'u'))
        {
            $filtro = rtrim($filtro, 'u');
            $tasks = Task::where('designated_for', "$filtro")->orderBy('max_date')->paginate(9);
        }
        else if(str_ends_with($filtro, 'p'))
        {
            $filtro = rtrim($filtro, 'p');
            $tasks = Task::where('priority', "$filtro")->orderBy('max_date')->paginate(9);
        }
        return view('tarefas', ['tasks' => $tasks]);

    }

}
