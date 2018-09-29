<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E-Pratiyogi</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #F5F7FA;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: auto;
                margin: 0;
            }
            .title {
                font-size: 84px;
                text-transform:uppercase;
                text-align: center;
            }
            .box{
               
                text-align: center;
                width:100%;
                height:400px;
                padding-top: 140px;
                background-color:rgba(219, 221, 221,0.4);
                border-radius:8px;
                cursor:pointer;
                color:rgba(67, 194, 216,1);  
                display:inline-block;
            
            }
            .col-sm-4{
                padding:25px;
            }
            label{
                padding:0;
                margin-left:-7px;
                font-weight:bold;
                font-size:18px;
            }
            a{
                text-decoration:none;
                color: #636b6f;
            }

            
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
                <div class="title ">
                    E-pratiyogi
                </div>

                <div class="row">
                    <div class="col-sm-4">
                    <a href="{{ route('login') }}">
                        <div class="box">
                            <i class="fas fa-users fa-5x"></i><br>
                            <label for="">Students</label>
                        </div>
                        </a>
                    </div>                    
                    <div class="col-sm-4">
                    <a href="{{ route('login') }}">
                        <div class="box ">
                            <i class="fas fa-chalkboard-teacher fa-5x"></i><br>
                            <label for="">Teacher</label>
                        </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                    <a href="{{ route('login') }}">
                        <div class="box">
                            <i class="fas fa-user-cog fa-5x"></i><br>
                            <label for="">Admin</label>
                        </div>
                        </a>
                    </div>
                </div>
        </div>
    </body>
</html>
