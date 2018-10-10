@extends('layouts.app1')

@section('content')

	<div class="row pt-3 pl-5 pb-2" style="background-color:rgba(10,113,138);color: white; ">
		<div class="col-sm-8">
			<h3>E-Pratiyogi</h3>
		</div>
    <div class="col-sm-2 text-right">
      <button class="btn"><i class="fa fa-user-cog"></i>&ensp;Admin Panel</button>
    </div>
		<div class="col-sm-2 text-left">
			<!-- logout-->
      <ul class="navbar-nav ml-auto">
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

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
      </ul>  
        <!--logout end  -->
		</div>
	</div>
  <div class="row mt-0">
    <div class="col-md-2 graduation-icon-parent">
        <p class="text-center mt-2 Graduate-icon">
            <i class="fa fa-user-graduate fa-5x"></i>
        </p>
        <admin-component></admin-component>
    </div>  
    <div class="col-md-10">
          <dashboard-component></dashboard-component>
      </div>
  </div>    
    

@endsection

<style>
<<<<<<< HEAD
  .graduation-icon-parent 
  {
    background-color:rgba(10,113,138);.
    
=======
  .col-md-2{
    padding-right:0px !important;
  }
  .graduation-icon-parent 
  {
    background-color:rgba(10,113,138);

>>>>>>> 5e7167102a93601f6666ff378d693936da142300
  }
  .Graduate-icon 
  {
    color: white;
  }
  .admin-btn
  {
    border:none;
    background-color: transparent; 
    color: white;
  }
  .nav-link
  {
    color: white;
  }
  .nav-link:hover
  {
    color:#8599ad;
  }
  
  .btn
  {
    background: #8599ad;
    color: white;
  }
</style>

