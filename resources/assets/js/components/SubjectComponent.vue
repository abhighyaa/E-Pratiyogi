<template>
    <div class="card card-default">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4" v-for="subject in subjects" :key="subject.id">
                    <div class="card card-default custom-card">
                         <div class="card-body">
                             {{ subject.subject }}
                         </div>
                         <div class="card-footer" @click="TakeTest(subject.id)">
                             Take Test
                         </div>
                     </div>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

    export default {
        computed:{
            ...mapGetters({
                subjects:'Subjects',
            }),
        },
        mounted(){
            this.defaultsubjects();
         },
         methods:{
             async TakeTest(sujectId){
                this.$router.push('/instructions')
                this.$store.dispatch('Set_Instructions',sujectId)
             },
            async defaultsubjects(){
                this.$store.dispatch('Set_Subjects')
            }
        }
}
</script>

<style scoped>
h2
{  
   color: lightgray;
}
.card-footer{
    background: #146D8B;
    color: white;
    cursor: pointer;
    font-weight: bolder;
}
.custom-card{  
    margin-bottom: 15px;
    text-align: center;
    font-weight: bolder;
    color: dodgerblue;
}
</style>
