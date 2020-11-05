@extends('/layouts.dashboard')

@section('page_title')
Customer Activity
@endsection

@section('logs')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('dashboardhome')}}">Home</a>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;"><h5 class="text-white">Orders placed by {{Auth::user()->name}}<span class="float-right small">Total :</span></h5></div>

				<div class="card-body">
					@if (session('order_alert'))
						<div class="alert alert-warning" role="alert">
							<strong>{{ session('order_alert') }}</strong>
						</div>
					@endif

					<table class="table">
						<thead class="thead-light">
							<tr>
								<!-- <th>PSL</th> -->
								<th>Order Id</th>
								<th>Subtotal</th>
								<th>Total</th>
								<th>Payment Method</th>
								<th>Paid Status</th>
								<th>Created At</th>
								<th><span class="float-right">Action</span></th>
							</tr>
						</thead>
						<tbody>
						@forelse($customer_orders as $customer_order)
							<tr>
								<!-- <td>{{$loop->index+1}}</td> -->
								<td>{{$customer_order->id}}</td>
								<td>{{$customer_order->subtotal}}</td>
								<td>{{$customer_order->total}}</td>
								<td>
									@if($customer_order->payment_method == 1)
										Credit
									@else
										Cash
									@endif
								</td>
								<td>
									@if($customer_order->paid_status == 0)
										Due
									@else
										Paid
									@endif
								</td>
								<td>{{$customer_order->created_at->format('d-m-Y h:i:s A')}}</td>
								<td>
										<div class="btn-group float-right">
                      <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="icon ion-more"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{url('')}}/{{$customer_order->id}}" class="dropdown-item" type="button">View</a>
                        <a href="{{url('')}}/{{$customer_order->id}}" class="dropdown-item" type="button">Edit</a>
                        <a href="{{url('')}}/{{$customer_order->id}}" class="dropdown-item" type="button">Delete</a>
						<div class="dropdown-divider"></div>
                        <a href="{{url('download-pdf')}}/{{$customer_order->id}}" class="dropdown-item" type="button">Download PDF</a>
                        <a href="{{url('send-sms')}}/{{$customer_order->id}}" class="dropdown-item" type="button">Send SMS</a>
                      </div>
                    </div>
                  </td>
							</tr>
            @empty
              <tr>
                <td colspan=7 class="text-center">No data avilable</td>
              </tr>
						@endforelse
						</tbody>
					</table>
					<div class="row">
						<div class="col-md-12">{{$customer_orders->links()}}</div>
					</div>
					<div class="row">
						<div class="col-md-12"><a href="{{ url('') }}">See Trash</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
