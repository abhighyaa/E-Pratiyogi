@extends('layouts.studentApp')

@section('content')

@include('partials.success')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request Form</div>
                <div class="card-body">
                    <form method="POST" action="/student/changerole">
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
                            <label for="contact" class="col-md-4 col-form-label text-md-right">Contact</label>
                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact" placeholder="Contact No" required value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" placeholder="Address" required value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="skill" class="col-md-4 col-form-label text-md-right">Skill</label>
                            <div class="col-md-6">
                            <select name="skill" id="skill" class="form-control">
							    <option value="" disabled selected>Your Skill</option>
								<option value="Science">Science</option>
							    <option value="Commerce">Commerce</option>
							    <option value="Arts">Arts</option>
							    <option value="Marketing">Marketing</option>
							    <option value="Management">Management</option>
							</select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qualification" class="col-md-4 col-form-label text-md-right">Qualification</label>
                            <div class="col-md-6">
                            <select name="qualification" id="qualification" class="form-control">
							    <option value="" disabled selected>Your Qualification</option>
                                <option value="Secondary">Secondary</option>
                                <option value="Sr.Secondary">Sr.Secondary</option>
                                <option value="Diploma">Diploma</option>
								<option value="Graduatin">Graduation</option>
							    <option value="Post Graduation">Post Graduation</option>
                                <option value="Phd">Phd</option>
							</select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">Passing Year</label>
                            <div class="col-md-6">
                                <input id="year" type="text" class="form-control" name="year" placeholder="Passing Year" required value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="percentage" class="col-md-4 col-form-label text-md-right">Percentage %</label>
                            <div class="col-md-6">
                                <input id="percentage" type="number" class="form-control" name="percentage" placeholder="Percentage" required value="">
                            </div>
                        </div>

						<div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                            <div class="col-md-6">
                            <select name="role" id="role" class="form-control">
							    <option value="" disabled selected>Your Role</option>
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