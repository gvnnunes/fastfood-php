<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @toastr_css
    <title>FastFood | Login</title>
</head>
<body>
    <section id="login-content">
        <div class="container">
            <div class="row">
                <div id="content" class="col-lg-12 mx-auto my-auto shadow-lg">
                    <div id="content-view">
                        <h4>ACESSE O SISTEMA</h4>
                        {!! Form::open(['route' => 'user.login', 'method' => 'post']) !!}
                            @include('templates.forms.text', ['name' => 'username', 'attributes' => ['placeholder' => 'Usuário', 'class' => 'form-control', 'required']])
                            @include('templates.forms.password', ['name' => 'password', 'attributes' => ['placeholder' => 'Senha', 'class' => 'form-control', 'required']])
                            @include('templates.forms.submit', ['name' => 'ENTRAR', 'attributes' => ['class' => 'btn', 'id' => 'btn-login']])
                        {!! Form::close() !!}
                    </div>
                    <div id="img-content"></div>
                </div>
            </div>
        </div>
            
    </section>
</body>
@jquery
@toastr_js
@toastr_render
</html>