@extends('layouts.app')

@section('content')
@include('partials.success')
@include('partials.error')

<div class="container-fluid">
    <student-home></student-home>
</div>
@endsection
