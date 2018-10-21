<template>
        
            <div class="modal is-active">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">{{this.title}}</p>
                        <button class="delete" aria-label="close" @click="$emit('close')"></button>
                    </header>
                    <section class="modal-card-body">
                        <slot name="content"></slot>
                    </section>
                    <footer class="modal-card-foot">
                        <slot name="footer"></slot>
                    </footer>
            </div>
        </div>

</template>


<script>
   import { EventBus } from '../app.js'
    export default {
        data(){
            return{
                title:'',
                active:true
            };
        },
        props:['title'],
        mounted() {
           
        },
        }
</script>