@extends('layouts.dashboard')

@section('page_title')
FAQ Trash
@endsection

@section('trash')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('addfaq')}}">FAQ</a>
<a class="breadcrumb-item" href="{{url('faqtrash')}}">Trash</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-8 m-auto">

        <div class="card border-info">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">FAQ Trash</h5>
          </div>
          <div class="card-body">
          @if (session('faqRestoreAlert'))
          <div class="alert alert-warning">
            <strong>{{session('faqRestoreAlert')}}</strong>
          </div>
          @endif
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th>Questions</th>
                  <th>Answers</th>
                  <th>Created at</th>
                  <th>Date modified</th>
                  <th><span class="float-right">Action</span></th>
                </tr>
              </thead>
              <tbody>
              @forelse($faqs_trash as $faq)
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
                    <!-- action -->
                    <div class="btn-group float-right">
                      <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon ion-more"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="" class="dropdown-item" type="button">View</a>
                        <a href="{{url('faqrestore')}}/{{$faq->id}}" class="dropdown-item" type="button">Restore</a>
                        <a href="{{url('faqforcedelete')}}/{{$faq->id}}" class="dropdown-item" type="button">Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan=5 class="text-center text-danger">
                    <h3>{{ __('No data available') }}</h3>
                  </td>
                </tr>
              @endforelse
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-12">
                {{$faqs_trash->links()}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection