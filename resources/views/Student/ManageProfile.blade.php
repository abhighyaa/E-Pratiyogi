@extends('layouts.studentApp')

@section('content')
@include('partials.success')
@include('partials.error')

<div class="container-fluid">
   <student-profile></student-profile>
</div>
@endsection