@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <!-- <router-view name="subject"></router-view> -->
            <subject-component></subjet-component>
        </div>
        <div class="col-md-8">
             <!-- <router-view name="instruction"></router-view> -->
             <instruction-component></instruction-component>
        </div>
    </div>
</div>
@endsection
