<template>
    <div class="card card-default">
        <div class="card-header">Instructions</div>
        <div class="card-body">
            <h2 v-if="visible === false">Select a Category</h2>
              <ul class="list-group">
                <li class="list-group-item" :key="instruction.id" v-for="instruction in Instructions">
                    {{ instruction.instruction }}
                </li>
             </ul><br>
            <button class="btn btn-success" v-if="visible">Start Test</button>
        </div>
    </div>
</template>

<script>
import { EventBus } from '../app.js'
    export default {
        data(){
            return{
                Instructions:[],
                visible:false
                
            };
        },
        mounted(){
            EventBus.$on('InstEvent', data => {
                this.Instructions = data;
                
            });
             EventBus.$on('Buttonevent', data => {
                this.visible = data;
                
            });
         }
}
</script>

<style scoped>
h2
{
    margin-left: 40%;
   color: lightgray;
}
</style>
