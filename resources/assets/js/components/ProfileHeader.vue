<template>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="profile">            
                    <div class="image"><i class="fa fa-user-circle-o fa-5x" aria-hidden="true"></i></div>
                    <div class="detail">
                        <h1>Jhon Doe</h1>
                        <span>jhondoe@gmail.com</span><br>
                        <label>Student</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <button class="btn btn-default" @click="OpenRequestForm()">
                    <i class="fa fa-cog"></i>
                    Change Role
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
    OpenRequestForm()
    {
        window.location.assign("/open/request/form");
    }
}

}
</script>

<style scoped>
.btn-default{
    margin: 10px;
    float: right;
    background: rgba(211,211,211,.4);
}
.profile div{
    display: inline-block;   
}
.image{
    text-align: center;
    margin: 5px;
    margin-right: 10px;
    text-align: center;
}
label,span{
    padding: 0;
    margin: 0;
    font-size: 16px;
    text-align: justify;
}
label{
    color: darkmagenta;
}
.detail{
    text-align: left;
     padding: 5px;
}
h1{
    text-transform: capitalize;
}
.fa-user-circle-o{
    width: 150px;
    height: 120px;
    font-size: 120px;
    padding: 2px;
    color: lightgrey;
}
.fa-cog{
    color: rgba(0,0,0,0.5);
}
</style>

