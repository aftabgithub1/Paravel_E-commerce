@extends('layouts.dashboard')

@section('page_title')
FAQ
@endsection

@section('faq')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('addfaq')}}">FAQ</a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

      <!-- TABLE STARTS -->
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">FAQs</h5>
          </div>
          <div class="card-body">    <!-- overflow-auto -->
          @if (session('faqdelete'))
          <div class="alert alert-warning">
            <storng>{{session('faqdelete')}}</storng>
          </div>
          @endif
            <table class="table">    <!-- text-nowrap -->
              <thead class="thead-light">
                <tr>
                  <th class="text-wrap">Questions</th>
                  <th>Answers</th>
                  <th>Created at</th>
                  <th>Date modified</th>
                  <th><span class="float-right">Action</span></th>
                </tr>
              </thead>
              <tbody>
              @forelse($faqs as $faq)
                <tr>
                  <td>{{$faq->faq_question}}</td>
                  <td>{{$faq->faq_answer}}</td>
                  <td>{{$faq->created_at->format('d/m/y h:i A')}}</td>
                  <td>
                    @if (isset($faq->updated_at))
                      {{$faq->updated_at->diffForHumans()}}
                    @else
                    -
                    @endif
                  </td>
                  <td>
                    <div class="btn-group float-right">
                      <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon ion-more"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{url('faq.view-faq')}}/{{$faq->id}}" class="dropdown-item" type="button">View</a>
                        <a href="{{url('faqedit')}}/{{$faq->id}}" class="dropdown-item" type="button">Edit</a>
                        <a href="{{url('faqdelete')}}/{{$faq->id}}" class="dropdown-item" type="button">Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan=5 class="text-center text-danger"><h3>No data available</h3></td>
                </tr>
              @endforelse
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-12">{{$faqs->links()}}</div>
            </div>
            <div class="row">
						  <div class="col-md-12"><a href="{{ url('/faqtrash') }}">See Trash</a></div>
					  </div>
          </div>
        </div>
      </div>


      <!-- STARTS FORM -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">Add FAQ</h5>
          </div>
          <div class="card-body">
          @if (session('alert'))
          <div class="alert alert-warnong">
            <strong>{{session('alert')}}</strong>
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
            <form action="{{ url('addfaqpost') }}" method="post">
              @csrf

              <div class="form-group">
                <label for="faqQuestion">FAQ Question</label>
                <input type="text" name="faq_question" id="faqQuestion" value="{{old('faq_question')}}" class="form-control @error('faq_question') is-invalid @enderror">
                @error('faq_question')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
              <div class="form-group">
                <label for="faqAnswer">FAQ Answer</label>
                <input type="text" name="faq_answer" id="faqAnswer" value="{{old('faq_answer')}}" class="form-control @error('faq_answer') is-invalid @enderror">
                @error('faq_answer')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-info w-25">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection