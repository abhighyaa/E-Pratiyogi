<!DOCTYPE html>
<html lang="en" style='background:lavender'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   <style>
       body {
      margin: 0;
      font-family: "Raleway", sans-serif;
      font-weight: 400;
      line-height: 1.6;
      color: #212529;
      text-align: left;
      background-color: #f5f8fa;
  }
  .content {
        background-color:white;
        max-height:500px;
        position:absolute; 
        left:0; right:0;
        top:0; bottom:0;
        margin:auto;
        overflow:auto;
        box-shadow: 2px 3px 15px rgba(0, 0, 0, 0.3)
      }
 #child
{
    position: absolute;
    top: 50%;
    margin-top: -0.5em;
    overflow: hidden;
    white-space: nowrap;
    width: 100%;
    text-overflow: ellipsis;
    font-size:30px;
}
    </style>
</head>
<body>
    @if(isset($empty))

    <div class="container content">
            <h2 style='background:indigo;color:white;text-align:center'> Results</h2>
            <div style='text-align:center' id='child'>No entries yet </div>
        </div>
          
    



    @else

    @if($code == 1)
    <div class="container content">
            <h2 style='background:indigo;color:white;text-align:center'> Results</h2>
            <br>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Email</th>
                  <th>Firstname</th>
                  <th>Result</th>
                  <th>Code Result</th>
                </tr>
              </thead>
              <tbody>
                    @foreach ($r as $result)
                    <tr>
                        <td>{{$result->email}}</td>
                        <td>{{$result->firstname}}</td>
                        <td>{{$result->result}}</td>
                        <td>{{$result->code_result}}</td>
                    </tr>
                               
                    @endforeach
         
              </tbody>
            </table>
          </div>
          @else
       
          <div class="container content">
                <h2 style='background:indigo;color:white;text-align:center'> Results</h2>
                <br>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Firstname</th>
                      <th>Result</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($r as $result)
                        <tr>
                            <td>{{$result->email}}</td>
                            <td>{{$result->firstname}}</td>
                            <td>{{$result->result}}</td>
                        </tr>
                                   
                        @endforeach
             
                  </tbody>
                </table>
              </div>

          @endif
          
          
    
    @endif






       


</body>
</html>