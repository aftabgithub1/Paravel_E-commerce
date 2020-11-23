@extends('/layouts.dashboard')

@section('page_title')
Mail Customer
@endsection

@section('mail-customer')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('admin-dashboard')}}">Home</a>
<a class="breadcrumb-item" href="">Mail Customer</a>
@endsection

@section('content')
<div class="container">
  <h3 class="mb-4">Send your feedback via e-mail</h3>
  <div class="row">
    <div class="col-lg-8">
      <div class="feedback">
        <form action="{{url('mail-customer/send')}}" mathod="post">
          @csrf

          <input type="text" name="email" value="" placeholder="To" class="form-control px-3 @error('email') is-invalid @enderror">
         

          <input type="text" name="subject" value="" placeholder="Subject" class="form-control px-3 @error('subject') is-invalid @enderror">
          

          <textarea name="message" id="" cols="30" rows="18" placeholder="" class="form-control px-3 mb-3 @error('message') is-invalid @enderror"></textarea>
              
          <input type="submit" value="Send" class="btn btn-primary">
        </form>
      </div>
    </div>
    <div class="col-lg-4">
      @if ($errors->all())
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </strong>
      </div>
      @endif
      @if(session('mail_alert'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2>{{session('mail_alert')}}</h2>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection

