           @extends('layouts.app1')

@section('content')

<div class="container-fluid">
    <div class="row row-1">
    	<div class="col-md-12">
    		<div class="row row-1-1">
    			<div class="col-md-2"></div>
    			<div class="col-md-2 text-right">
    				<img src="logo.12IuSvdX011zumHUeM4WVn97yioEVuwDGHk=" class="img-responsive">
    			</div>
    			<div class="col-md-8 mt-4">
    				<nav class="navbar navbar-expand-lg navbar-light bg-white pl-5 " >
					    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					    <span class="navbar-toggler-icon"></span>
					    </button>
					    <div class="collapse navbar-collapse" id="navbarNav">
						    <ul class="navbar-nav">
						      <li class="nav-item active">
						        <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="#">Features<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item dropdown">
							        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							          Help
							        </a>
							        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
							          <a class="dropdown-item" href="#">FAQ</a>
							          <a class="dropdown-item" href="#">Support</a>
							        </div>
						      </li>
						       <li class="nav-item">
						        <a class="nav-link" href="#">Contact Us<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item active login">
						        <a class="nav-link" href="{{ route('login') }}">Login<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item active">
						        <a class="nav-link" href="{{ route('register') }}">Signup<span class="sr-only">(current)</span></a>
						      </li>
						    </ul> 
					    </div>
		            </nav>
    			</div>
    		</div>
    		<div class="row row-1-2">
    			<div class="col-md-4">
    				<img src="girl.jpg" class="girl_image">
    			</div>
    			<div class="col-md-5 text-left pt-5">
    				<h2>Welcome To <span class="EPYOGI">E-PRATIYOGI</span></h2>
					<p style="font-size: 14px;color:white;">
								Existing system only allows either conducting tests or giving tests or learning
								new and discussion forums. Also the separate platforms that provide tutorials of
								the professors, contacting them is not that easy. Moreover, they are paid, which
								everyone can not simply afford. For a big institute and educational organisation, to conduct a quiz is not an
								easy task because of existing system provides limited free accounts and multiple
								features are part of premium. <strong>E-Pratiyogi</strong>, An online learning platform by which each
								and every student, teacher, professor and even
								educational institute can get benefited.
					</p>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="row">
		<div class="workflow col-md-12">
			<div class="row row-3 mt-5">
	    		<div class="col-md-4"></div>
	    		<div class="col-md-4 text-center"><p class="heading">How It Works ?</p></div>
	    		<div class="col-md-4"></div>
	        </div>
	        <div class="row row-4 mt-5 ml-5">
	    		<div class="col-md-2 text-center">
					<div class=" work-icon"><i class="fa fa-book fa-3x"></i></div>
					<span class="flowtag mt-2">Create questions</span>
				</div>
				<div class="col-md-1 pl-0" style="padding-top: 60px;">
					<img src="arrow.png" style="width:100px;">
				</div>
				<div class="col-md-2 text-center">
					<div class="work-icon"><i class="fa fa-file fa-3x"></i></div>
					<span class="flowtag">Design Test</span>
				</div>
				<div class="col-md-1 pl-0" style="padding-top: 60px;">
					<img src="arrow.png" style="width:100px;">
				</div>
				<div class="col-md-2 text-center">
					<div class="work-icon"><i class="fa fa-users fa-3x"></i></div>
					<span class="flowtag">Assign Test</span>
				</div>
				<div class="col-md-1 pl-0" style="padding-top: 60px;">
					<img src="arrow.png" style="width:100px;">
				</div>
				<div class="col-md-2 text-center">
					<div class="work-icon"><i class="fa fa-trophy fa-3x"></i></div>
					<span class="flowtag">Generate Result</span>
				</div>
	   		</div>
		</div>
	</div>
    <div class="row row-5 mt-5">
    	<div class="col-md-2"></div>
    	<div class="col-md-8 text-center pt-5"> 
	    	<p class="heading-row-5">A Big Revolution In Online Education</p>
	    	<p style="font-size: 14px;">
			To bring a revolution in digital education system, provide a platform where one can learn, practise, find out where he stands
on that subject and a open forum for valuable discussions and it is end to end
connection between students and experts and make existance of such kind of a platform where each and every student, teacher,
professor and recruiter could get benefited by it.
			</p> 
    	</div>
    	<div class="col-md-2"></div>
    </div>
    <div class="row row-6 mt-5 ">
    	<div class="col-md-12">
    		<div class="row row-6-1 mt-3">
    			<div class="col-md-4 text-center">
    				<i class="fa fa-book-reader fa-3x features-icon"></i><br>
    				<b style="color: rgb(112,128,144);">Easy To Learn and Use</b>
    				<p class="pt-1">One-stop-destination for examination, preparation, recruitment, and more. Specially designed online quiz system to enhance your knowledge. The platform is smooth to use with a translational flow of information.</p> 
				</div>
    			<div class="col-md-4 text-center">
    				<i class="fa fa-address-card fa-3x features-icon"></i><br>
    				<b style="color: rgb(105,105,105);">User Friendly Interface</b>
					<p class="pt-1">A click to the next trick, simple registration, signing- in, synchronized processing, smoothly test uploading.</p> 
				</div>
    			<div class="col-md-4 text-center">
    				<i class="fa fa-flag-checkered fa-3x features-icon"></i><br>
    				<b style="color: rgb(105,105,105);">Advanced Reporting Interface</b>
    				<p class="pt-1">Instant scorecard generation, computational analysis, efficient feedback sharing to boost up your performance and precision.</p> 
				</div>
    		</div>
    		<div class="row row-6-2 mt-5">
    			<div class="col-md-4 text-center">
    				<i class="fa fa-people-carry fa-3x features-icon"></i><br>
    				<b style="color: rgb(105,105,105);">Splendid Support</b>
    				<p class="pt-1">Your request and our actions to strive triggered support. A dedicated team is working round the clock to provide 24 X 7 streamlined access to our technical experts .</p> 
				</div>
    			<div class="col-md-4 text-center">
    				<i class="fa fa-tv fa-3x features-icon"></i><br>
    				<b style="color: rgb(105,105,105);">Smart Subscription</b>
    				<p class="pt-1">Premium selection to the suited subscription that will match your preferences and priorities of using the online assessment platform.</p> 
				</div>
    			<div class="col-md-4 text-center">
    				<i class="fa fa-universal-access fa-3x features-icon"></i><br>
    				<b style="color: rgb(105,105,105);">Active Accessbility</b>
    				<p class="pt-1">Go wherever you want to and practice whenever you want, using the next level online exam platform. Experience a lag-free synchronized performance of think exam on your mobile devices.</p> 
				</div>
    		</div>
    	</div>
    </div>
    <!-- Footer -->
    <div class="row mt-5 footer pt-5">
    	<div class="col-md-12">
			<!-- <footer class="footer pt-5"> -->
		     	<div class="row">
		   			<div class="col-md-6 pl-5">
		      			<h5 class="text-uppercase">Footer Content</h5>
		     			<p>Here you can use rows and columns here to organize your footer content.</p>
		   			</div>
		    		<hr>
		   			<div class="col-md-3">
		            	<h5 class="text-uppercase text-center">Links</h5>
		            	
		           	</div>	
		      		<div class="col-md-3">
		       			<h5 class="text-uppercase">Links</h5>
		       			
		     		</div>
		      	</div>
		   		<div class="footer-copyright text-center pt-3 pb-3">© 2018 Copyright:
		      		<a href="https://mdbootstrap.com/bootstrap-tutorial/"> MDBootstrap.com</a>
		    	</div>
		 	<!-- </footer> -->
	 	</div>
 	</div>
</div>

@endsection

<style>
	.flowtag{
		font-size:18px;
		color:rgba(100, 100, 100);
	}
	.workflow{
	background:white;
	padding-bottom:40px;
	
	}
.EPYOGI{
	color:#f49842;
	font-family:sans-serif;
	font-weight:bolder;
}
.row
{
	font-size: 20px;
}
.row-1
{
	background-color:rgba(10,113,138);
}
.row-2-col-2,.last-image
{
	padding-top: 90px;
	padding-bottom: 20px;
	
}
.girl_image
{
	width: 300px;
	height:300px;
	margin-left:190px;
}
.nav-item
{
	font-size: 20px;
	margin-left: 20px;
}
p
{
	font-size: 14px;
}

i
{
	font-size: 28px;
}
.last-image
{
	width: 300px;
	height: 500px;

}
.heading
{
	font-size: 40px;
}
.heading-row-5
{
	font-size: 30px;
}
.footer
{
	background-color:rgba(10,113,138);
}
.work-icon
{
	border:solid 1px rgb(112,128,144);
	width: auto;
	padding-top:60px;
	padding-bottom: 60px;
	border-radius: 900px;
	color: rgb(112,128,144);
}
.work-icon:hover
{
	border : solid 1px rgba(10,113,138);
	color:rgba(10,113,138);
}
.features-icon
{
	color:rgb(112,128,144);
}
</style>