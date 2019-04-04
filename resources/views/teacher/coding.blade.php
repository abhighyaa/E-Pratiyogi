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


</div>
<main class="py-4">
<script src="../src/ace.js"></script>
<!-- load ace language_tools extension -->
<script src="../src/ext-language_tools.js"></script>
<script>
       var id =  {!! json_encode($id) !!};
       var a_id={!! json_encode($idd) !!};
       var minn = {!! json_encode($min) !!};
       var secc = {!! json_encode($sec) !!};
       var test = {!! json_encode($test_id) !!}; 
       var timm,m,s;
       var attempt = 0;
       var n1,n2,tim2;
       var notify,arq;
       var timer =Number(minn)*60+Number(secc);
       startTimer();
       attemptrequest();



$(window).on("unload", function(e) {
    answer();
   });

// $(window).bind('beforeunload', function(){
//     return ' want to leave??';
// });



function generatenoti(){
    notify = new Notification('STAY ON THE TEST PAGE ATTEMPT NO('+ ++attempt +' of 3)', {
        body: 'THIS IS THE WARNING MESSAGE!!!"',
    });
    console.log('notificaton generated');
}


$(window).blur(function(){
    if(attempt < 3 ){
        var d = new Date();
        var n = d.getTime();
        n1=n/1000;
        n2=n1;
        tim2 = setInterval(function () {
            n2++;
            if((n2-n1) == 2){
                generatenoti();
            }
        }, 1000);

    }
    else{
        // $(window).off("beforeunload");
        answer();        
    }
  });
  
  $(window).focus(function(){
    clearInterval(tim2);
    if (n1+20 <= n2++) {
    alert('20 seconds up test over');
    answer();
    }
    });






       function startTimer() {
            timm = setInterval(function () {
                m = parseInt(timer/ 60, 10);
                s = parseInt(timer % 60, 10);
                m= m < 10 ? "0" + m : m;
                s = s < 10 ? "0" + s : s;
                
                $("#minp").html(m);
                $("#secp").html(s);
                if (--timer < 0) {
                clearInterval(timm);
                clearInterval(arq);
                answer();
                
                // $(window).off("beforeunload");
                // obj.checkanswer();
                }
                }, 1000);
       }


         function attemptrequest() {
                arq = setInterval(function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                    $.ajax({
                        type : "post",
                        url : "/savetimecode",           
                        data: {
                        min:m,
                        sec:s,
                        id:a_id,
                        code:editor.getValue()
                        },
                        success : function(response) {
             
                        }
                    });
                            
                   
                   
                }, 5000);
            }





       function answer(){
        $("#compile").click();
        $(window).off("unload");
        // $(window).off("beforeunload");
        
        var per=0;
        if( $("#output").html() == 'Verdict : AC')
            per = 100; 

        if( $("#output").html() == 'Verdict : PA')
            per =50;



        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
                type : "post",
                url : "/savecode",         
                data: {
                per:per,
                id:a_id,
                test:test
                },
                success : function(response) {
                    location.replace("/result/"+response);    
                }
            });

       }       
 
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
            data: {lang:lang,code:code,id:id},
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
            onclick: compile,
            id:'compile'
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

<span id='minp'>{{$min}} </span> <span id='secp'>{{$sec}}</span>
<button onclick="answer()">Submit test</button>
<h1>Q:-{{$codee->question}}</h1>
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

</body>
</html>

