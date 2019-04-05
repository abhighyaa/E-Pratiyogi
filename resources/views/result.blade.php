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
    .content {
        width: 600px;
        height: 80px;
        background-color:rgb(66, 206, 244);

        position:absolute; 
        left:0; right:0;
        top:0; bottom:0;
        margin:auto;

        max-width:100%;
        max-height:100%;
        overflow:auto;
    }
    </style>
</head>

<body>
    <div class='content'>
    <div style='font-size:25px;text-align:center'>TEST RESULT {{$result}}%</div>
    <div style='font-size:25px;text-align:center'>CODE TEST RESULT {{$code_r}}%</div>
   </div>
</body>
</html>