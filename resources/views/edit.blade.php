@extends('layouts.layout')

@section('title', 'Criar Tarefas')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

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

                <div class="card my-3">
                    <div class="card-header p-3">
                        Cadastro de Tarefas
                    </div>
                    <div class="card-body">
                        <form action="/update" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{$task->id}}">
                            <div class="form-group">
                                <label>Nome da Tarefa:</label>
                                <input type="text" name="name" class="form-control my-2" value="{{$task->name}}">
                            </div>
                            <div class="form-group">
                                <label>Descrição da Tarefa:</label>
                                <textarea name="description" class="form-control my-2" rows="6">{{$task->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Colaborador Designado:</label>
                                <select name="designated_for" class="form-control my-2">
                                    <option value="{{$task->designated_for}}">{{$task->name_colaborator_designated}}</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Data para Entrega da Tarefa:</label>
                                <input type="date" name="max_date" class="form-control my-2" value="{{$task->max_date}}">
                            </div>
                            <div class="form-group">
                                <label>Prioridade:</label>
                                <select name="priority" class="form-control my-2">
                                    <option value="{{$task->priority}}">
                                        @if ($task->priority == '1')
                                            Máxima
                                        @endif
                                        @if ($task->priority == '2')
                                            Média
                                        @endif
                                        @if ($task->priority == '3')
                                            Baixa
                                        @endif
                                    </option>
                                    <option value="1">Máxima</option>
                                    <option value="2">Normal</option>
                                    <option value="3">Baixa</option>
                                </select>
                            </div>
                            <button class="btn form-control btn-primary my-3" type="submit">Editar Tarefa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
