@extends('layouts.frontend-layout')

@section('frontend_page_title')  FAQ  @endsection

@section('faq')  active  @endsection

@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Frequently Asked Questions (FAQ)</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>FAQ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- about-area start -->
    <div class="about-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                  <div class="about-wrap text-center">
                    <h3>FAQ</h3>
                  </div>
                  <div class="accordion" id="accordionExample">
                    @php $flag = 1 @endphp
                    @foreach($faqs as $faq)
                    <div class="card border-0">
                      <div class="card-header border-0 p-0 my-3">
                          <button class="btn btn-link  {{($flag==1)?'':'collapsed'}} text-left py-3 w-100 text-white" type="button" data-toggle="collapse" data-target="#faq{{$faq->id}}" aria-expanded="true" aria-controls="faq{{$faq->id}}">
                            {{$faq->faq_question}}
                          </button>
                      </div>
                      <div id="faq{{$faq->id}}" class="collapse {{($flag==1)?'show':''}}" aria-labelledby="faq{{$faq->id}}" data-parent="#accordionExample">
                        <div class="card-body">
                          {{$faq->faq_answer}}
                        </div>
                      </div>
                    </div>
                    @php $flag++ @endphp
                    @endforeach
                  </div>
                </div>
            </div>
            <div class="row justify-content-center">{{$faqs->links()}}</div>
        </div>
    </div>
    <!-- about-area end -->

    <!-- start social-newsletter-section -->
    <section class="social-newsletter-section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newsletter text-center">
                        <h3>Subscribe  Newsletter</h3>
                        <div class="newsletter-form">
                            <form>
                                <input type="text" class="form-control" placeholder="Enter Your Email Address...">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>
@endsection