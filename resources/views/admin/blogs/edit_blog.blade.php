@extends('layouts.dashboard')

@section('page_title')
Create Blog
@endsection

@section('createblog')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('admin-dashboard')}}">Home</a>
<a class="breadcrumb-item" href="{{url('create-blog')}}">Create Blog</a>
@endsection

@section('content')
<h1>Edit Blog</h1>
@endsection