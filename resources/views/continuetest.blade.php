<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" id='infoform' style='display:none'>
    @if(Session::has('message'))
    <p id='msg' class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
  <h2>Submit your information</h2>
  <form method="POST" action="/continuetestdetails" target="print_popup"  onsubmit="location.reload();window.open('about:blank','print_popup','resizable=0,toolbar=no,scrollbars=no,menubar=0,status=no,directories=no,width='+screen.availWidth+',height='+screen.availHeight);">
    @csrf
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control"  id="email" placeholder="Enter email" name="email" required>
    </div>
  
    <label for="sq">Sequrity question:</label>
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
     <div class="form-group">
        <input type="text" class="form-control" id='sq' placeholder="Enter answer" name="securityanswer" required>
      </div>
     
    <button type="submit" class="btn btn-primary">Submit</button>
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

$("document").ready(function(){
    setTimeout(function(){
        $("#msg").remove();
    }, 5000 ); // 5 secs

});

  
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
