@extends('layouts.dashboard')

@section('page_title')
Add Coupon
@endsection

@section('addcoupon')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{route('coupon.index')}}">Add Coupon</a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">


      <!-- FORM STARTS -->
      <div class="col-lg-3">
        <div class="card">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">Add coupon</h5>
          </div>
          <div class="card-body">
          @if (session('addcouponalert'))
          <div class="alert alert-warning">
            <strong>{{session('addcouponalert')}}</strong>
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
            <form action="{{ route('coupon.store') }}" method="post">
              @csrf

              <div class="form-group">
                <label for="couponName">Coupon Name</label>
                <input type="text" name="coupon_name" id="couponName" value="{{old('coupon_name')}}" class="form-control @error('coupon_name') is-invalid @enderror">
                @error('coupon_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
              <div class="form-group">
                <label for="couponDiscount">Discount</label>
                <input type="text" name="coupon_discount" id="couponDiscount" value="{{old('coupon_discount')}}" class="form-control @error('coupon_discount') is-invalid @enderror">
                @error('coupon_discount')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
              <div class="form-group">
                <label for="validityDate">Validity Date</label>
                <input type="date" name="validity_date" id="validityDate" value="{{old('validity_date')}}" class="form-control @error('validity_date') is-invalid @enderror">
                @error('validity_date')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-info">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <!-- TABLE STARTS -->
      <div class="col-lg-9">
        <div class="card">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">Coupons Table</h5>
          </div>
          <div class="card-body">    <!-- overflow-auto -->
          @if (session('coupon_table_allert'))
          <div class="alert alert-warning">
            <storng>{{session('coupon_table_allert')}}</storng>
          </div>
          @endif
            <table class="table">    <!-- text-nowrap -->
              <thead class="thead-light">
                <tr>
                  <th class="text-wrap">Coupon Name</th>
                  <th>Discount</th>
                  <th>Validity Date</th>
                  <th>Validity Status</th>
                  <th>Created at</th>
                  <th>Date modified</th>
                  <th><span class="float-right">Action</span></th>
                </tr>
              </thead>
              <tbody>
              @forelse($coupons as $coupon)
                <tr>
                  <td>{{$coupon->coupon_name}}</td>
                  <td>{{$coupon->coupon_discount}}</td>
                  <td>{{Carbon\Carbon::parse($coupon->validity_date)->format('d/m/Y')}}</td>
                  <td>
                    @php
                    $to = $coupon->validity_date;
                    $from = $coupon->created_at;
                    $days = Carbon\Carbon::parse($to)->diffInDays($from);
                    @endphp
                    
                    @if($to >= $from)
                    {{$days}} {{($days > 1)? "days left" : "day left" }}
                    @else
                    <a href="#" class="badge badge-success">Expired</a>
                    @endif
                  </td>
                  <td>{{$coupon->created_at->format('d/m/y h:i A')}}</td>
                  <td>
                    @if (isset($coupon->updated_at))
                      {{$coupon->updated_at->diffForHumans()}}
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
                        <a href="{{url('coupon.view-coupon')}}/{{$coupon->id}}" class="dropdown-item" type="button">View</a>
                        <a href="{{url('couponedit')}}/{{$coupon->id}}" class="dropdown-item" type="button">Edit</a>
                        <a href="{{url('coupondelete')}}/{{$coupon->id}}" class="dropdown-item" type="button">Delete</a>
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
              <div class="col-md-12">{{$coupons->links()}}</div>
            </div>
            <div class="row">
						  <div class="col-md-12"><a href="{{ url('/coupontrash') }}">See Trash</a></div>
					  </div>
          </div>
        </div>
      </div>



    </div>
</div>
@endsection