@extends('layouts.test')


@section('content')
<div style='font-size:20px;'>
  <span><img src="/user.png"style=width:30px;height:30px;></span>
  <span style='background:black;color:white;'>{{$email}}</span></div>
<button style="position:absolute;right:130px;top:20px" class='btn btn-primary'  id="calc"> calc</button>

<div  id="calc-container" style='display:none;position:absolute;right:0px;top:50px;z-index:100'>
  <div id="display-row" class="row">
    <h1 id="display">0</h1>
  </div>
  <div class="row">
    <div class="col-xs-2"><button class="btn btnn btn-default bi format">del</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default clear format">C</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi">(</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi">)</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi">%</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi">^</button></div>
  </div> <!-- row  -->
  <div class="row">
    <div class="col-xs-2"><button class="btn btnn btn-default un">sqrt</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default un">sin</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi num">7</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi num">8</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi num">9</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi">/</button></div>
  </div> <!-- row 2 -->
  <div class="row">
    <div class="col-xs-2"><button class="btn btnn btn-default un">log10</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default un">cos</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi num">4</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi num">5</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi num">6</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi">*</button></div>
  </div> <!-- row 3 -->
  <div class="row">
    <div class="col-xs-2"><button class="btn btnn btn-default un">log</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default un">tan</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi num">1</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi num">2</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi num">3</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi">-</button></div>
  </div> <!-- row 3 -->
  <div class="row">
    <div class="col-xs-2"><button class="btn btnn btn-default bi">e</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi">pi</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi">E</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi num">0</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi">.</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default bi">+</button></div>
  </div> <!-- row 4 -->
  <div class="row">
    <div class="col-xs-2"></div>
    <div class="col-xs-2"></div>
    <div class="col-xs-2"><button class="btn btnn btn-default ans">ans</button></div>
    <div class="col-xs-2"><button class="btn btnn btn-default equals">=</button></div>
    <div class="col-xs-2"></div>
    <div class="col-xs-2"></div>
  </div> <!-- row 4 -->
      
  
  </div>


<teachertest-component  :test="{{ json_encode($test) }}"  :questions="{{ json_encode($ques) }}" :email="{{ json_encode($email) }}" :code="{{ json_encode($code) }} " :code_id="{{ json_encode($code_id) }}">

  </teachertest-component>


   
  



@endsection