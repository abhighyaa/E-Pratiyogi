<template>
<div>
    
   <div v-if="quizrunning" class='quesblock' style="max-width:700px;margin-top:50px;margin-left:24%">
   <div >
        <div>
        <div class="progress">
        <div class="progress-bar" v-bind:style="{width:progress+'%' }"></div>
        </div>
        </div>
        <div style="font-size:30px;text-align:center"> TIME:-{{min}}:{{sec}} </div>
        </div>

        
        <div style="border:1px solid grey;font-size:25px;background:lavender;   " class="ques">Q{{noqs}} {{curques.question}}  <span style="float:right;border:1px solid grey;background:grey;color:white;margin-right:5px;">{{complexity}}</span> </div>
        <div v-for="value in curques.choices" :key="value" style="border:1px solid grey;font-size:25px;  ">
        <input type="radio"  v-bind:value="value" v-model="answer">{{ value }}
        </div>
        <button @click='checkanswer'>submit</button>

        </div>

    <div v-if="quizrunning == false">

    <h1>YOUR PERCENT :-={{marks}}% </h1>
    <h1 style="text-align:center;"> TEST REPORT:</h1>
    <piechart-component :value="questionsdata" :type="'marks'">
        
    </piechart-component>
   <h3 style="text-align:center;">TOPIC WISE MARKS DISTRIBUTION</h3> 
    
    <piechart-component :value="questionsdata" :type="'rights'">
        
    </piechart-component>
   <h3 style="text-align:center;">TOPIC WISE RIGHT QUESTIONS</h3> 
    
   <piechart-component :value="questionsdata" :type="'wrongs'">
        
    </piechart-component>
   <h3 style="text-align:center;">TOPIC WISE RIGHT QUESTIONS</h3> 
 <hr>
    <h1 style="text-align:center;">DETAILED TEST REPORT:</h1>
     
    <div v-for="(value, key, index) in questionsdata" :key="index">
    <h2><strong>TOPIC NAME:-"{{ key }}"</strong></h2> <br>
    <div v-if="value.right.easy.length + value.wrong.easy.length > 0">
    <h3>No of questions in <strong>easy</strong>:- {{value.right.easy.length + value.wrong.easy.length }}</h3>
    <h3>out of them no of rights :-{{value.right.easy.length}} (marks {{value.right.easy.length}})</h3>
    <h3> and no of wrong :- {{value.wrong.easy.length}}</h3> 
 </div>

 <div v-if="value.right.med.length + value.wrong.med.length > 0">
 <h3>No of questions in <strong>medium</strong>:- {{value.right.med.length + value.wrong.med.length}}</h3>
 <h3>out of them no of rights :-{{value.right.med.length}}(marks {{value.right.med.length*2}})</h3>
 <h3>and no of wrong :- {{value.wrong.med.length}}</h3>
 </div>

 <div v-if="value.right.hard.length + value.wrong.hard.length > 0">
 <h3>No of questions in <strong>hard</strong>:- {{value.right.hard.length + value.wrong.hard.length }}</h3>
 <h3>out of them no of rights :-{{value.right.hard.length}}(marks {{value.right.hard.length*3}})</h3>
 <h3>and no of wrong :- {{value.wrong.hard.length}}</h3>
 </div>
 
</div>
<hr>
<h1>TOPIC AND COMPLEXITY WISE WRONG QUESTION ANSWERS</h1>

<div v-for="(value, key, index) in questionsdata" :key="index">
 <h2 v-if="value.wrong.easy.length >0|| value.wrong.med.length >0|| value.wrong.hard.length >0"><strong>TOPIC NAME:-"{{ key }}"</strong></h2> <br>
 <div v-if="value.wrong.easy.length > 0">
 <h3>no of wrong in <strong>easy</strong>:- {{value.wrong.easy.length}}</h3><br/>
 <div v-for="(question,index) in value.wrong.easy" :key="index">
    <h4>Q:- {{question.question}}</h4>
    <h4>Ans:- {{question.answer}}</h4>
  </div>
 </div>

 <div v-if="value.wrong.med.length > 0">
 <h3>no of wrong in <strong>med</strong>:- {{value.wrong.med.length}}</h3><br>
 <div v-for="(question,index) in value.wrong.med" :key="index">
    <h4>Q:- {{question.question}}</h4>
    <h4>Ans:- {{question.answer}}</h4>
  </div>
 </div>

<div v-if="value.wrong.hard.length > 0">
 <h3>no of wrong in <strong>hard</strong>:- {{value.wrong.hard.length}}</h3><br>
 <div v-for="(question,index) in value.wrong.hard" :key="index">
    <h4>Q:- {{question.question}}</h4>
    <h4>Ans:- {{question.answer}}</h4>
  </div>
 </div>


</div>




</div>
</div>
</template>

<script>

//import piechartComponent from './piechartComponent'
import piechartComponent from './piechartComponent.js'
var tim,dec;
function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;
    while (0 !== currentIndex) {
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex -= 1;
      temporaryValue = array[currentIndex];
      array[currentIndex] = array[randomIndex];
      array[randomIndex] = temporaryValue;
    }
    return array;
  }
 
    export default {
    props:['easy','med', 'hard', 'curr_ques'],
    components:{
        'piechart-component':piechartComponent
    },
    data(){
         return{
        answer:'',
        crrans:'',
        wrong:0,
        right:0,
        complexity:'',
        marks:0,
        quizrunning:true,
        min:'',
        sec:'',
        duration:60,
        questionsdata:{},
        progress:100,
        curques:[],
        noqs:1
        };
        },
        mounted() {
       this.startTimer(this.duration,this);
       this.curques= this.curr_ques;
       this.curques= JSON.parse(this.curques);     
       this.complexity=this.curques.complexity;
      
       },
        methods:{
               startTimer:function(timer,obj) {
                tim =    setInterval(function () {
                    obj.min = parseInt(timer / 60, 10)
                    obj.sec = parseInt(timer % 60, 10);

                    obj.min= obj.min < 10 ? "0" + obj.min : obj.min;
                    obj.sec = obj.sec < 10 ? "0" + obj.sec : obj.sec;
                    dec = 100/obj.duration;
                    obj.progress-=dec;
                    if (--timer < 0) {
                    clearInterval(tim);
                  obj.checkanswer();
                    }
                }, 1000);
            },

        checkanswer:function(){ 
                clearInterval(tim);
                var topic=this.curques.pivot.topic; 
                if(!this.questionsdata.hasOwnProperty(topic)){
                    this.questionsdata[topic]={'right':{
                                                        "easy":[],
                                                        "med":[],
                                                        "hard":[]
                                                        },
                                                "wrong":{
                                                    "easy":[],
                                                    "med":[],
                                                    "hard":[]
                                                    }
                                                };
                }       
                if(this.curques.answer == this.answer){
                    alert('correct');
                    if(this.complexity=='easy'){
                        this.questionsdata[topic]['right']["easy"].push(this.curques);
                        this.marks=this.marks+1;}
                    if(this.complexity=='medium'){
                        this.questionsdata[topic]['right']["med"].push(this.curques);
                        this.marks=this.marks+2;}
                    if(this.complexity=='hard'){
                        this.questionsdata[topic]['right']["hard"].push(this.curques);
                        this.marks=this.marks+3;}

                    this.right++;
                    this.wrong=0;
                    if(this.right>=1){
                        this.right=0;
                        this.wrong=0;
                        if(this.complexity=='easy')
                            this.complexity='medium';
                        else if(this.complexity=='medium')
                            this.complexity='hard';
                    }
            }
                else{
                    alert('wrong');
                    if(this.complexity=='easy')
                        this.questionsdata[topic]['wrong']["easy"].push(this.curques); 
                    if(this.complexity=='medium')
                        this.questionsdata[topic]['wrong']["med"].push(this.curques); 
                    if(this.complexity=='hard')     
                        this.questionsdata[topic]['wrong']["hard"].push(this.curques); 
                
                    this.wrong++;
                    this.right=0;
                if(this.wrong>=2){
                    this.right=0;
                    this.wrong=0;
                    if(this.complexity=='medium')
                        this.complexity='easy';
                    else if(this.complexity=='hard')
                        this.complexity='medium';
                }
                }
            if(this.noqs<10){
            if(this.complexity=='easy'){
            this.easy = shuffle(this.easy);
            this.curques=this.easy[0];
            this.easy.splice(0, 1);
            this.duration=30;
            }
            else if(this.complexity=='medium'){
            this.med = shuffle(this.med);
            this.curques=this.med[0];
            this.med.splice(0, 1);
            this.duration=60;
            }
            else if(this.complexity=='hard'){
            this.hard = shuffle(this.hard);
            this.curques=this.hard[0];
            this.hard.splice(0, 1);
            this.duration=90;
            }
            this.progress=100;
            this.complexity=this.curques.complexity;
            this.startTimer(this.duration,this);
            this.noqs++;
            this.answer='';
            
            }
            else{
            alert('test-over');
            this.quizrunning=false;
            this.marks=(this.marks/29)*100;
            }
                        
            }
        }
    }
</script>



