<template>
    <div class="card card-default">
        <div class="card-header">Category</div>
        <div class="card-body">
              <ul class="list-group">
                  <li class="list-group-item" :key="sub.id" v-for="sub in subjects">
                     <a href="#" @click="fetchInstructions(sub.id),SetButton()" :id="sub.id">{{ sub.subject}}</a> 
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
                show:false
        };
        },

        mounted() {
           this.fetchSubjects();
        },
        methods:{
            fetchSubjects(){
                 axios.get('http://localhost:8000/subjects/get/all')
                .then((response)=>(this.subjects = response.data))
                .catch(function(error){console.log(error)});
            },
           async fetchInstructions(id)
            {
                await axios.get('http://localhost:8000/subjects/'+id+'/get/instructions')
                .then((response)=>(this.instructions = response.data))
                .catch(function(error){console.log(error)});
                 EventBus.$emit('InstEvent',this.instructions);
                 
            },
            SetButton()
            {
                this.show = true;
                 EventBus.$emit('Buttonevent',this.show);
            }
        }
    }
</script>
