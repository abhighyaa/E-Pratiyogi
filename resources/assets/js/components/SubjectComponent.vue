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
import { EventBus } from '../app.js'
// import Axios from 'axios';
    export default {
        data(){
            return{
                subjects:[],
                instructions:[],
                visible:false,
                subjectID:null
                
            };
        },
        mounted(){
            EventBus.$on('fetchSubjects', data => {
                this.subjects = data.subjectKey;   
            });
            this.defaultsubjects();
         },
         methods:{
             async TakeTest(sujectId){
                //  await axios.get('http://localhost:8000/subjects/'+sujectId+'/get/instructions')
                //     .then((response)=>(this.instructions = response.data))
                //     .catch(function(error){console.log(error)});
                    window.location.assign('http://localhost:8000/student/home/'+sujectId);
                    // alert(this.instructions);
                // EventBus.$emit('fetchInstructions',{
                //     instructionsKey:this.instructions,
                //     visibleKey:this.visible
                // });
                // await axios.get('http://localhost:8000/student/home/'+sujectId)
                //     .then((response)=>(this.instructions = response.data))
                //     .catch(function(error){console.log(error)});
             },
            async defaultsubjects(){
                 await axios.get('http://localhost:8000/subjects/get/default')
                    .then((response)=>(this.subjects = response.data))
                    .catch(function(error){console.log(error)});
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
