@extends('layouts.app')

@section('content')
@include('partials.success')
@include('partials.error')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <!-- <router-view name="subject"></router-view> -->
            <course-component></course-component>
        </div>
        <div class="col-md-6">
             <!-- <router-view name="instruction"></router-view> -->
             <instruction-component></instruction-component>
        </div>
        <div class="col-md-3">
             <!-- <router-view name="instruction"></router-view> -->
             <subject-component></subject-component>
        </div>
    </div>
</div>
@endsection
