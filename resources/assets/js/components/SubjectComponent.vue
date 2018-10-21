<template>
    <div class="card card-default">
        <div class="card-header">Category</div>
        <div class="card-body">
              <ul class="list-group">
                  <li class="list-group-item" :key="sub.id" v-for="sub in subjects">
                     <a href="#" @click="fetchInstructions(sub.id)" :id="sub.id">{{ sub.subject}}</a> 
                  </li>
              </ul>
        </div>
    </div>  
</template>

<script>
import { EventBus } from '../app.js';
    export default {
        data(){
         return{
                subjects:[],
                instructions:[],
                visible:false,
                
        };
        },

        mounted() {
           this.fetchSubjects();
        },
        methods:{
            fetchSubjects(){
                 axios.get('http://127.0.0.1:8000/subjects/get/all')
                .then((response)=>(this.subjects = response.data))
                .catch(function(error){console.log(error)});
            },
           async fetchInstructions(subjectId)
            {
                this.visible = true;
                await axios.get('http://127.0.0.1:8000/subjects/'+subjectId+'/get/instructions')
                .then((response)=>(this.instructions = response.data))
                .catch(function(error){console.log(error)});
                 EventBus.$emit('InstEvent',{
                     instructionKey:this.instructions,
                     subjectKey:subjectId,
                     visibleKey:this.visible
                     });
            }
        }
    }
</script>
