@extends('/layouts.dashboard')

@section('page_title')
Admin Home
@endsection

@section('dashboard')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('admin-dashboard')}}">Home</a>
@endsection

@section('content')


<div class="row row-sm">
  <div class="col-sm-6 col-xl-3">
    <div class="card pd-20 pd-sm-25">
      <div class="d-flex align-items-center justify-content-between mg-b-10">
        <h6 class="card-body-title tx-12 tx-spacing-1">User Accounts</h6>
        <a href="" class="tx-gray-600 hover-info"><i class="icon ion-more"></i></a>
      </div><!-- d-flex -->
      <h2 class="tx-purple tx-lato tx-center mg-b-15">{{$total_user}}</h2>
      <p class="mg-b-0 tx-12"><span class="tx-success">...</span> </p>
    </div><!-- card -->
  </div><!-- col-3 -->
  <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
    <div class="card bg-purple tx-white pd-25">
      <div class="d-flex align-items-center justify-content-between mg-b-10">
        <h6 class="card-body-title tx-12 tx-white-8 tx-spacing-1">Product Category</h6>
        <a href="" class="tx-white-8 hover-white"><i class="icon ion-more"></i></a>
      </div><!-- d-flex -->
      <h2 class="tx-lato tx-center mg-b-15">{{$total_category}}</h2>
      <p class="mg-b-0 tx-12 op-8">...</p>
    </div><!-- card -->
  </div><!-- col-3 -->
  <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
    <div class="card pd-20 pd-sm-25">
      <div class="d-flex align-items-center justify-content-between mg-b-10">
        <h6 class="card-body-title tx-12 tx-spacing-1">Total Products</h6>
        <a href="" class="tx-gray-600 hover-info"><i class="icon ion-more"></i></a>
      </div><!-- d-flex -->
      <h2 class="tx-teal tx-lato tx-center mg-b-15">{{$total_product}}</h2>
      <p class="mg-b-0 tx-12"><span class="tx-danger">...</span> </p>
    </div><!-- card -->
  </div><!-- col-3 -->
  <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
    <div class="card bg-teal tx-white pd-25">
      <div class="d-flex align-items-center justify-content-between mg-b-10">
        <h6 class="card-body-title tx-12 tx-white-8 tx-spacing-1">Cart</h6>
        <a href="" class="tx-white-8 hover-white"><i class="icon ion-more"></i></a>
      </div><!-- d-flex -->
      <h2 class="tx-lato tx-center mg-b-15">{{$total_cart}}</h2>
      <p class="mg-b-0 tx-12 op-8">...</p>
    </div><!-- card -->
  </div><!-- col-3 -->
</div><!-- row -->

<div class="row mt-4">
  <div class="col-lg-6 col-sm-12">
    <div class="card">
      <canvas id="myChart_1" width="400" height="225"></canvas>
    </div>
  </div>
  <div class="col-lg-6 col-sm-12">
    <div class="card">
      <canvas id="myChart_2" width="400" height="225"></canvas>
    </div>
  </div><!-- row -->
</div>
@endsection

@section('footer_script')
<script>

var ctx = document.getElementById('myChart_1').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['last_week','Day Before Yesterday', 'Yesterday', 'Today'],    //'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'        
        datasets: [{
            label: 'Sales Chart',
            data: [{{$last_week}}, {{$day_before_yesterday}}, {{$yesterday_sale}}, {{$todays_sale}}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                // 'rgba(153, 102, 255, 0.5)',
                // 'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                // 'rgba(153, 102, 255, 1)',
                // 'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var ctx = document.getElementById('myChart_2').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['last_week', 'Day Before Yesterday', 'Yesterday', 'Today'],    //'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'        
        datasets: [{
            label: 'Sales Chart',
            data: [{{$last_week}}, {{$day_before_yesterday}}, {{$yesterday_sale}}, {{$todays_sale}}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                // 'rgba(153, 102, 255, 0.5)',
                // 'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                // 'rgba(153, 102, 255, 1)',
                // 'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
@endsection
