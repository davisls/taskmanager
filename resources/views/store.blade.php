@extends('layouts.layout')

@section('title', 'Criar Tarefas')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

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

                <div class="card my-3">
                    <div class="card-header p-3">
                        Cadastro de Tarefas
                    </div>
                    <div class="card-body">
                        <form action="/store" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Nome da Tarefa:</label>
                                <input type="text" name="name" class="form-control my-2">
                            </div>
                            <div class="form-group">
                                <label>Descrição da Tarefa:</label>
                                <textarea name="description" class="form-control my-2" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Colaborador Designado:</label>
                                <select name="designated_for" class="form-control my-2">
                                    <option value="" selected disabled hidden></option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Data para Entrega da Tarefa:</label>
                                <input type="date" name="max_date" class="form-control my-2">
                            </div>
                            <div class="form-group">
                                <label>Prioridade:</label>
                                <select name="priority" class="form-control my-2">
                                    <option value="" selected disabled hidden></option>
                                    <option value="max">Máxima</option>
                                    <option value="med">Normal</option>
                                    <option value="low">Baixa</option>
                                </select>
                            </div>
                            <button class="btn form-control btn-primary my-3" type="submit">Cadastrar Tarefa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
