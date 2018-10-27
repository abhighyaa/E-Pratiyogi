<template>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 col-md-offset-2">
        <div class="card card-default">
            <div class="card-header">Remember</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item" :attr='instructions' v-for="inst in instructions" :key="inst.id">
                            {{  inst.instruction }}
                        </li>
                    </ul><br>
                    <button  @click="startTest" class="btn btn-success ml-2 pull-right">Start</button>
                    <router-link :to="'/'"><button class="btn btn-default pull-right">Back</button></router-link>
                 
             </div>
        </div>
    </div>
</div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    computed:{
        ...mapGetters({
            instructions:'Instructions'
        })
    },
    methods:{
        startTest(){
            var subjectId = this.$store.getters.Instructions[0].subject_id
            window.location.assign('http://localhost:8000/starttest/'+subjectId);
        }
    }
}
</script>

<style scoped>
.card-header{
    background:rgb(51, 158, 181);
    color:white;
    font-size:16px; 
}
</style>
