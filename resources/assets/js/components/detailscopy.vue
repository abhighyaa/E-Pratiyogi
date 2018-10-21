<template>
    <div>
    <div class="card card-default">
        <div class="card-header">Details</div>
        <div class="card-body">
              <ul v-if='showcategories'>
                  <li :key="cat.id" v-for="cat in categories">
                      <button @click="showque(cat.id,subject)">{{ cat.category }}</button>
                     <br><br>
                  </li>
              </ul>

            <div v-if="showquestions">
                <button @click="addque(subject,category)">Add question</button>
                <br><br>
                <div v-for="question in questions">
                    <div class="question">{{question.question}} 
                        <div class="float-right">
                            <button @click="geteditque(question.id)">Edit</button>
                            <button @click="deleteque(question.id)">Delete</button>
                        </div>
                    </div>
                    
                    <div v-for="i in question.choices">
                        <div class="choices"><input type="radio" :name="question.id" :checked="i==question.answer">&nbsp;&nbsp;{{i}}</div>
                    </div>
                    <hr>
                </div>
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
                    </div>
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
                        <label for="question">Question</label>
                        <div class="col-md-6">
                            <input type="text" v-model='add["question"]' required autofocus>
                        </div>
                    </div>

                    <div class="form-group row ml-2">
                        <label for="complexity">Complexity</label>
                        <div class="col-md-6">
                            <input type="text" list="comp" v-model='add["complexity"]' autocomplete="on">
                                <datalist id="comp">
                                    <option value="low" selected/>
                                    <option value="medium"/>
                                    <option value="high"/>
                                </datalist>
                        </div>
                    </div>

                    <div class="form-group row ml-2">
                        <label for="choices"></label>
                        <div class="col-md-6">
                            <input type="radio" name="answer" v-model="add.answer" v-bind:value='add["choice1"]' checked><input type="text"  v-model='add["choice1"]' required><br>
                            <input type="radio" name="answer" v-model="add.answer" v-bind:value='add["choice2"]'><input type="text" v-model='add["choice2"]' required>
                            <div v-for="(input, index) in inputs">
                                <input type="radio" name="answer" v-model="add.answer" v-bind:value='add["choice".index+3]'>  
                                <input type="text" v-model='add["choice".index+3]' required>
                                <button @click="deletechoice(index)">Delete</button>
                            </div>
                        </div>
                    </div>
                    <button @click="addchoices()">Add more choices</button>
                    
                    <button>Save</button>
                </form>
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
                addquestion:false,
                choices:[],
                inputs:[],
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
            },
            async geteditque(qid){
                await axios.get('/teacher/editquestion/'+qid)
                .then((response)=>(this.equestion = response.data))
                .catch(function(error){console.log(error)});
                this.showcategories=false;
                this.editquestion=true;
                this.showquestions=false;
                this.addquestion=false;
            },
            async editque(){
                await axios.post('/teacher/saveedits', {
                    id:this.equestion.id,
                    question:this.equestion.question,
                    answer:this.equestion.answer,
                    choices:this.equestion.choices,
                })
                .then((response) =>(alert("Edit saved")),
                this.showque(this.category,this.subject))
                .catch(function (error){console.log(error)});
            },
            async deleteque(qid){
                await axios.get('/teacher/delete/'+qid)
                .then((response)=>(alert('Deleted')),
                this.showque(this.category,this.subject))
                .catch(function(error){console.log(error)});
                
                this.showcategories=false;
                this.editquestion=false;
                this.showquestions=true;
                this.addquestion=false;
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
            },
            async saveque(){
                this.choices.push(this.add.choice1);
                this.choices.push(this.add.choice2);
                
                await axios.post('/teacher/savequestion', {
                    question:this.add.question,
                    answer:this.add.answer,
                    subject:this.add.sub,
                    complexity:this.add.complexity,
                    category:this.add.cat,
                    choices:this.choices
                })
                .then((response)=>(alert('Question added')),
                this.showque(this.category,this.subject))
                .catch(function(error){console.log(error)});
                this.add.question='';
                this.add.answer=''; 
                this.add.sub='';
                this.add.cat='';
                this.add.choice1='';
                this.add.choice2='';
                this.choices=[];
            },
            async addchoices() {
                this.inputs.push({
                    one: '',
                    two: ''
                })
            },
            async deletechoice(index) {
                this.inputs.splice(index,1)
            }
        }
}
</script>
