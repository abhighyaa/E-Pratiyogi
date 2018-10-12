@extends('layouts.app')

@section('content')


  <test-component  ref="foo" :easy="{{ json_encode($easy) }}" :med="{{ json_encode($med) }}" :hard="{{ json_encode($hard) }}" curr_ques='{{json_encode($curr_ques)}}'>

  </test-component>

{{-- <div v-if="quizrunning" class='quesblock'>
<div>
<div class="progress">
    <div class="progress-bar"  v-bind:style="{width:progress+'%' }"></div>
  </div>TIME:-@{{min}}:@{{sec}}</div>
<div class="ques">Q@{{noofque}} @{{currques.question}}  <span >@{{complexity}}</span> </div>
<ul style="list-style-type:none" class="choices">
  <li v-for="value in curr_choices" >
  <input type="radio"  v-bind:value="value" v-model="answer">@{{ value }}
  </li>
</ul>
<button @click='checkanswer'>submit</button>

</div>
<div v-if="quizrunning == false">
<h1>YOUR PERCENT :-=@{{marks}}% <h1>
<h1>DETAILED TEST REPORT:</h1>
<div v-for="(value, key) in questionsdata">
 <h2>TOPIC NAME:-"@{{ key }}"</h2> <br>
 <div v-if="value.right.easy.length + value.wrong.easy.length > 0">
 <h3>No of questions in easy:- @{{value.right.easy.length + value.wrong.easy.length }}</h3><br>
 <h3>out of the no of rights :-@{{value.right.easy.length}} (marks @{{value.right.easy.length}})</h3>
 <h3> and no of wrong :- @{{value.wrong.easy.length}}</h3>
 </div>

 <div v-if="value.right.med.length + value.wrong.med.length > 0">
 <h3>No of questions in medium:- @{{value.right.med.length + value.wrong.med.length}}</h3><br>
 <h3>out of the no of rights :-@{{value.right.med.length}}(marks @{{value.right.med.length*2}})</h3>
 <h3>and no of wrong :- @{{value.wrong.med.length}}</h3>
 </div>

 <div v-if="value.right.hard.length + value.wrong.hard.length > 0">
 <h3>No of questions in hard:- @{{value.right.hard.length + value.wrong.hard.length }}</h3><br>
 <h3>out of the no of rights :-@{{value.right.hard.length}}(marks @{{value.right.hard.length*3}})</h3>
 <h3>and no of wrong :- @{{value.wrong.hard.length}}</h3>
 </div>
 
</div>
<h3>TOPIC AND COMPLEXITY WISE WRONG QUESTION ANSWERS<h3>

<div v-for="(value, key) in questionsdata">
 <h2>TOPIC NAME:-"@{{ key }}"</h2> <br>
 <div v-if="value.wrong.easy.length > 0">
 <h3>no of wrong in easy:- @{{value.wrong.easy.length}}</h3>
 <div v-for="question in value.wrong.easy">
    <h4>@{{question.question}}</h4>
    <h4>@{{question.answer}}</h4>
  </div>
 </div>

 <div v-if="value.wrong.med.length > 0">
 <h3>no of wrong in med:- @{{value.wrong.med.length}}</h3>
 <div v-for="question in value.wrong.med">
    <h4>@{{question.question}}</h4>
    <h4>@{{question.answer}}</h4>
  </div>
 </div>

<div v-if="value.wrong.hard.length > 0">
 <h3>no of wrong in hard:- @{{value.wrong.hard.length}}</h3>
 <div v-for="question in value.wrong.hard">
    <h4>@{{question.question}}</h4>
    <h4>@{{question.answer}}</h4>
  </div>
 </div>
 
</div>

</div> --}}

@endsection