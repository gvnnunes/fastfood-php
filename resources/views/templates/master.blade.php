<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>FastFood | Dashboard</title>
</head>
<body>
    <section id="dashboard-content">
        <div class="row h-100">
            <div id="content" class="col-lg-8 mx-auto my-auto shadow-lg">
                @yield('content-view')
            </div>
        </div>
    </section>
    @yield('content-js')   
</body>
</html>