<template>
<div>
<div v-if='code == 0'>
      <button class="submitButton btn btn-success" @click='checkanswer' id='testfinish'>Submit Test</button>
</div>
<div v-if='code == 1'>
      <button class="submitButton btn btn-success" @click='checkanswer' id='testfinish'>Next Section</button>

</div>
      <button class="submitButton btn btn-success" @click='checkanswerr' id='testfinishh' style='display:none'>Submit Test</button>
       <div class="timer">{{min}} min:{{sec}} sec</div>
        
<div class='quesblock'>
    
      <div class="ques">
          <span id="questionNum">Qno:- {{qno+1}}))</span> 
           {{curques.question}}    
           <span class="complexity" >{{curques.complexity}}</span>
           
      </div>
        <template v-if="curques.type == 'mcq' ">
        <div v-for="value in  JSON.parse(curques.choices)" :key="value">
        <input type="radio"  v-bind:value="value" v-model="answer" @change="changedanswer()">&nbsp;{{ value }}
        </div>
      </template>  
    <template v-if="curques.type == 'fub' ">
        <input type="text" v-model="answer" @change="changedanswer()">
      </template> 
<div class='buttons'>
        <button class="btn btn-secondary" @click='previous'>previous</button>
        <button class="btn btn-secondary" @click='next' >next</button>
        <button class="btn btn-secondary" @click='clearresponse' >clear response</button>
        
        <button class="btn btn-secondary" @click='togglereview(true)' ref="rev">Mark for review</button>
        
        <button class="btn btn-secondary" @click='togglereview(false)' ref="nrev">remove review</button>
</div> 
</div>


<div class='quespanel'>
       <div>
           <span class='navcircle'>$</span>not visited
           <span class='navcircle' style="background:red">$</span>visited
            <br>
            <span class='navcircle' style="background:rgb(30, 209, 194)">$</span>review
            <span class='navcircle' style="background:green">$</span>answered
            <br>
            <span class='navcircle' style="background:purple">$</span>review & answered
                  
       </div>
       <hr>
        <div class='noofcrl'>
        <span v-for="(item, index) in questions" :key="index" @click='navigate(index)' class='navcircle' ref="el">
        {{index+1}}
        </span>
        </div>
</div>




</div>
</template>


<script>
 var tim,arq;
    export default {
    name:"teachertest-component",
    props:['test','questions','email','code','code_id'],
    data(){
         return{
    curques:'',
    qno:0,
    answer:'',
    attempt:[],
    total:0,
    marks:0,
    per:0,
    status:[],//notvisited=0;visited=1;review=2;reviewans=3;answered=4
    review:[],
    min:0,
    sec:0,
    duration:'',
    time:0,
    low:[],
    med:[],
    high:[],
    id:0
         }
    },created() {
    document.addEventListener('beforeunload', this.handler)
     },
        mounted() {
            this.id=this.test.id;
            this.$refs.el[0].style.background='red';
            for(var cnt=0, clow=0,cmed=0,chigh=0;cnt<this.questions.length;cnt++){
                this.status[cnt]=0;
                this.review[cnt]=false;
                this.attempt[cnt]='';
                 if(this.questions[cnt].complexity == 'low')
                    this.low[clow++]=this.questions[cnt];
                 else if(this.questions[cnt].complexity == 'medium')
                    this.med[cmed++]=this.questions[cnt];
                 else if(this.questions[cnt].complexity == 'high')
                    this.high[chigh++]=this.questions[cnt];
            } 
            this.$refs.nrev.style.display='none';
            this.duration = this.test.duration.split(':');
            this.hrs = Number(this.duration[0]); 
            this.min = Number(this.duration[1]);
            this.sec = Number(this.duration[2]);
            this.time = this.hrs*60*60+this.min*60+this.sec;
            this.startTimer(this.time,this);
            this.questions = this.low.concat(this.med,this.high);  
            this.curques = this.questions[0];
            this.attemptrequest(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
                type : "post",
                url : "/addquestionsmounted",
                data: {
                ques:this.questions,
                email:this.email,
                id:this.id
                },
                success : function(response) {
                    console.log('request');
                    console.log(response.test);
                }
            });

          console.log(this.questions);
   
    },
     methods:{
            handler: function handler(event) {
                    console.log('hiii unload')
            },
         startTimer:function(timer,obj) {
                tim = setInterval(function () {
                    obj.min = parseInt(timer/ 60, 10);
                    obj.sec = parseInt(timer % 60, 10);
                    obj.min= obj.min < 10 ? "0" + obj.min : obj.min;
                    obj.sec = obj.sec < 10 ? "0" + obj.sec : obj.sec;
                    --this.time;
                    if (--timer < 0) {
                    clearInterval(tim);
                    clearInterval(arq);
                  $(window).off("beforeunload");
                  obj.checkanswer();
                    }
                }, 1000);
            },
            attemptrequest:function(obj) {
                arq = setInterval(function () {
                   
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                    $.ajax({
                        type : "post",
                        url : "/savetime",           //dekhna h??
                        data: {
                        min:obj.min,
                        sec:obj.sec,
                        email:obj.email,
                        id:obj.id
                        },
                        success : function(response) {
                            console.log(response);
                        }
                    });
                            
                   
                   
                }, 5000);
            },
  
       next:function(){ 
          //  this.attempt[this.qno]=this.answer;
            if(this.qno<this.questions.length-1){
                this.qno++;
                this.curques = this.questions[this.qno];   
            }
            else{
                this.qno = 0;
                this.curques = this.questions[this.qno];
            }
            if(typeof this.attempt[this.qno] === 'undefined') {
                    this.answer = "";
                }
            else {
            this.answer = this.attempt[this.qno];  
            }
            this.togglereview(this.review[this.qno]);   
       //    this.changenavclass();
            console.log(this.attempt);
        
       },
       previous:function(){ 
       //     this.attempt[this.qno]=this.answer;
        if(this.qno == 0){
                this.qno = this.questions.length-1;
                this.curques = this.questions[this.qno];   
            }
            else{
                this.qno--;
                this.curques = this.questions[this.qno];
            }
            if(typeof this.attempt[this.qno] === 'undefined') {
                this.answer = "";
            }
            else {
            this.answer = this.attempt[this.qno];  
            } 
             this.togglereview(this.review[this.qno]);   
           ///this.changenavclass();
           
            console.log(this.attempt);
         
        },
        totalmarks:function(){
             for(var cnt=0;cnt<this.questions.length;cnt++){
                  
                  if(this.questions[cnt].complexity == 'low'){
                        this.total+=1;
                    }
                    else if(this.questions[cnt].complexity == 'medium'){
                        this.total+=2;
                    }
                    else if(this.questions[cnt].complexity == 'high'){
                        this.total+=3;
                    }
             }
             return this.total;
        },
       checkanswer:function(){ 
        this.marks=0;
        this.total=0;
        clearInterval(tim);
        clearInterval(arq);
 
        this.total=this.totalmarks();
        for(var cnt=0;cnt<this.questions.length;cnt++){
            if(this.questions[cnt].type == 'mcq'){
                if(this.questions[cnt].answer == this.attempt[cnt]){
                    if(this.questions[cnt].complexity == 'low'){
                        this.marks+=1;
                    }
                    else if(this.questions[cnt].complexity == 'medium'){
                        this.marks+=2;
                    }
                    else if(this.questions[cnt].complexity == 'high'){
                        this.marks+=3;
                    }
                }
              
            }

        else if(this.questions[cnt].type == 'fub'){
             if(typeof this.attempt[cnt] === 'undefined') {
                continue;
            }
             if(this.questions[cnt].answer.toLowerCase() == this.attempt[cnt].toLowerCase()){
                    if(this.questions[cnt].complexity == 'low'){
                        this.marks+=1;
                    }
                    else if(this.questions[cnt].complexity == 'medium'){
                        this.marks+=2;
                    }
                    else if(this.questions[cnt].complexity == 'high'){
                        this.marks+=3;
                    }
                }
              
            }
            
        }
       
            if(this.code == 1){
            $(window).off("unload");
            
                this.per = (this.marks/this.total)*100;
                var idd;
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
                type : "post",
                url : "/savesection",         
                data: {
                email:this.email,
                per:this.per,
                id:this.id,
                code:this.code_id
                },
                success : function(response) {
                        location.replace("/teacher/coding/"+response[0]+'/'+response[1]);    
     
                }
            });
          
            }
            else{
            this.per = (this.marks/this.total)*100;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
                type : "post",
                url : "/saveresults",         
                data: {
                email:this.email,
                per:this.per,
                id:this.id
                },
                success : function(response) {
                    console.log(response);
                }
            });
            location.replace("/results/"+this.id+"/"+this.email);
            }
     },
     checkanswerr:function(){ 
        this.marks=0;
        this.total=0;
        clearInterval(tim);
        clearInterval(arq);
 
        this.total=this.totalmarks();
        for(var cnt=0;cnt<this.questions.length;cnt++){
            if(this.questions[cnt].type == 'mcq'){
                if(this.questions[cnt].answer == this.attempt[cnt]){
                    if(this.questions[cnt].complexity == 'low'){
                        this.marks+=1;
                    }
                    else if(this.questions[cnt].complexity == 'medium'){
                        this.marks+=2;
                    }
                    else if(this.questions[cnt].complexity == 'high'){
                        this.marks+=3;
                    }
                }
              
            }

        else if(this.questions[cnt].type == 'fub'){
             if(typeof this.attempt[cnt] === 'undefined') {
                continue;
            }
             if(this.questions[cnt].answer.toLowerCase() == this.attempt[cnt].toLowerCase()){
                    if(this.questions[cnt].complexity == 'low'){
                        this.marks+=1;
                    }
                    else if(this.questions[cnt].complexity == 'medium'){
                        this.marks+=2;
                    }
                    else if(this.questions[cnt].complexity == 'high'){
                        this.marks+=3;
                    }
                }
              
            }
            
        }
       
            this.per = (this.marks/this.total)*100;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
                type : "post",
                url : "/saveresults",         
                data: {
                email:this.email,
                per:this.per,
                id:this.id
                },
                success : function(response) {
                    console.log(response);
                }
            });
            
     },
       changedanswer:function(val){
            this.attempt[this.qno]=this.answer;
            if(this.status[this.qno]==2 || this.status[this.qno]==3)
                this.status[this.qno] = 3;
           else
            this.status[this.qno] = 4;
            this.changenavclass();
      
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
                type : "post",
                url : "/saveattempt",          //sochna h status or attempt ka   ?
                data: {
                attempt:this.attempt,
                min:this.min,
                sec:this.sec,
                id:this.id,
                email:this.email
                },
                success : function() {
                    console.log('ajax request send');
                }
            });
       },

       navigate:function(index){
        this.curques = this.questions[index];    
        this.qno = index;
        this.togglereview(this.review[this.qno]);   
    //   this.changenavclass();
        
         if(typeof this.attempt[this.qno] === 'undefined') {
                this.answer = "";
            }
            else {
            this.answer = this.attempt[this.qno];  
            }
       },
       clearresponse:function(){
           this.answer='';
           this.attempt[this.qno]=this.answer;
          console.log(this.status);
          if(this.status[this.qno] == 4 ){
                     this.status[this.qno]=1;
                 }
           if(this.status[this.qno] == 3 ){
                     this.status[this.qno]=2;
                 }
          this.changenavclass();                    //sochna h
       
       },
        changenavclass:function(){
                  if(this.status[this.qno]<2){
                this.status[this.qno] = 1;
                this.$refs.el[this.qno].style.background='red';
            }
             else if(this.status[this.qno]==2)
               this.$refs.el[this.qno].style.background='rgb(30, 209, 194)';
             else if(this.status[this.qno]==3)
               this.$refs.el[this.qno].style.background='purple';
                else if(this.status[this.qno]==4)
               this.$refs.el[this.qno].style.background='green';
              
              $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                    $.ajax({
                        type : "post",
                        url : "/savest_at",           //dekhna h??
                        data: {
                        min:this.min,
                        sec:this.sec,
                        email:this.email,
                        review:this.review,
                        status:this.status,
                        id:this.id
                        },
                        success : function(response) {
                            console.log(response);
                        }
                    });
                    

        },
       togglereview:function(val){
         
           if(val == true){
                 this.review[this.qno] =true;
                 if(typeof this.attempt[this.qno] === 'undefined' || this.attempt[this.qno] == ""){
                     this.status[this.qno]=2;
                 }
                 else{
                     this.status[this.qno]=3;
                 }
                this.$refs.nrev.style.display='inline';
                 this.$refs.rev.style.display='none';
          
           }
           else{
               if(typeof this.attempt[this.qno] === 'undefined' || this.attempt[this.qno] == "" ){
                     this.status[this.qno]=1;
                 }
                 else{
                     this.status[this.qno]=4;
                 }
                this.review[this.qno] =false; 
                 this.$refs.nrev.style.display='none'; 
                 this.$refs.rev.style.display='inline';
 
            }
            this.changenavclass();
            console.log(this.status)
        }

     }
    }
</script>

<style>

.navcircle{
    height: 70px;
    width: 70px;
    border-radius: 50%; 
    display: inline-block;
    padding-left:30px;
    padding-top:10px;
    font-size:20px;
    background: #bbb;
}
.buttons{
    margin-top:2%;
}
.quespanel{
    width:300px;
    height:650px;
    background:rgb(112, 168, 214);
    padding:20px;
    position:absolute;
    top:200px;
    right:5px;

}

.quesblock{
    /* background: white; */
    padding: 20px;
    min-height: 40vh;
    font-size: 20px;
    font-family: initial;
    margin-top:5%;
    padding-left:100px;
}

.ques{
    font-size: 22px;
    margin-bottom: 10px;
}
#questionNum{
    font-weight: bold;
}
.complexity{
    margin-left:5px;
    background:rgb(77, 76, 76);
    color: rgba(0,0,0,0.7);
    text-transform: capitalize;
    font-family: sans-serif;
    padding: 0px 5px 0px 5px;
    border-radius: 14px;
    margin-right: 14px;
    color:white;
}
.timer{
    width:fit-content;
    margin-right: 5px;
    margin-top: 5px;
    font-size: 20px;
    position:absolute;
    right:10px; 
    top:60px;
}

.submitButton{
    position:absolute;
    right:20px;
    top:20px
}

.noofcrl{
    max-height:350px;
    overflow:auto;
}
</style>    