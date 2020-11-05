@extends('layouts.dashboard')


@section('page_title')
Product
@endsection

@section('product')
active
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

      <!-- Start TABLE -->
      <div class="col-lg-9">
        <div class="card">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">products</h5>
          </div>
          <div class="card-body">    <!-- overflow-auto -->
          @if (session('product_table_alert'))
          <div class="alert alert-warning">
            <strong>{{session('product_table_alert')}}</strong>
          </div>
          @endif
            <table class="table">    <!-- text-nowrap -->
              <thead class="thead-light">
                <tr>
                  <th>Product Photo</th>
                  <th>product Name</th>
                  <th>Category</th>
                  <th>Product Price</th>
                  <th>Quantity</th>
                  <!--
                  <th>Short Description</th>
                  <th>Long Description</th> 
                  -->
                  <!-- <th>Created at</th>
                  <th>Date modified</th> -->
                  <th><span class="float-right">Action</span></th>
                </tr>
              </thead>
              <tbody>
              @forelse($products as $product)
                <tr>
                  <td>
                    <div style="background:#bbbbdd;width:188px;">
                      <img src="{{asset('uploads/products')}}/{{$product->product_image}}" alt="" style="width:100%;">
                      @forelse($product->multiplePhotosTable as $multiple_photo)
                      <img src="{{asset('uploads/products/product_details')}}/{{$multiple_photo->product_multiple_photo_name}}" alt="" height="50" style="margin:5px;">
                      @empty
                      Not Available
                      @endforelse
                    </div>
                  </td>
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->categoryTable->category_name}}</td>
                  <td>Tk.{{$product->product_price}}</td>  <!-- Foreign Key -->
                  <td>{{$product->product_quantity}}</td>  <!-- Foreign Key -->
                  <!-- 
                  <td>{{$product->product_short_desp}}</td>
                  <td>{!!substr($product->product_long_desp, 0, 25)!!}...</td>
                  -->
                  <!--
                  <td>
                    @if (isset($product->created_at))
                      {{$product->created_at->format('d/m/y h:i A')}}
                    @else
                      -
                    @endif
                  </td>
                  <td>
                    @if (isset($product->updated_at))
                      {{$product->updated_at->diffForHumans()}}
                    @else
                    -
                    @endif
                  </td> 
                  -->
                  <td>
                    <!-- action -->
                    <div class="btn-group float-right">
                      <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon ion-more"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="" class="dropdown-item" type="button">View</a>
                        <a href="{{route('product.edit', $product->id)}}" class="dropdown-item" type="button">Edit</a>
                        <a href="{{url('productdelete')}}/{{$product->id}}" class="dropdown-item" type="button">Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan=6 class="text-center text-danger"><h3>No data available</h3></td>
                </tr>
              @endforelse
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-12">{{$products->links()}}</div>
            </div>
            <a href="{{ url('producttrash') }}">See Trash</a>
          </div>
        </div>
      </div>
      <!-- End TABLE -->

      
      <!-- Start FORM -->
      <div class="col-lg-3">
        <div class="card">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">Add Product</h5>
          </div>
          <div class="card-body">
          @if (session('add_product_form_alert'))
          <div class="alert alert-warning">
            <strong>{{session('add_product_form_alert')}}</strong>
          </div>
          @endif

            <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <label for="categoryName">category Name</label>
                <select type="text" name="category_id" id="categoryName" class="form-control" value="{{old('category_id')}}">
                  @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->category_name}}</option>
                  @endforeach
                </select>
                @error('category_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" name="product_name" id="productName" value="{{old('product_name')}}" class="form-control @error('product_name') is-invalid @enderror">
                @error('product_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>


              <div class="form-group">
                <label for="prouductPrice">Product Price</label>
                <input type="text" name="product_price" id="prouductPrice" value="{{old('product_price')}}" class="form-control @error('product_price') is-invalid @enderror">
                @error('product_price')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="productShortDesp">Short Description</label>
                <input type="text" name="product_short_desp" id="produtShortgDesp" value="{{old('product_short_desp')}}" class="form-control @error('product_short_desp') is-invalid @enderror">
                @error('product_short_desp')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="productLongDesp">Long Description</label>
                <input type="text" name="product_long_desp" id="productLongDesp" value="{{old('product_long_desp')}}" class="form-control @error('product_long_desp') is-invalid @enderror">
                @error('product_long_desp')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="productQuantity">Quantity</label>
                <input type="text" name="product_quantity" id="productQuantity" value="{{old('product_qty')}}" class="form-control @error('product_qty') is-invalid @enderror">
                @error('product_qty')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="productImage">Product Image</label>
                <input type="file" name="product_image" id="productImage" value="{{old('product_image')}}" class="form-control @error('product_image') is-invalid @enderror">
                @error('product_image')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="productMultipleImage">Product Multiple Image</label>
                <input type="file" name="product_multiple_image[]" multiple id="productMultipleImage" value="{{old('product_image')}}" class="form-control @error('product_image') is-invalid @enderror">
                @error('product_image')
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
      <!-- End FORM -->

    </div>
</div>
@endsection