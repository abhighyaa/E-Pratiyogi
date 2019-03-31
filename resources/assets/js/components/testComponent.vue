<template>
<div>
    
   <div v-if="quizrunning" class='quesblock' style="max-width:700px;margin-top:50px;margin-left:24%">
   <div >
        <div class="duration">
            <div class="progress">
                <div class="progress-bar" v-bind:style="{width:progress+'%' }"></div>
            </div>
             <div class="timer">{{min}}:{{sec}}</div>
             <span class="complexity" >{{complexity}}</span>
        </div>
    </div>
       

        
        <div class="ques"><span id="questionNum">Q{{noqs}}</span>. {{curques.question}}</div>
        <div v-for="value in curques.choices" :key="value">
        <input type="radio"  v-bind:value="value" v-model="answer">&nbsp;{{ value }}
        </div>
        <button class="submitButton btn btn-success" @click='checkanswer'>submit</button>

        </div>

    <div v-if="quizrunning == false">

    <h1>YOUR PERCENT = <b style="color:green;">{{marks}}% </b></h1>
    <h1 class="mt-3"> TEST REPORT:</h1>
    <piechart-component :value="questionsdata" :type="'marks'">
        
    </piechart-component>
   <h3 style="text-align:center;">TOPIC WISE MARKS DISTRIBUTION</h3> 
    
    <piechart-component :value="questionsdata" :type="'rights'"></piechart-component>
        
   <h3 style="text-align:center;">TOPIC WISE RIGHT QUESTIONS</h3> 
    
    
   <piechart-component :value="questionsdata" :type="'wrongs'">
        
    </piechart-component>
   <h3 style="text-align:center;">TOPIC WISE WRONG QUESTIONS</h3> 
 <hr>
    <h1 style="text-align:center;">DETAILED TEST REPORT:</h1>
     
    <div v-for="(value, key, index) in questionsdata" :key="index">
    <h2><strong>TOPIC NAME:-"{{ key }}"</strong></h2> <br>
    <div v-if="value.right.low.length + value.wrong.low.length > 0">
    <h3>No of questions in <strong>low</strong>:- {{value.right.low.length + value.wrong.low.length }}</h3>
    <h3>out of them no of rights :-{{value.right.low.length}} (marks {{value.right.low.length}})</h3>
    <h3> and no of wrong :- {{value.wrong.low.length}}</h3> 
 </div>

 <div v-if="value.right.med.length + value.wrong.med.length > 0">
 <h3>No of questions in <strong>medium</strong>:- {{value.right.med.length + value.wrong.med.length}}</h3>
 <h3>out of them no of rights :-{{value.right.med.length}}(marks {{value.right.med.length*2}})</h3>
 <h3>and no of wrong :- {{value.wrong.med.length}}</h3>
 </div>

 <div v-if="value.right.high.length + value.wrong.high.length > 0">
 <h3>No of questions in <strong>high</strong>:- {{value.right.high.length + value.wrong.high.length }}</h3>
 <h3>out of them no of rights :-{{value.right.high.length}}(marks {{value.right.high.length*3}})</h3>
 <h3>and no of wrong :- {{value.wrong.high.length}}</h3>
 </div>
 
</div>
<hr>
<h1>TOPIC AND COMPLEXITY WISE WRONG QUESTION ANSWERS</h1>

<div v-for="(value, key, index) in questionsdata" :key="index">
 <h2 v-if="value.wrong.low.length >0|| value.wrong.med.length >0|| value.wrong.high.length >0"><strong>TOPIC NAME:-"{{ key }}"</strong></h2> <br>
 <div v-if="value.wrong.low.length > 0">
 <h3>no of wrong in <strong>low</strong>:- {{value.wrong.low.length}}</h3><br/>
 <div v-for="(question,index) in value.wrong.low" :key="index">
    <h4><b style="color:black;">Q:-</b> {{question.question}}</h4>
    <h4><b style="color:skyblue;">Ans:-</b> {{question.answer}}</h4>
  </div>
 </div>

 <div v-if="value.wrong.med.length > 0">
 <h3>no of wrong in <strong>med</strong>:- {{value.wrong.med.length}}</h3><br>
 <div v-for="(question,index) in value.wrong.med" :key="index">
    <h4><b style="color:black;">Q:-</b>{{question.question}}</h4>
    <h4><b style="color:skyblue;">Ans:-</b> {{question.answer}}</h4>
  </div>
 </div>

<div v-if="value.wrong.high.length > 0">
 <h3>no of wrong in <strong>high</strong>:- {{value.wrong.high.length}}</h3><br>
 <div v-for="(question,index) in value.wrong.high" :key="index">
    <h4><b style="color:black;">Q:-</b> {{question.question}}</h4>
    <h4><b style="color:skyblue;">Ans:-</b> {{question.answer}}</h4>
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
    props:['low','med', 'high', 'curr_ques'],
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
        question:'',
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
       this.curques= this.curques;     
       this.complexity=this.curques.complexity;
      
       },
        methods:{
               startTimer:function(timer,obj) {
                tim = setInterval(function () {
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
                console.log(this.curques);
                console.log(this.curques.pivot);
                var topic=this.curques.pivot.category; 
                if(!this.questionsdata.hasOwnProperty(topic)){
                    this.questionsdata[topic]={'right':{
                                                        "low":[],
                                                        "med":[],
                                                        "high":[]
                                                        },
                                                "wrong":{
                                                    "low":[],
                                                    "med":[],
                                                    "high":[]
                                                    }
                                                };
                }       
                if(this.curques.answer == this.answer){
                    // alert('correct');
                    if(this.complexity=='low'){
                        this.questionsdata[topic]['right']["low"].push(this.curques);
                        this.marks=this.marks+1;}
                    if(this.complexity=='medium'){
                        this.questionsdata[topic]['right']["med"].push(this.curques);
                        this.marks=this.marks+2;}
                    if(this.complexity=='high'){
                        this.questionsdata[topic]['right']["high"].push(this.curques);
                        this.marks=this.marks+3;}

                    this.right++;
                    this.wrong=0;
                    if(this.right>=1){
                        this.right=0;
                        this.wrong=0;
                        if(this.complexity=='low')
                            this.complexity='medium';
                        else if(this.complexity=='medium')
                            this.complexity='high';
                    }
            }
                else{
                    // alert('wrong');
                    if(this.complexity=='low')
                        this.questionsdata[topic]['wrong']["low"].push(this.curques); 
                    if(this.complexity=='medium')
                        this.questionsdata[topic]['wrong']["med"].push(this.curques); 
                    if(this.complexity=='high')     
                        this.questionsdata[topic]['wrong']["high"].push(this.curques); 
                
                    this.wrong++;
                    this.right=0;
                if(this.wrong>=2){
                    this.right=0;
                    this.wrong=0;
                    if(this.complexity=='medium')
                        this.complexity='low';
                    else if(this.complexity=='high')
                        this.complexity='medium';
                }
                }
            if(this.noqs<10){
            if(this.complexity=='low'){
            this.low = shuffle(this.low);
            this.curques=this.low[0];
            this.low.splice(0, 1);
            this.duration=30;
            }
            else if(this.complexity=='medium'){
            this.med = shuffle(this.med);
            this.curques=this.med[0];
            this.med.splice(0, 1);
            this.duration=60;
            }
            else if(this.complexity=='high'){
            this.high = shuffle(this.high);
            this.curques=this.high[0];
            this.high.splice(0, 1);
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
<style scoped>
strong {
        font-weight: bolder;
    margin-left: 15px;
    color: blue;
}
.quesblock{
    background: white;
    padding: 20px;
    min-height: 40vh;
    font-size: 20px;
    font-family: initial;
}
.duration{
    padding: 5px;
}
.progress,.timer{
    display: inline-flex;
}
.progress{
    width: 88%;
}
.timer{
    width:fit-content;
    margin-left: 5px;
    font-size: 26px;
}
.ques{
    font-size: 22px;
    margin-bottom: 10px;
}
#questionNum{
    font-weight: bold;
}
.submitButton{
    text-transform: capitalize;
    margin: 5px;
    margin-left: 45%;
}
.complexity{
    float:right;
    margin-right:5px;
    background:lavender;
    color: rgba(0,0,0,0.7);
    text-transform: capitalize;
    font-family: sans-serif;
    padding: 0px 5px 0px 5px;
    border-radius: 14px;
    margin-right: 14px;
}
h3
{
    margin-left: 15px;
}
h1 {
    margin-left: 15px;
    color: grey;
    font-size: 2.25rem;
}
h4 {
    margin-left: 15px;
    font-size: 1.35rem;
}
</style>



