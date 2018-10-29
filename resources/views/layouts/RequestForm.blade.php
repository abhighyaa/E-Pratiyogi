@extends('layouts.studentApp')

@section('content')

@include('partials.success')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request Form</div>
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right">Username</label>
                            <div class="col-md-6">
                                <input id="username" type="name" class="form-control" name="username" required autofocus value="{{ $name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required value="{{ $email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Education" class="col-md-4 col-form-label text-md-right">Education</label>
                            <div class="col-md-6">
                            <select name="role" id="department" class="form-control">
							    <option value="">Select One</option>
								<option>Science</option>
							    <option>Commerce</option>
							    <option>Arts</option>
							    <option>Marketing</option>
							    <option>Management</option>
							</select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Designation" class="col-md-4 col-form-label text-md-right">Designation</label>
                            <div class="col-md-6">
                            <select name="role" id="department" class="form-control">
							    <option value="">Select One</option>
								<option>Graduated</option>
							    <option>Post Graduated</option>
							    <option>Student</option>
							</select>
                            </div>
                        </div>

						<div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Select Role</label>
                            <div class="col-md-6">
                            <select name="role" id="department" class="form-control">
							    <option value="">Select One</option>
								    @foreach ($roles as $role)
								    	@if($role->name == $role_of_user)
								        <option disabled value="{{ $role->name }}">{{ $role->name }}</option>
								        @else
								        <option value="{{ $role->name }}">{{ $role->name }}</option>
								        @endif
								    @endforeach 
							</select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">Passing Year</label>
                            <div class="col-md-6">
                                <input id="year" type="number" class="form-control" name="email">
                            </div>
                        </div>


                         <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Request
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection