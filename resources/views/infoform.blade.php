<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <style>
  body {
    margin: 0;
    font-family: "Raleway", sans-serif;
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #212529;
    text-align: left;
    background-color: #f5f8fa;
}

.content {
        background-color:white;
        height:500px;
        position:absolute; 
        left:0; right:0;
        top:0; bottom:0;
        margin:auto;
        overflow:auto;
      }
  
  </style>
</head>
<body>

<div class="container content" id='infoform' style='display:none;box-shadow: 2px 3px 15px rgba(0, 0, 0, 0.3)'>
  <br>
  <h2 style='background:indigo;color:white;text-align:center'>Test Information</h2>
  <br>
  <form method="POST" action="/infodetails" target="print_popup"  onsubmit="location.reload();window.open('about:blank','print_popup','resizable=0,toolbar=no,scrollbars=no,menubar=0,status=no,directories=no,width='+screen.availWidth+',height='+screen.availHeight);">
    @csrf

  <input type='hidden' value="{{$id}}" name='id'> 


<div class="form-group row">
  <label for="email" class="col-sm-4 col-form-label text-md-right">Email:</label>
  <div class="col-md-6">
 
      <input type="email" class="form-control"  id="email" placeholder="Enter email" name="email" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="fn" class="col-sm-4 col-form-label text-md-right">First name:</label>
    <div class="col-md-6">

      <input type="text" class="form-control" id='fn' placeholder="Enter first name" name="firstname" required>
    </div>
    </div>

    <div class="form-group row">
      <label for="ln" class="col-sm-4 col-form-label text-md-right">Last name:</label>
      <div class="col-md-6">

        <input type="text" class="form-control" id='ln' placeholder="Enter last name" name="lastname" required>
      </div>
    </div>

      <label for="sq" class="col-sm-4 col-form-label text-md-right">Sequrity question:</label>
      <select class="security" name="securityques" required>
        <option value="">Select a question from the following options.</option>
        <option >Who's your daddy?</option>
        <option >What is your favorite color?</option>
        <option >What is your mother's favorite aunt's favorite color?</option>
        <option >Where does the rain in Spain mainly fall?</option>
        <option >If Mary had three apples, would you steal them?</option>
        <option >What brand of food did your first pet eat?</option>
     </select>
    <br>
   
    <br>
     <div class="form-group row" >
        <label for="sq" class="col-sm-4 col-form-label text-md-right">Security answer:</label>
        <div class="col-md-6">
        <input type="text" class="form-control" id='sq' placeholder="Enter answer" name="securityanswer" required>
      </div>
    </div>
     
    <button type="submit" class="btn btn-primary" style=' margin:0 auto;display:block;'>Submit</button>
  </form>

  @if($errors->any())
  <div >
        <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach    
        </ul>    
        
        </div>     
   @endif     

</div>

<div id='alert' style='display:none'>
  <p>PLEASE ACCEPT NOTIFICATIONS from browser setting TO GIVE TEST</p>
</div>
<script>
  
  if (Notification.permission === 'default') {
                 Notification.requestPermission(function(p) {
                       if (p === 'denied'){
                             alert('You have denied Notification please accept if from browser setting to give test!');
                             $('#infoform').css('display','none');
                             $('#alert').css('display','block');                             
                       }
                       else if(Notification.permission == 'granted'){
                          $('#infoform').css('display','block');
                          $('#alert').css('display','none');
                       }  
               });
             }
   else if (Notification.permission == 'denied'){
    $('#infoform').css('display','none');
    $('#alert').css('display','block');

  } 
  else if(Notification.permission == 'granted'){
    $('#infoform').css('display','block');
    $('#alert').css('display','none');

  }
  
  
  
  </script>
</body>
</html>
