<template>
    <div>
        <div class="card card-default">
            <div class="card-header">Details</div>
            <div class="card-body">
                <ul v-if='showcategories'>
                    <li :key="cat.id" v-for="cat in categories">
                        <button @click="edittest=false;showque(cat.id,subject)">{{ cat.category }}</button>
                        <br><br>
                    </li>
                </ul>

                <div v-if="showquestions">
                    <button v-if="addtest" @click="addquetotest=true;edittest=true;showquestions=false;quetest['test']=testname">Add Questions to test</button>
                    <button v-else @click="addque(subject,category)">Add questions</button>
                    <br><br>
                    <div v-if="questions.length">
                        <div v-for="question in questions">
                            <div class="question">{{question.question}} 
                                <div class="float-right" v-if="addtest">
                                    <button @click="geteditque(question.id)">Edit</button>
                                    <button @click="deletequetest(question.id)">Delete</button>
                                </div>
                                <div class="float-right" v-else>
                                    <button @click="geteditque(question.id)">Edit</button>
                                    <button @click="deleteque(question.id)">Delete</button>
                                </div>
                            </div>
                            
                            <div v-if="question.type=='mcq'" v-for="i in question.choices">
                                <div class="choices"><input type="radio" :name="question.id" :checked="i==question.answer">&nbsp;&nbsp;{{i}}</div>
                            </div>
                            <div v-if="question.type=='check'" v-for="i in question.choices">
                                <div class="choices"><input type="checkbox" :name="question.id" v-model="checkanswer">&nbsp;&nbsp;{{i}}</div>
                            </div>
                            <div v-if="question.type=='fub'">
                                <div class="answer">Answer : {{question.answer}}</div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div v-else>No Questions yet</div>
                </div>

                <div v-if="editquestion">
                    <form method="POST" v-on:submit.prevent="editque">
                        <div class="form-group row ml-2">
                                <label for="question">Question</label>

                                <div class="col-md-6">
                                    <input type="text" v-model="equestion.question" autofocus>
                                </div>
                            
                        </div>
                        <div class="form-group row ml-2" v-for="(i,index) in equestion.choices">
                            <input type="radio" name="answer" v-model="equestion.answer" :value="i" :checked="i==equestion.answer">&nbsp;&nbsp;
                            <input type="text"  v-model="equestion.choices[index]" required><br>
                            <!--<p v-if="index>1"><a @click="editdeletechoice(index,equestion.choices,equestion.id)">Delete</a></p>-->
                        </div>
                        <div v-if="equestion.type=='mcq'" v-for="(input, index) in inputs">
                            <input type="radio" name="answer" v-model="equestion.answer" v-bind:value='equestion["choice"+index+3]'>  
                            <input type="text" v-model='equestion["choice"+index+3]' required>
                            <a @click="deletechoice(index)">Delete</a>
                        </div>
                        
                        <div v-if="equestion.type=='check'" v-for="(input, index) in inputs">
                            <input type="checkbox" name="answer" v-model="equestion.answer" v-bind:value='equestion["choice"+index+3]'>  
                            <input type="text" v-model='equestion["choice"+index+3]' required>
                            <a @click="deletechoice(index)">Delete</a>
                        </div>

                        <div v-if="equestion.type=='fub'">
                            <input type="text" v-model='equestion["answer"]' required>
                        </div>
                        <a @click="addchoices()">Add more choices</a>
                        <button>Edit</button>
                    </form>
                </div>

                <div v-if="addquestion">
                    <form method="POST" v-on:submit.prevent="saveque">
                        <div class="form-group row ml-2">
                            <label for="subject">Subject</label>

                            <div class="col-md-6">
                                <input type="text" v-model='add["sub"]' disabled>
                            </div>
                        </div>
                        <div class="form-group row ml-2">
                            <label for="category">Category</label>

                            <div class="col-md-6">
                                <input type="text" v-model='add["cat"]' disabled>
                            </div>
                        </div>

                        <div class="form-group row ml-2">
                            <label for="type">Type of Question</label>
                            <div class="col-md-6">
                                <select v-model='add["type"]'>
                                    <option value="mcq" >mcq</option>
                                    <option value="check">check box</option>
                                    <option value="fub">Fill in the blanks</option>
                                </select>
                                <!--<input type="text" v-model='add["type"]' required autofocus>-->
                            </div>
                        </div>

                        <div class="form-group row ml-2">
                            <label for="question">Question</label>
                            <div class="col-md-6">
                                <input type="text" v-model='add["question"]' required autofocus>
                            </div>
                        </div>

                        <div class="form-group row ml-2">
                            <label for="complexity">Complexity</label>
                            <div class="col-md-6">
                                <!--<input type="text" list="comp" v-model='add["complexity"]' autocomplete="on">-->
                                    <select id="comp" v-model='add["complexity"]'>
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                            </div>
                        </div>
                        
                        <div class="form-group row ml-2">
                            <label for="choices"></label>
                            <div class="col-md-6" v-if='add["type"]=="mcq"'>
                                <input type="radio" name="answer" v-model="add.answer" v-bind:value='add["choice1"]' checked><input type="text"  v-model='add["choice1"]' required><br>
                                <input type="radio" name="answer" v-model="add.answer" v-bind:value='add["choice2"]'>
                                <input type="text" v-model='add["choice2"]' required>
                                <div v-for="(input, index) in inputs">
                                    <input type="radio" name="answer" v-model="add.answer" v-bind:value='add["choice"+index+3]'>  
                                    <input type="text" v-model='add["choice"+index+3]' required>
                                    <a @click="deletechoice(index)">Delete</a>
                                </div>
                                <a @click="addchoices()">Add more choices</a>
                            </div>
                            <div class="col-md-6" v-if='add["type"]=="check"'>
                                <input type="checkbox"   v-model='checkanswer' v-bind:value='add["choice1"]'><input type="text"  v-model='add["choice1"]' required><br>
                                <input type="checkbox"  v-model='checkanswer' v-bind:value='add["choice2"]'>
                                <input type="text" v-model='add["choice2"]' required>
                                <div v-for="(input, index) in inputs">
                                    <input type="checkbox" v-model='checkanswer' v-bind:value='add["choice"+index+3]'>  
                                    <input type="text" v-model='add["choice"+index+3]' required>
                                    <a @click="deletechoice(index)">Delete</a>
                                </div>
                                <a @click="addchoices()">Add more choices</a>
                            </div>
                            <div class="col-md-6" v-if='add["type"]=="fub"'>
                                <label>Answer</label>
                                <input type="text"   v-model='add.answer'><br>
                            </div>
                        </div>
                        
                        
                        <button>Save</button>
                    </form>
                </div>

                <div v-if="createtst">
                    <form method="POST" v-on:submit.prevent="create">
                        <div class="form-group row ml-2">
                            <label for="test">Test</label>

                            <div class="col-md-6">
                                <input type="text" v-model='crtest'>
                            </div>
                        </div>
                        <button>Create</button>
                    </form>
                </div>

                <div v-if="addquetotest">
                    <form method="POST" v-on:submit.prevent="savequetest">
                        <div class="form-group row ml-2">
                            <label for="test">Test</label>

                            <div class="col-md-6">
                                <input type="text" v-model='quetest["test"]' disabled>
                            </div>
                        </div>

                        <div class="form-group row ml-2">
                            <label for="type">Type of Question</label>
                            <div class="col-md-6">
                                <select v-model='quetest["type"]'>
                                    <option value="mcq" >mcq</option>
                                    <option value="check">check box</option>
                                    <option value="fub">Fill in the blanks</option>
                                </select>
                                <!--<input type="text" v-model='add["type"]' required autofocus>-->
                            </div>
                        </div>

                        <div class="form-group row ml-2">
                            <label for="question">Question</label>
                            <div class="col-md-6">
                                <input type="text" v-model='quetest["question"]' required autofocus>
                            </div>
                        </div>

                        <div class="form-group row ml-2">
                            <label for="complexity">Complexity</label>
                            <div class="col-md-6">
                                <!--<input type="text" list="comp" v-model='add["complexity"]' autocomplete="on">-->
                                    <select id="comp" v-model='quetest["complexity"]'>
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                            </div>
                        </div>
                        
                        <div class="form-group row ml-2">
                            <label for="choices"></label>
                            <div class="col-md-6" v-if='quetest["type"]=="mcq"'>
                                <input type="radio" name="answer" v-model="quetest.answer" v-bind:value='quetest["choice1"]' checked>
                                <input type="text"  v-model='quetest["choice1"]' required><br>
                                <input type="radio" name="answer" v-model="quetest.answer" v-bind:value='quetest["choice2"]'>
                                <input type="text" v-model='quetest["choice2"]' required>
                                <div v-for="(input, index) in inputs">
                                    <input type="radio" name="answer" v-model="quetest.answer" v-bind:value='quetest["choice"+index+3]'>  
                                    <input type="text" v-model='quetest["choice"+index+3]' required>
                                    <a @click="deletechoice(index)">Delete</a>
                                </div>
                                <a @click="addchoices()">Add more choices</a>
                            </div>
                            <div class="col-md-6" v-if='quetest["type"]=="check"'>
                                <input type="checkbox"   v-model='checkanswer' v-bind:value='quetest["choice1"]'>
                                <input type="text"  v-model='quetest["choice1"]' required><br>
                                <input type="checkbox"  v-model='checkanswer' v-bind:value='quetest["choice2"]'>
                                <input type="text" v-model='quetest["choice2"]' required>
                                <div v-for="(input, index) in inputs">
                                    <input type="checkbox" v-model='checkanswer' v-bind:value='quetest["choice"+index+3]'>  
                                    <input type="text" v-model='quetest["choice"+index+3]' required>
                                    <a @click="deletechoice(index)">Delete</a>
                                </div>
                                <a @click="addchoices()">Add more choices</a>
                            </div>
                            <div class="col-md-6" v-if='quetest["type"]=="fub"'>
                                <label>Answer</label>
                                <input type="text"   v-model='quetest.answer'><br>
                            </div>
                        </div>
                        
                        
                        <button>Add question</button>
                    </form>
                </div>

                <div v-if="viewtst" v-for="test in tests">
                    <a href="#" @click="testdetails(test.id)">{{test.test}}</a>
                    <p class="float-right">
                        <button @click="distributetest(test.id)">Distribute</button>
                        <button @click="deletetest(test.id)">Delete</button>
                    </p>
                    <br><br>
                    <hr>
                </div>
            </div>
        </div>  
    
    </div>
</template>

<script>
    import { EventBus } from '../app.js'
    export default {
        data(){
            return{
                categories:[],
                subject:null,
                category:null,
                sub:'',
                cat:'',
                questions:[],
                equestion:[],
                add:[],
                question:'',
                showcategories:true,
                showquestions:false,
                editquestion:false,
                addtest:false,
                addquestion:false,
                createtst:false,
                addquetotest:false,
                viewtst:false,
                choices:[],
                inputs:[],
                answers:[],
                tests:[],
                test:[],
                testname:null,
                testid:'',
                quetest:[],
                crtest:'',
                edittest:false,
            };
        },
        mounted(){
            EventBus.$on('Category', data => {
                this.categories = data.categoriesKey;
                this.subject =  data.subjectKey;
                this.showcategories = data.showcategoriesKey;
                this.showquestions = data.showquestionsKey;
                this.editquestion = data.showquestionKey;   
                this.addquestion=data.addquestionKey;
                this.createtst=data.createtstKey;
                this.viewtst=data.viewtstKey;
                this.addquetotest=data.addquetotestKey;
                this.addtest=data.addtestKey;
            });
            EventBus.$on('test', data => {
                this.categories = data.categoriesKey;
                this.showcategories = data.showcategoriesKey;
                this.showquestions = data.showquestionsKey;
                this.editquestion = data.showquestionKey;   
                this.addquestion=data.addquestionKey;
                this.createtst=data.createtstKey;
                this.viewtst=data.viewtstKey;
                this.addquetotest=data.addquetotestKey;
                this.addtest=data.addtestKey;
                this.edittest=data.edittestKey;
            });
            EventBus.$on('viewtest', data => {
                this.categories = data.categoriesKey;
                this.tests = data.testsKey;
                this.showcategories = data.showcategoriesKey;
                this.showquestions = data.showquestionsKey;
                this.editquestion = data.showquestionKey;   
                this.addquestion=data.addquestionKey;
                this.createtst=data.createtstKey;
                this.viewtst=data.viewtstKey;
                this.addquetotest=data.addquetotestKey;
                this.addtest=data.addtestKey;
                this.edittest=data.edittestKey;
            });
        },
        methods:{
            async showque(cid,sid){
                await axios.get('/teacher/questions/'+cid+'/'+sid)
                .then((response)=>(this.questions = response.data))
                .catch(function(error){console.log(error)});
                this.category=cid;
                this.showcategories=false;
                this.editquestion=false;
                this.showquestions=true;
                this.addquestion=false;
                this.createtst=false;
                this.viewtst=false;
                this.addquetotest=false;
                this.addtest=false;
            },
            async geteditque(qid){
                await axios.get('/teacher/editquestion/'+qid)
                .then((response)=>(this.equestion = response.data))
                .catch(function(error){console.log(error)});
                this.showcategories=false;
                this.editquestion=true;
                this.showquestions=false;
                this.addquestion=false;
                this.createtst=false;
                this.viewtst=false;
                this.addquetotest=false;
                this.addtest=false;
            },
            async editque(){
                for(var index=0;index<this.inputs.length;index++){
                    this.equestion.choices.push(this.equestion['choice'+index+3]);
                }
                await axios.post('/teacher/saveedits', {
                    id:this.equestion.id,
                    question:this.equestion.question,
                    answer:this.equestion.answer,
                    choices:this.equestion.choices,
                })
                .then((response) =>(alert("Edit saved")))
                .catch(function (error){console.log(error)});
                this.choices=[];
                this.inputs=[];
                alert(this.edittest)
                 if(this.edittest==true){
                     alert('true')
                     this.testdetails(this.testid)
                }
                else{
                    this.showque(this.category,this.subject)
                }
            },
            async deleteque(qid){
                await axios.get('/teacher/delete/'+qid)
                .then((response)=>(alert('Deleted')),
                this.showque(this.category,this.subject))
                .catch(function(error){console.log(error)});
                
                this.showcategories=false;
                this.addtest=false;
                this.editquestion=false;
                this.showquestions=true;
                this.addquestion=false;
                this.createtst=false;
                this.viewtst=false
                this.addquetotest=false;
            },
            async deletetest(tid){
                await axios.get('/teacher/testdelete/'+tid)
                .then((response)=>(alert('Deleted')))
                .catch(function(error){console.log(error)});
                
                this.showcategories=false;
                this.addtest=false;
                this.editquestion=false;
                this.showquestions=false;
                this.addquestion=false;
                this.createtst=false;
                this.viewtst=true;
                this.addquetotest=false;
                EventBus.$emit('View');
            },
            async deletequetest(qid){
                await axios.get('/teacher/delete/'+qid)
                .then((response)=>(alert('Deleted')),)
                .catch(function(error){console.log(error)});
                
                this.showcategories=false;
                this.addtest=false;
                this.editquestion=false;
                this.showquestions=true;
                this.addquestion=false;
                this.createtst=false;
                this.viewtst=false
                this.addquetotest=false;
                this.testdetails(this.testid)
            },
            async addque(sid,cid){
                await axios.get('/teacher/getsubcat/'+sid+'/'+cid)
                .then((response)=>(this.add.sub=response.data[0].subject,
                    this.add.cat=response.data[1].category))
                .catch(function(error){console.log(error)});
                
                this.showcategories=false;
                this.editquestion=false;
                this.showquestions=false;
                this.addquestion=true;
                this.createtst=false;
                this.viewtst=false;
                this.addquetotest=false;
                this.addtest=false;
            },
            async saveque(){
                
                if(this.add["type"]=="mcq"){
                    this.choices.push(this.add.choice1);
                    this.choices.push(this.add['choice2'])  ;
                
                    for(var index=0;index<this.inputs.length;index++){
                        this.choices.push(this.add['choice'+index+3]);
                    }
                    await axios.post('/teacher/savequestion', {
                        question:this.add.question,
                        answer:this.add.answer,
                        subject:this.add.sub,
                        complexity:this.add.complexity,
                        category:this.add.cat,
                        choices:this.choices,
                        type:this.add.type,
                    })
                    .then((response)=>(alert('Question added')),
                    this.showque(this.category,this.subject))
                    .catch(function(error){console.log(error)});
                }
                else if(this.add["type"]=="check"){
                    this.choices.push(this.add.choice1);
                    this.choices.push(this.add['choice2'])  ;
                
                    for(var index=0;index<this.inputs.length;index++){
                        this.choices.push(this.add['choice'+index+3]);
                    }
                    await axios.post('/teacher/savequestion', {
                        question:this.add.question,
                        type:this.add.type,   
                        answer:this.add.answer,
                        subject:this.add.sub,
                        complexity:this.add.complexity,
                        category:this.add.cat,
                        choices:this.choices
                    })
                    .then((response)=>(alert('Question added')),
                    this.showque(this.category,this.subject))
                    .catch(function(error){console.log(error)});
                }
                else if(this.add["type"]=="fub"){
                    this.choices=null;
                    await axios.post('/teacher/savequestion', {
                        question:this.add.question,
                        type:this.add.type,   
                        answer:this.add.answer,
                        subject:this.add.sub,
                        complexity:this.add.complexity,
                        category:this.add.cat,
                        choices:this.choices
                    })
                    .then((response)=>(alert('Question added')),
                    this.showque(this.category,this.subject))
                    .catch(function(error){console.log(error)});
                }
                this.add.question='';
                this.add.answer=''; 
                this.add.sub='';
                this.add.cat='';
                this.add.choice1='';
                this.add.choice2='';
                this.choices=[];
                this.inputs=[];
                this.answers=[];
                this.type='';
            },
            async addchoices() {
                this.inputs.push({
                    one: '',
                    two: ''
                })
            },
            async deletechoice(index) {
                this.inputs.splice(index,1)
            },
            // async editdeletechoice(index,ch,qid) {
            //     alert(this.ch)
            //     // alert(this.ch[index])
            //     this.ch.splice(index,1);
            //     // this.geteditque(this.qid);
            // },
            async addanswer(value,event){
                if (event.target.checked) {
                    this.answers.push(value);
                }
                else{
                    var index = this.answers.indexOf(value);
                    this.answers.splice(index,1);
                }
            },
            async create(){
                await axios.post('/teacher/createtest', {
                    test:this.crtest,
                })
                .then((response) =>(alert("Test created!! Add some Questions")))
                .catch(function (error){console.log(error)});
                
                this.showcategories=false;
                this.editquestion=false;
                this.showquestions=false;
                this.addquestion=false;
                this.createtst=false;
                this.viewtst=false;
                this.addquetotest=true;
                this.addtest=false;
                this.quetest['test']=this.crtest;
                this.crtest='';
            },
            async testdetails(tid){
                await axios.get('/teacher/gettestdetails/'+tid)
                .then((response)=>(this.questions=response.data[0],
                this.testname=response.data[1]))
                .catch(function(error){console.log(error)});
                this.showcategories=false;
                this.editquestion=false;
                this.showquestions=true;
                this.addquestion=false;
                this.createtst=false;
                this.viewtst=false;
                this.addquetotest=false;
                this.addtest=true;
                this.testid=tid;
            },
            async savequetest(){
                if(this.quetest["type"]=="mcq"){
                    this.choices.push(this.quetest.choice1);
                    this.choices.push(this.quetest['choice2'])  ;
                
                    for(var index=0;index<this.inputs.length;index++){
                        this.choices.push(this.quetest['choice'+index+3]);
                    }
                    await axios.post('/teacher/savequestiontotest', {
                        question:this.quetest.question,
                        answer:this.quetest.answer,
                        test:this.quetest.test,
                        complexity:this.quetest.complexity,
                        choices:this.choices,
                        type:this.quetest.type,
                    })
                    .then((response)=>(alert('Question added to test')))
                    .catch(function(error){console.log(error)});
                    this.testdetails(this.testid)
                }
                else if(this.quetest["type"]=="check"){
                    this.choices.push(this.quetest.choice1);
                    this.choices.push(this.quetest['choice2'])  ;
                
                    for(var index=0;index<this.inputs.length;index++){
                        this.choices.push(this.quetest['choice'+index+3]);
                    }
                    await axios.post('/teacher/savequestiontotest', {
                        question:this.quetest.question,
                        type:this.quetest.type,   
                        answer:this.quetest.answer,
                        test:this.quetest.test,
                        complexity:this.quetest.complexity,
                        choices:this.choices
                    })
                    .then((response)=>(alert('Question added to test')))
                    .catch(function(error){console.log(error)});
                    this.testdetails(this.testid)
                }
                else if(this.quetest["type"]=="fub"){
                    this.choices=null;
                    await axios.post('/teacher/savequestiontotest', {
                        question:this.quetest.question,
                        type:this.quetest.type,   
                        answer:this.quetest.answer,
                        test:this.quetest.test,
                        complexity:this.quetest.complexity,
                        choices:this.choices
                    })
                    .then((response)=>(alert('Question added to test')))
                    .catch(function(error){console.log(error)});
                    this.testdetails(this.testid)
                }
                this.quetest.question='';
                this.quetest.answer=''; 
                this.quetest.test='';
                this.quetest.choice1='';
                this.quetest.choice2='';
                this.choices=[];
                this.inputs=[];
                this.answers=[];
                this.type='';
            }
        },
        computed:{
            // checkanswer:function(value,answers){
                
            //         for(var a = 0; a < answers.length; a++){
            //             if(answers[a]==value){
            //                 return true;
            //             }
            //             return false;
            //         }
                
            // }
        }
    }
</script>
