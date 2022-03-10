

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>

    <nav class="nav nav-principal">
        <div class="nav-left">
            <a href="/" class="navbar-brand">Logo</a>
        </div>
        <div class="nav-right">
            @guest
            <a class="nav-link" href="/login">Login</a>
            <a class="nav-link" href="/register">Registrar-se</a>
            @endguest
            @auth
                <a class="nav-link" href="/">Vizualizar Tarefas</a>
                <a class="nav-link" href="/tarefas/{{auth()->user()->id}}">Suas Tarefas</a>
                <a class="nav-link" href="/cadastrar">Cadastrar Tarefa</a>
                <form action="/logout" method="post">
                    @csrf
                    <a href="/logout" class="nav-link"
                    onclick="event.preventDefault();
                    this.closest('form').submit();"
                    >Sair</a>
                </form>
            @endauth
        </div>
    </nav>

    @yield('content')
</body>
</html>
