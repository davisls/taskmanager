@extends('layouts.layout')

@section('title', 'Criar Tarefas')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mx-auto mt-4">

            @if (session('msg-failed'))
            <p class="alert alert-danger mt-2">
                {{session('msg-failed')}}
            </p>
            @endif

            @if (session('msg-success'))
            <p class="alert alert-success mt-2">
                {{session('msg-success')}}
            </p>
            @endif

            <table class="table">
                <thead>
                    <tr>
                      <th scope="col">Prazo</th>
                      <th scope="col">Tarefa</th>
                      <th scope="col">Designada para</th>
                      <th scope="col">Prioridade</th>
                    </tr>
                  </thead>
                <tbody>
                    @foreach ($tasks as $task)

                            <tr class="
                            @if(!$task->completed)
                                text-dark
                            @else
                                text-completed
                            @endif">

                                <td><p class="my-1">{{date('d-m-Y', strtotime($task->max_date))}}</p></td>
                                <td><p class="my-1">{{$task->name}}</p></td>
                                <td><p class="my-1">{{$task->name_colaborator_designated}}</p></td>
                                <td>
                                    @if ($task->priority == 'max')
                                        <p class="text-danger my-1">Máxima</p>
                                    @endif
                                    @if ($task->priority == 'med')
                                        <p class="text-warning my-1">Média</p>
                                    @endif
                                    @if ($task->priority == 'low')
                                        <p class="text-success my-1">Baixa</p>
                                    @endif
                                </td>
                                <td><a href="/detalhes/{{$task->id}}" class="btn btn-secondary btn-sm">Detalhes</a></td>
                            </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {{$tasks->links()}}
        </div>
    </div>
</div>

@endsection
