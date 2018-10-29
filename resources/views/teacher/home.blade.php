@extends('layouts.studentApp')

@section('content')
@include('partials.success')
@include('partials.error')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <category-component></category-component>
        </div>
        <div class="col-md-8">
             <details-component></details-component>
        </div>
    </div>
</div>
@endsection
