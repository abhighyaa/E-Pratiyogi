
@extends('layouts.app1')

@section('content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request Form</div>
                <div class="card-body text-center" >
                    <form method="POST" action="/student/changerole">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right"><b>Username</b> :</label>
                            <div class="col-md-6">
                                 <p class="col-sm-6 col-form-label text-md-left">{{ $data->request->username }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right"><b>Email</b> :</label>
                            <div class="col-md-6">
                                 <p class="col-sm-6 col-form-label text-md-left">{{ $data->request->email }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right"><b>Contact</b> :</label>
                            <div class="col-md-6">
                                 <p class="col-sm-6 col-form-label text-md-left">{{ $data->request->contact }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right"><b>Address</b> :</label>
                            <div class="col-md-6">
                                 <p class="col-sm-6 col-form-label text-md-left">{{ $data->request->address }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right"><b>Skill</b> :</label>
                            <div class="col-md-6">
                                 <p class="col-sm-6 col-form-label text-md-left">{{ $data->request->skill }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right"><b>Qualification</b> :</label>
                            <div class="col-md-6">
                                 <p class="col-sm-6 col-form-label text-md-left">{{ $data->request->qualification }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right"><b>Passing Year</b> :</label>
                            <div class="col-md-6">
                                 <p class="col-sm-6 col-form-label text-md-left">{{ $data->request->year }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right"><b>Percentage</b> :</label>
                            <div class="col-md-6">
                                 <p class="col-sm-6 col-form-label text-md-left">{{ $data->request->percentage }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right"><b>Desired Role</b> :</label>
                            <div class="col-md-6">
                                 <p class="col-sm-6 col-form-label text-md-left">{{ $data->request->role }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <a href="http://localhost:8000/admin/dashboard"><button class="btn btn-default">Back</button></a>&nbsp;
                                <a href="/"><button class="btn btn-danger">Decline</button></a>&nbsp;
                                <a href="/"><button class="btn btn-success">Accept</button></a>
                             </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection