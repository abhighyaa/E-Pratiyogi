<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
               
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class=" nav-link header" href="#">Topics</a>
                    </li>
                    
                    <slot name="topics"></slot>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header"><slot name="header"></slot></div>

                    <div class="card-body">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
    .header{
        color:white;
        background-color:green;
    }
</style>
