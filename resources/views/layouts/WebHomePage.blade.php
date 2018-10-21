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
    			<div class="col-md-4 text-left pt-5">
    				<h1>Where can I get some?</h1>
    				<p style="font-size: 10px;">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
					The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
    			</div>
    		</div>
    	</div>
    </div>
   <!--  <div class="row row-2">
    	<div class="col-md-2"></div>
    	<div class="col-md-4 row-2-col-2">
    		What is Lorem Ipsum?<br>
    		<h1>Where does it come from?</h1>
    		<p style="font-size: 10px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    	</div>
    	<div class="col-md-1"></div>
    	<div class="col-md-5">
    		<img src="last.jpg" class="last-image">
    	</div>
    </div> -->
    <div class="row row-3 mt-5">
    	<div class="col-md-4"></div>
    	<div class="col-md-4 text-center"><p class="heading">How It Works ?</p></div>
    	<div class="col-md-4"></div>
    </div>
    <div class="row row-4 mt-5">
    	<!-- <div class="col-md-1"></div> -->
    	<div class="col-md-2 text-center"><i class="fa fa-book"></i></div>
    	<div class="col-md-1 text-left"><img src="arrow.png"></div>
    	<div class="col-md-2 text-center"><i class="fa fa-book"></i></div>
    	<div class="col-md-1"><img src="arrow.png"></div>
    	<div class="col-md-2 text-center"><i class="fa fa-book"></i></div>
    	<div class="col-md-1"><img src="arrow.png"></div>
    	<div class="col-md-2 text-center"><i class="fa fa-book"></i></div>
    </div>
    <div class="row row-5 mt-5">
    	<div class="col-md-3"></div>
    	<div class="col-md-6 text-center pt-5"> 
	    	<p class="heading-row-5">A Big Revolution In Online Education ?</p>
	    	<p style="font-size: 14px;">
	    		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. 
			</p> 
    	</div>
    	<div class="col-md-3"></div>
    </div>
    <div class="row row-6 mt-5 pt-5">
    	<div class="col-md-12">
    		<div class="row row-6-1 mt-5">
    			<div class="col-md-4 text-center">
    				<i class="fa fa-tv"></i><br>
    				<b>Easy To Learn and Use</b>
    				<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p> 
				</div>
    			<div class="col-md-4 text-center">
    				<i class="fa fa-tv"></i><br>
    				<b>Highly Interactive Interface</b>
					<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p> 
				</div>
    			<div class="col-md-4 text-center">
    				<i class="fa fa-tv"></i><br>
    				<b>Advanced Reporting Interface</b>
    				<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p> 
				</div>
    		</div>
    		<div class="row row-6-2 mt-5 pt-5">
    			<div class="col-md-4 text-center">
    				<i class="fa fa-tv"></i><br>
    				<b>Splendid Support</b>
    				<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p> 
				</div>
    			<div class="col-md-4 text-center">
    				<i class="fa fa-tv"></i><br>
    				<b>smart Subscription</b>
    				<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p> 
				</div>
    			<div class="col-md-4 text-center">
    				<i class="fa fa-tv"></i><br>
    				<b>Active Accessbility</b>
    				<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p> 
				</div>
    		</div>
    	</div>
    </div>
    <footer class="page-footer font-small">
    	
    </footer>
</div>

@endsection

<style>
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
</style>