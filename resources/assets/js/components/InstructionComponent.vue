<template>
    <div class="card card-default">
        <div class="card-header">Remember</div>
        <div class="card-body">
            <h2 v-if="visible === false">Select a Category</h2>
              <ul class="list-group">
                <li class="list-group-item" :key="instruction.id" v-for="instruction in Instructions">
                    {{ instruction.instruction }}
                </li>
             </ul><br>
            <button class="btn btn-success" v-if="visible" @click="startTest(subjectID)">Start Test</button>
        </div>
    </div>
</template>

<script>
import { EventBus } from '../app.js'
    export default {
        data(){
            return{
                Instructions:[],
                visible:false,
                subjectID:null
                
            };
        },
        mounted(){
            EventBus.$on('InstEvent', data => {
                this.Instructions = data.instructionKey;
                this.subjectID =  data.subjectKey;
                this.visible = data.visibleKey;      
            });
         },
         methods:{
             startTest(subjectId){
            window.location.assign("/starttest/"+subjectId);
             }

         }
}
</script>

<style scoped>
h2
{  
   color: lightgray;
}
</style>
