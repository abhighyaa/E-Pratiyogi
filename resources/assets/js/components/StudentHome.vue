<template>
    <div class="row">
        <div class="col-md-3">
            <!-- <router-view name="subject"></router-view> -->
            <course-component v-if="visible"></course-component>
        </div>
        <div class="col-md-6">
             <!-- <router-view name="instruction"></router-view> -->
             <instructions  v-if="!visible"></instructions>
             <subject-container v-else></subject-container>
        </div>
        <div class="col-md-3">
             <!-- <router-view name="instruction"></router-view> -->
             <previous-attempt  v-if="visible"></previous-attempt>
        </div>
    </div>
</template>

<script>
import { EventBus } from '../app.js';
export default {
    data(){
        return{
            visible:true,
        };
    },
    mounted(){
               EventBus.$on('fetchInstructions',data=>{
                 this.visible = data.visibleKey;
        });
    }
}
</script>

<style>

</style>
