<template>
    <div class="card card-default">
        <div class="card-header">Remember</div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item" v-for="inst in instructions" :key="inst.id">
                        {{  inst.instruction }}
                    </li>
                </ul>
                <a href="/student/home"><button class="btn btn-primary">Back</button></a>
                <button class="btn btn-primary">Start</button>
            </div>
            
    </div>
</template>

<script>
import { EventBus } from '../app.js';

export default {

    data(){
        return{
            instructions:[],
        };
    },
    mounted(){
        EventBus.$on('fetchInstructions',data=>{
            this.instructions = data.instructionsKey;
            
        });
       
    },
    methods:{

    }
}
</script>

<style>

</style>
