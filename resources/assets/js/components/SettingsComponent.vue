<template>
  <div>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header item">
              <p @click="redirect()">Change Password</p>
          </div>
          <div class="modal-header item">  
               <p>Change Profile</p> 
          </div>
          <div class="modal-header item">
              <p>Privacy And Security</p>
          </div>
          <div class="modal-header item"> 
              <p @click="logout()">Log Out</p>
          </div>
          <div class="modal-header">
              <button class="modal-default-button" @click="$emit('close')">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </transition>
  </div>
</template>
<script type="text/javascript">
  export default {
    methods: {
      redirect()
      {
        window.location.assign("http://localhost:8000/open/ChangePassword/form");
      },
      logout()
      {
        window.location.href = "/logout";
      }
    },
    mounted()
    {
      console.log('setting mounted');
    }
  }
</script>
<style type="text/css">
  .modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 500px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header{
  cursor:pointer;
  text-align: center;
  margin-top: 0;
  color: black;
  text-align:center;
}
.item:hover 
{
  background-color: lavender;
}
.modal-default-button {
  width: 70px;
    height: 35px;
    border-radius: 4px;
    border: none;
    background-color: dodgerblue;
    color: white;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
