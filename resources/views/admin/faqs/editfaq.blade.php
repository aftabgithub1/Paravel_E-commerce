@extends('layouts.dashboard')

@section('page_title')
Edit FAQ
@endsection

@section('faq')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('addfaq')}}">FAQ</a>
<a class="breadcrumb-item" href="{{url('faqedit')}}/{{$edit_faq->id}}">FAQ Edit</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
      


      <div class="col-lg-6 m-auto">


        <div class="card border-info">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">Edit FAQ</h5>
          </div>
          <div class="card-body">
            @if (session('editFaqAlert'))
            <div class="alert alert-warning">
              <storng>{{session('editFaqAlert')}}</storng>
            </div>
            @endif

            <!-- @if ($errors->all())
            <div class="alert alert-success">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>
            @endif -->

            <form action="{{ url('editFaqPost') }}" method="post">
              @csrf
              <input type="hidden" name="faq_id" id="faq_id" value="{{ $edit_faq->id }}" class="form-control">
              <label for="faqQuestion">FAQ Question</label>
              <input type="text" name="faq_question" id="faqQuestion" value="{{ $edit_faq->faq_question }}" class="form-control">
              @error('faq_question')
              <small class="text-danger">{{$message}}</small>
              @enderror
              <br><br>
              <label for="faqAnswer">FAQ Answer</label>
              <input type="text" name="faq_answer" id="faqAnswer" value="{{ $edit_faq->faq_answer }}" class="form-control">
              @error('faq_answer')
              <small class="text-danger">{{$message}}</small>
              @enderror
              <br><br>
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-25">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection