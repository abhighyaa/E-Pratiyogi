<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'E-Pratiyogi') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="/js/library.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/library.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <style>
        html,body{
            height:100%;  
        }
    </style>
</head>
<body>
    <div id="app">
      @include('partials.navbar')
        <main class="py-4">
        
            @yield('content')
            </div>
            </div>
        </div>
    </div>
</div>
            
        </main>
    </div>
</body>
</html>

<style scoped>
html,body{
    background:rgba(222, 222, 222,0.2);
}
.navbar{
    padding-top:2px;
    padding-bottom:0px;
    background:linear-gradient(to left,rgba(10,113,138),rgb(69, 181, 198));
    box-shadow: 0px 4px 10px rgba(5,5,5,0.2);
}
.nav-item{
    font-size:18px;
    margin-left:10px;
}
.nav-link{
    color:rgba(244,244,244) !important;
}
</style>