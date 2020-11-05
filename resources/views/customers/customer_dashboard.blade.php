@extends('/layouts.dashboard')

@section('page_title')
Customer Dashboard
@endsection

@section('dashboard')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('dashboardhome')}}">Home</a>
@endsection

@section('content')
<h1 class="text-center mt-4">Customer Dashboard</h1>
@endsection