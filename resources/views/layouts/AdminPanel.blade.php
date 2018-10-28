@extends('layouts.app1')

@section('content')

	<div class="row pt-3 pl-5 pb-2" style="background-color:rgba(10,113,138);color: white; ">
		<div class="col-sm-8">
			<h3>E-Pratiyogi</h3>
		</div>
    <div class="col-sm-2 text-right AdminPanel">
      <!-- <button class="btn"><i class="fa fa-user"></i>&ensp;Admin Panel</button> -->
    </div>

    <!-- Notification -->
		<div class="col-sm-2 text-left">
      @if(Auth::user()->unreadNotifications->count())
        <span class="badge badge-pill badge-danger">
            {{ Auth::user()->unreadNotifications->count() }}
        </span>
      @endif
        <label class="fa fa-bell dropdown-toggle" data-toggle="dropdown">
             <span class="caret"></span>
        </label>
        <div class="dropdown-menu mt-3 dropdown-menu-right notificationPanel">
             @foreach(Auth::user()->unreadNotifications as $notification) 
                  <li class="dropdown-item">
                    <div class="notificationDetail">
                      <div class="notificationTitle">{{ $notification->data['resgistration']['title']}},</div>
                      <div class="notificationBody">{!! $notification->data['resgistration']['body'] !!}</div>
                    </div>
                  </li>
              @endforeach
            @if(Auth::user()->unreadNotifications->count())
            <div><a class="btn btn-link" href="{{ route('markAsRead') }}">Mark All As Read</a></div>
            @else
                  <div class="noNotificationMsg">
                    <span class="fa fa-bell fa-3x"></span>
                    <p>No New Notifications</p>
                  </div>
            @endif
      </div>
      <!-- End Notification -->
			<!-- logout-->
      <ul class="navbar-nav ml-auto customList">
        <li class="nav-item dropdown customlistItem">
            <span id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <label class="caret"></label>
            </span>

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
<style scoped>
div.notificationDetail{
  /* border:solid; */
  margin: 0 auto;
  background: rgba(222,222,222,0.5);
  padding: 2px 5px;
}
div.notificationTitle{
  font-weight: bolder;
  text-transform: capitalize;
}
div.notificationBody{
 
  margin: 0 auto;
  width:auto;
  height:auto;
}
li.dropdown-item{
  padding: 3px 5px;
}
.fa-bell{
  cursor:pointer;
}
ul{
  display:inline-block;
}
button{
  display:inline-block;
}
.customList{
  display: inline-block !important;
}
.customlistItem {
    display: inline-flex;
    max-width: max-content;
    margin-left: 10px;
}
.customlistItem span{
    display: inline-block !important;
    font-size:18px;
    text-transform:capitalize;
}
  .graduation-icon-parent 
  {
    background-color:rgba(10,113,138);
    padding-right:0px !important;
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
.col-md-10{
  background:rgba(20, 109, 139,0.1);
}
.notificationPanel{
    width: 400px !important;
    height: max-content;
}
.noNotificationMsg{
    text-align: center;
    font-size: 18px;
    font-family: inherit;
    color: rgba(150,150,150);
}
.noNotificationMsg p{
    margin:0;
}
.noNotificationMsg span{
    color:rgba(200,200,200);
}
</style>

