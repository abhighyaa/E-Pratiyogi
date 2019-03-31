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
    <style>
        html,body{
            height:100%;  
        }
    </style>
    <style type="text/css" media="screen">
        .ace_editor, .toolbar {
        border: 1px solid lightgray;
        margin: auto;
        width: 80%;
    } 
    .ace_editor {
        height: 200px;
    }
</style>
</head>
<body>
<div id="app">
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/logo.png" class="img-responsive">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                              <li class="nav-item active">
						        <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="/student/home">EPtest<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item dropdown">
							        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							          Help
							        </a>
							        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							          <a class="dropdown-item" href="#">FAQ</a>
							          <a class="dropdown-item" href="#">Support</a>
							        </div>
						      </li>
                              
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Signup</a>
                            </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(Auth::user()->unreadNotifications->count())
                                    <span class="badge badge-pill badge-danger">
                                        {{ Auth::user()->unreadNotifications->count() }}
                                     </span>
                                 @endif
                                        Notifications <span class="caret"></span>
                            </a>

                                <div class="dropdown-menu dropdown-menu-right notificationPanel" aria-labelledby="navbarDropdown">
                                    @foreach(Auth::user()->unreadNotifications as $notification) 
                                        <a class="dropdown-item">
                                            <div class="notificationDetail">
                                                <div class="notificationTitle">{{ $notification->data['resgistration']['title']}}{{Auth::user()->name}},</div>
                                                <div class="notificationBody">{!! $notification->data['resgistration']['body'] !!}</div>
                                            </div>
                                        </a>
                                    @endforeach 
                                    @if(Auth::user()->unreadNotifications->count())
                                        <div class="clearAllLink"><a class="btn btn-link" href="{{ route('markAsRead') }}">Clear All</a></div>
                                    @else
                                            <div class="noNotificationMsg">
                                                <span class="fa fa-bell fa-3x"></span>
                                                <p>No New Notifications</p>
                                            </div>
                                    @endif
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if( Auth::user()->role->first()->pivot->role_id !== 1)
                                         <a class="dropdown-item" href="{{ route('profile', ['id' =>  Auth::user()->id ])}}">Manage Profile</a>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <style>
            .notificationDetail
            {
                white-space: pre-line;
  margin: 0 auto;
  background: rgba(222,222,222,0.5);
  padding: 2px 5px;
            }
        </style>




</div>
<main class="py-4">
<script src="../src/ace.js"></script>
<!-- load ace language_tools extension -->
<script src="../src/ext-language_tools.js"></script>
<script>
    var buildDom = require("ace/lib/dom").buildDom;
    var editor = ace.edit();
    editor.setOptions({
        theme: "ace/theme/tomorrow_night_eighties",
        mode: "ace/mode/markdown",
        maxLines: 30,
        minLines: 30,
        autoScrollEditorIntoView: true,
    });
    var refs = {};
    function updateToolbar() {
        refs.saveButton.disabled = editor.session.getUndoManager().isClean();
        refs.undoButton.disabled = !editor.session.getUndoManager().hasUndo();
        refs.redoButton.disabled = !editor.session.getUndoManager().hasRedo();
    }
    editor.on("input", updateToolbar);
    editor.session.setValue(localStorage.savedValue || "//Write your code here..")
    function save() {
        localStorage.savedValue = editor.getValue(); 
        editor.session.getUndoManager().markClean();
        updateToolbar();
    }
    function compile(){
        var code=editor.getValue();
        // var code = $(".ace_content").text();
        var lang =  $("#language").val();
        
        $.ajax({
            type: "GET",
            url: "/teacher/getoutput", 
            data: {lang:lang,code:code,id:1},
            success: function(data) {
               $("#output").html(data);  
            }
         });

    }
    editor.commands.addCommand({
        name: "save",
        exec: save,
        bindKey: { win: "ctrl-s", mac: "cmd-s" }
    });
    
    buildDom(["div", { class: "toolbar" },
        ["button", {
            ref: "compileButton",
            onclick: compile
        }, "Compile"],
        ["button", {
            ref: "saveButton",
            onclick: save
        }, "Save"],
        ["button", {
            ref: "undoButton",
            onclick: function() {
                editor.undo();
            }
        }, "Undo"],
        ["button", {
            ref: "redoButton",
            onclick: function() {
                editor.redo();
            }
        }, "Redo"],

    ], document.body, refs);
    
    document.body.appendChild(editor.container)
    
    window.editor = editor;
</script>

<label for="lang">Choose Language</label>

<select class="form-control float-right" name="language"  id="language" >
<option value="c">C</option>
<option value="cpp">C++</option>
<!-- <option value="java">Java</option>
<option value="python">Python</option> -->
</select>
<div id="output"></div>
    <!-- <input id="run" type="submit" class="btn btn-success float-right" value="Run Code"><br><br><br> -->
</main>


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

</body>
</html>