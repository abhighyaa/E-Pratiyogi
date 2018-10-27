           @extends('layouts.app2')

@section('content')

<div class="container-fluid">
    <div class="row row-1">
    	<div class="col-md-12">
		<div class="row row-1-1">
    			<div class="col-md-2"></div>
    			<div class="col-md-2 text-right">
    				<a href="/"><img src="logo.png" class="img-responsive navbarLogo"></a>
    			</div>
    			<div class="col-md-8 mt-4">
    				<nav class="navbar navbar-expand-lg navbar-light bg-white pl-5 " >
					    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					    <span class="navbar-toggler-icon"></span>
					    </button>
					    <div class="collapse navbar-collapse" id="navbarNav">
						    <ul class="navbar-nav">
						      <li class="nav-item active">
						        <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="/student/home">EPtest<span class="sr-only">(current)</span></a>
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
						        <a class="nav-link" href="#">Contact <span class="sr-only">(current)</span></a>
						      </li>
						@guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Signup<span class="sr-only">(current)</span></a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    @if( Auth::user()->role->first()->pivot->role_id !== 1)
                                         <a class="dropdown-item" href="{{ route('profile', ['id' =>  Auth::user()->id ])}}">Manage Profile</a>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest	
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
					<!-- <a href=""><button class="btn btn-primary btn-lg">Get Started</button></a> -->
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
	    	<p class="heading-row-5">A Big Revolution In Online Education System</p>
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
    				<i class="fa fa-book-reader fa-2x features-icon"></i><br>
    				<b style="color: rgb(112,128,144);font-weight:700;font-size:18px;">Easy To Learn and Use</b>
    				<p class="pt-1">One-stop-destination for examination, preparation, recruitment, and more. Specially designed online quiz system to enhance your knowledge. The platform is smooth to use with a translational flow of information.</p> 
				</div>
    			<div class="col-md-4 text-center">
    				<i class="fa fa-address-card fa-2x features-icon"></i><br>
    				<b style="color: rgb(112,128,144);font-weight:700;font-size:18px;">User Friendly Interface</b>
					<p class="pt-1">A click to the next trick, simple registration, signing- in, synchronized processing, smoothly test uploading.</p> 
				</div>
    			<div class="col-md-4 text-center">
    				<i class="fa fa-flag-checkered fa-2x features-icon"></i><br>
    				<b style="color: rgb(112,128,144);font-weight:700;font-size:18px;">Advanced Reporting Interface</b>
    				<p class="pt-1">Instant scorecard generation, computational analysis, efficient feedback sharing to boost up your performance and precision.</p> 
				</div>
    		</div>
    		<div class="row row-6-2 mt-5">
    			<div class="col-md-4 text-center">
    				<i class="fa fa-people-carry fa-2x features-icon"></i><br>
    				<b style="color: rgb(112,128,144);font-weight:700;font-size:18px;">Splendid Support</b>
    				<p class="pt-1">Your request and our actions to strive triggered support. A dedicated team is working round the clock to provide 24 X 7 streamlined access to our technical experts .</p> 
				</div>
    			<div class="col-md-4 text-center">
    				<i class="fa fa-tv fa-2x features-icon"></i><br>
    				<b style="color: rgb(112,128,144);font-weight:700;font-size:18px;">Smart Subscription</b>
    				<p class="pt-1">Premium selection to the suited subscription that will match your preferences and priorities of using the online assessment platform.</p> 
				</div>
    			<div class="col-md-4 text-center">
    				<i class="fa fa-universal-access fa-2x features-icon"></i><br>
    				<b style="color: rgb(112,128,144);font-weight:700;font-size:18px;">Active Accessbility</b>
    				<p class="pt-1">Go wherever you want to and practice whenever you want, using the next level online exam platform. Experience a lag-free synchronized performance of think exam on your mobile devices.</p> 
				</div>
    		</div>
    	</div>
    </div>
    <!-- Footer -->
    <div class="row mt-5 footer">
		<div class="footContentBox col-md-4">
		<h3>Contact</h3>
		   		<div class="row">
				   <div class="col-md-6">
						<address>
						<span><b>Registered Office</b></span>
							59, Ashok Nagar, Bhilwara,
							Rajasthan, India
							PIN - 311001
						</address>
				   </div>
				   <div class="col-md-6">
		   				<address>
						   <span><b>Development Office</b></span>
							67, East Extension, Subhash Nagar,
							Bhilwara, Rajasthan, India
							PIN - 311001
						</address>
				   </div>
				</div>		 
		</div>
		<div class="footContentBox col-md-4">
			<h3>Connect</h3>
			<div class="follow">
				<ul class="social my-4 nav ">
					<li class="nav-item">
					<a class="nav-link follow-link" itemprop="sameAs" target="_blank" href="https://www.facebook.com/readybytes">
					<i title="Official Facebook" class="fa fab fa-facebook-square"> </i>
					</a>
					</li>
					<li class="nav-item">
					<a class="nav-link follow-link" itemprop="sameAs" target="_blank" href="https://www.twitter.com/readybytes">
					<i title="Official Twitter" class="fa fab fa-twitter-square"> </i>
					</a>
					</li>
					<li class="nav-item">
					<a class="nav-link follow-link" itemprop="sameAs" target="_blank" href="https://plus.google.com/+readybytesnet">
					<i title="Official Google Plus" class="fa fab fa-google-plus-square"> </i>
					</a>
					</li>
					<li class="nav-item">
					<a class="nav-link follow-link" itemprop="sameAs" target="_blank" href="https://www.youtube.com/readybytes">
					<i title="Official youtube" class="fa fab fa-youtube-square"> </i>
					</a>
					</li>
					<li class="nav-item">
					<a class="nav-link follow-link" itemprop="sameAs" target="_blank" href="https://github.com/readybytes">
					<i title="Official GitHub" class="fa fab fa-github-alt"> </i>
					</a>
					</li>
				</ul>
			</div>
			<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Username" aria-label="Recipient's username" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button">Signup</button>
  </div>
</div>
		</div>	
		<div class="footContentBox col-md-4">
		<h3>Our Mission</h3>
			<div class="ourMission">
		   		<p>To bring a revolution in digital education system, provide a platform where one can learn & 
				   make existance of such kind of a platform where each and every student, teacher, professor and recruiter could get benefited by it.</p>
			</div>
		</div>
		<div class="atLast justify-content-center">	   
			<p class="text-center text-uppercase">
			© 2009–2018 | READY BYTES SOFTWARE LABS PVT. LTD.</p>
	</div>
	</div><!-- </footer> -->
	
		 </div>
 	</div>
</div>

@endsection

<style>
.navbarLogo{
	margin-top:30px;
}
.navbar{
	border-radius:3px;
}
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
	background:linear-gradient(to top left,rgba(10,113,138),rgb(69, 181, 198));
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
	font-size: 18px;
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
	background:#34363C;
	color:white;
	min-height:400px;
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
	border : solid 1px rgb(69, 181, 198);
	color:rgb(69, 181, 198);
}
.features-icon
{
	color:rgb(112,128,144);
}
.fa-2x{
	color:rgba(205,205,205);
}
.btn-lg{
	text-align: center;
    width: 10em;
    height: 3em;
    background: none !important;
    margin-left: 30%;
    border: 1px solid white !important;
    font-size: 14px !important;
}
.atLast{
	background:rgba(0,0,0,0.4);
	width:100%;
	padding:0;
}

.atLast p{
	font-size: 16px;
    margin-top: 60px;
    display: inherit;
    color: rgba(90,90,90);
    font-weight: bolder;
}
.ourMission p{
	font-size:16px;
	color:rgba(222,222,222);
}
.btn-outline-secondary:hover{
	background:#1E7C98 !important;
}
.follow-link{
	font-size:28px;
	color:#40B2C7;
}
.follow-link:hover{
	color:#1E7C98;
}
h3{
	text-align: center;
    padding: 10px 0;
    font-size: 20px !important;
	font-weight: bolder !important;
}
address{
    font-size: 16px;
	color:rgba(222,222,222);
}
address span{
    display: inherit;
    font-size: 17px;
    letter-spacing: .5;
}
</style>