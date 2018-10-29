@extends('layouts.studentApp')

@section('content')
@include('partials.success')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change Password</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('change/my/password') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="old" class="col-sm-4 col-form-label text-md-right">Old Password</label>

                            <div class="col-md-6">
                                <input id="email" type="password" class="form-control" name="old_password" required autofocus>
                                    @if(session()->has('old_error'))
                                        <span style="color: red;">
                                             <strong>{{ session()->get('old_error') }}</strong>
                                         </span>
                                    @endif
                                    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="new_password" required>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Confirm New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="new_confirm_password" required>
                                @if(session()->has('confirm_error'))
                                        <span style="color: red;">
                                             <strong>{{ session()->get('confirm_error') }}</strong>
                                         </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='error'>
    @include('partials.list')
</div>
@endsection
<script>
        $( document).ready( function(){
            $('div.alert').not('.alert-important').delay(3000).slideUp(300);
        });
    </script>