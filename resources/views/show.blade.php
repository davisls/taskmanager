@extends('layouts.layout')

@section('title', 'Criar Tarefas')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mx-auto mt-5">
            <div class="card">
                <div class="card-header">
                    {{$task->name}}
                </div>
                <div class="card-body">
                    <p>Detalhes: {{$task->description}}</p>
                    <p>Data de Emissão: {{date('d-m-Y', strtotime($task->created_at))}}</p>
                    <p>Data para Entrega (Máxima): {{date('d-m-Y', strtotime($task->max_date))}}</p>
                    <p>Colaborador Designado: {{$task->name_colaborator_designated}}</p>

                    @if ($task->priority == 'max')
                    <p>Prioridade: <span class="text-danger">Máxima</span></p>
                    @endif
                    @if ($task->priority == 'med')
                    <p>Prioridade: <span class="text-warning">Média</span></p>
                    @endif
                    @if ($task->priority == 'low')
                    <p>Prioridade: <span class="text-success">Baixa</span></p>
                    @endif

                    <p>Pedida Por: {{$task->created_by}}</p>

                    @if($task->completed)
                    <p>Finalizado em: {{date('d-m-Y', strtotime($task->updated_at))}}</p>
                    @endif

                    @if(!$task->completed)

                        <div class="d-flex justify-content-end">
                            @if ($user->id == $task->designated_for)
                            <a href="/concluida/{{$task->id}}" class="m-2 btn btn-success">Concluida</a>
                            @endif
                            @if ($user->id == $task->user_id)
                                <a href="/editar/{{$task->id}}" class="m-2 btn btn-primary">Editar</a>
                                <form action="/delete/{{$task->id}}" method="post" class="m-2">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Excluir</button>
                                </form>
                            @endif
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
