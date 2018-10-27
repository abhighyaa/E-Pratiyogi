@extends('layouts.studentApp')

@section('content')
@include('partials.success')
@include('partials.error')

<div class="container-fluid">
    <router-view></router-view>
</div>
@endsection
