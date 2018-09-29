@extends('layouts.app')

@section('content')

<subject>
    <ul>
        <li v-for="s in sub" >
            
        <a :href="/subjects/+s.id">@{{s.subject}}&nbsp;(@{{ s.questions.length  }})</a>
            
            <button class="btn btn-danger ml-2" @click="delsubject(s)"><i class="fa fa-trash"></i></button>
            <!-- <a  :href="/subjects/delete/+s.id"><i class="fa fa-trash"></i></a> -->
            <hr>
        </li>
    </ul>
                            
                            
    <button class="btn btn-primary" @click="smodal = true" id="createsubjects">Add subjects to library</button>
        &nbsp; &nbsp;
        <button class="btn btn-primary" @click="qmodal = true" id="createquestions">Add questions to library</button>
    <modal v-show="smodal" title="Create Subject" @close="smodal=false">
        <mcontent name="content">
            <label for="subjects">Subject Name</label>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text"  v-model="newsubject" @keydown="errors.clear('newsubject')">
            <span class="help is-danger" v-if="errors.has('newsubject')" v-text="errors.get('newsubject')"></span>
        
        </mcontent>
       <template slot="footer">
            <button class="button is-success" @click="addsubjects()">Add </button>
            <button class="button" @click="smodal=false">Cancel</button>
       </template> 
    </modal>

    <modal v-show="qmodal" v-cloak title="Add Question" @close="qmodal=false">
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
            <a  :href="addchoice()">Add More Choices</a>
   </mcontent>
       <template slot="footer">
            <button class="button is-success"  @click="addquestion()" >Add </button>
            <button class="button" @click="qmodal=false">Cancel</button>
       </template> 
    </modal>

</subject>                    
@endsection