@extends('layouts.layout')

@section('title', 'Criar Tarefas')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mx-auto mt-3">

            @if (session('msg-failed'))
            <p class="alert alert-danger mt-3">
                {{session('msg-failed')}}
            </p>
            @endif

            @if (session('msg-success'))
            <p class="alert alert-success mt-3">
                {{session('msg-success')}}
            </p>
            @endif

            <table class="table">
                <thead>
                    <tr>
                      <th scope="col"><a class="link-tarefa" href="
                        @if($_SERVER['REQUEST_URI'] == '/prazo/asc')
                            /prazo/desc
                        @else
                            /prazo/asc
                        @endif
                        ">Prazo</a></th>
                      <th scope="col">Tarefa</th>
                      <th scope="col">Designada para</th>
                      <th scope="col"><a class="link-tarefa" href="
                        @if($_SERVER['REQUEST_URI'] == '/prioridade/asc')
                            /prioridade/desc
                        @else
                            /prioridade/asc
                        @endif
                        ">Prioridade</a></th>
                    </tr>
                  </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        @if (!$task->completed)
                            <tr>
                                <td><p class="my-1"><a class="link-tarefa" href="/filter/{{$task->max_date.'d'}}">{{date('d-m-Y', strtotime($task->max_date))}}</p></a></td>
                                <td><p class="my-1">{{$task->name}}</p></td>
                                <td><p class="my-1"><a class="link-tarefa" href="/filter/{{$task->designated_for.'u'}}">{{$task->name_colaborator_designated}}</p></a></td>
                                <td>
                                    <a class="link-tarefa" href="/filter/{{$task->priority.'p'}}">
                                    @if ($task->priority == '1')
                                        <p class="text-danger my-1">Máxima</p>
                                    @endif
                                    @if ($task->priority == '2')
                                        <p class="text-warning my-1">Média</p>
                                    @endif
                                    @if ($task->priority == '3')
                                        <p class="text-success my-1">Baixa</p>
                                    @endif
                                    </a>
                                </td>
                                <td><a href="/detalhes/{{$task->id}}" class="btn btn-secondary btn-sm">Detalhes</a></td>
                            </tr>
                        @endif
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
