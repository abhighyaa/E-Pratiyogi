<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-Pratiyogi') }}</title>

    <!-- Scripts -->
   

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/js/library.js"></script>
    

    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js" type="text/javascript" charset="utf-8"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/library.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.css"> -->
   
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.css"> -->
    @yield('includes')
          
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
div.notificationDetail{
  white-space: pre-line;
  margin: 0 auto;
  background: rgba(222,222,222,0.5);
  padding: 2px 5px;
}
div.notificationTitle{
  font-weight: bolder;
  text-transform: capitalize;
}
div.notificationBody{
 
  margin: 0 auto;
  width:auto;
  height:auto;
}
a.dropdown-item{
  padding: 3px 5px;
}
.clearAllLink{
    text-align:center;
}
.navbar{
    padding-top:2px;
    padding-bottom:0px;
    background:linear-gradient(to left,rgba(10,113,138),rgb(69, 181, 198));
    box-shadow: 0px 4px 10px rgba(5,5,5,0.2);
}
.nav-item{
    font-size:16px;
    margin-left:10px;
}
.nav-link{
    color:rgba(244,244,244) !important;
}
.notificationPanel{
    width: 400px !important;
    height: max-content;
}
.noNotificationMsg{
    text-align: center;
    font-size: 18px;
    font-family: inherit;
    color: rgba(150,150,150);
}
.noNotificationMsg p{
    margin:0;
}
.noNotificationMsg span{
    color:rgba(200,200,200);
}
</style>