@extends('layouts.app')

@section('content')

    <example-component>
        <template slot="topics">
                    
                    @foreach($topics as $topic)
                    <li class="nav-item">
                       
                        <a class="nav-link " @click="activate({{$subject->id}},{{$topic->id}})" href="#">{{$topic->topic}}</a> 
                    </li>
                    @endforeach
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link" @click="tmodal=true">Create new topic</a> 
                    </li>
        </template>
        <modal v-show="tmodal" title="Create Topic" @close="tmodal=false">
            <mcontent name="content">
                <label for="subjects">Topic Name</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text"  v-model="newtopic" @keydown="errors.clear('newtopic')">
                <span class="help is-danger" v-if="errors.has('newtopic')" v-text="errors.get('newtopic')"></span>
            
            </mcontent>
            <template slot="footer">
                    <button class="button is-success" @click="addtopics({{$subject->id}})">Add </button>
                    <button class="button" @click="tmodal=false">Cancel</button>
            </template> 
         </modal>
        <template slot="header">
            {{$subject->subject}} Questions
        </template>
        <template>
            
            
                <div v-for="question in questions">
                    Q : @{{question.question}}
                    <br>
                    <ul>
                       
                        <li v-for="(value, key) in question.choices">
                            @{{ key }} : @{{ value }}
                        </li>
                    </ul>

                    Ans : @{{question.answer}}
                    <br>
                    Complexity : @{{question.complexity}}
                    <br>
                    <a href="#" @click="editques(question.id)">Edit</a>
                    <hr>
                    
                </div>
                <button class="btn btn-primary" @click="qmodal = true">Add questions to @{{topic}}</button>
                <modal v-show="qmodal" title="Add Question" @close="qmodal=false">
                <mcontent name="content">
                    <label for="subject">Subject</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text"  v-model="subject" @keydown="errors.clear('subject')">
                    <span class="help is-danger" v-if="errors.has('subject')" v-text="errors.get('subject')"></span>
                    <br>
                    <label for="question">Question</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text"  v-model="newquestion" @keydown="errors.clear('newquestion')">
                    <span class="help is-danger" v-if="errors.has('newquestion')" v-text="errors.get('newquestion')"></span>
                    <br>
                    <label for="answer">Answer</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text"  v-model="newanswer" @keydown="errors.clear('newanswer')">
                    <span class="help is-danger" v-if="errors.has('newanswer')" v-text="errors.get('newanswer')"></span>
                    <br>
                    <label for="complexty">Complexity</label>
                    &nbsp;&nbsp;&nbsp;
                    <input type="text"  v-model="complexity" @keydown="errors.clear('complexity')">
                    <span class="help is-danger" v-if="errors.has('complexity')" v-text="errors.get('complexity')"></span>
                    <br>
                    <label for="topic">Topic</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text"  v-model="topic" @keydown="errors.clear('topic')">
                    <span class="help is-danger" v-if="errors.has('topic')" v-text="errors.get('topic')"></span>
                    <br>
                    <label for="choice">Choice 1</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text"  v-model="choice1" @keydown="errors.clear('choice1')">
                    <span class="help is-danger" v-if="errors.has('choice1')" v-text="errors.get('choice1')"></span>
                    <br>
                    <label for="choice">Choice 2</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text"  v-model="choice2" @keydown="errors.clear('choice2')">
                    <span class="help is-danger" v-if="errors.has('choice2')" v-text="errors.get('choice2')"></span>
                </mcontent>
                <template slot="footer">
                        <button class="button is-success"  @click="addquestion()" >Add </button>
                        <button class="button" @click="qmodal=false">Cancel</button>
                </template> 
            </modal>
        
            <modal v-show="emodal" title="Edit Question" @close="emodal=false">
                <mcontent name="content">
                    <label for="subject">Subject</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span v-for="sub in eques.subjects">
                        <input type="text"  v-model="sub.subject" disabled>
                        <br>
                    </span>
                    
                    
                    <label for="question">Question</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text"  v-model="eques.question" @keydown="errors.clear('newquestion')">
                    <span class="help is-danger" v-if="errors.has('newquestion')" v-text="errors.get('newquestion')"></span>
                    <br>
                    <label for="answer">Answer</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text"  v-model="eques.answer" @keydown="errors.clear('newanswer')">
                    <span class="help is-danger" v-if="errors.has('newanswer')" v-text="errors.get('newanswer')"></span>
                    <br>
                    <label for="complexty">Complexity</label>
                    &nbsp;&nbsp;&nbsp;
                    <input type="text"  v-model="eques.complexity" @keydown="errors.clear('complexity')">
                    <span class="help is-danger" v-if="errors.has('complexity')" v-text="errors.get('complexity')"></span>
                    <br>
                    <label for="topic">Topic</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span v-for="top in eques.topics">
                        <input type="text"  v-model="top.topic" disabled>
                        <br>
                    </span>
                    
                    
                    <div v-for="(value, key) in eques.choices">
                        <label for="choice">@{{key}}</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text"  v-model=eques.choices[key] @keydown="errors.clear('choice1')">
                        
                        <br>
                        
                    </div>
                    
                </mcontent>
                <template slot="footer">
                        <button class="button is-success"  @click="saveques(eques.id)" >Save </button>
                        <button class="button" @click="emodal=false">Cancel</button>
                </template> 
            </modal>
        </template>
    </example-component>

@endsection