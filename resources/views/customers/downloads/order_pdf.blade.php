<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>PDF File</title>


    <style>
        .container{display:flex;justify-content:center;}
        h1{text-align:center;}.outer-table{width:100%;border-collapse:collapse;}td{height:30px;margin-right:20px;}
        .row-properties{width:200px;font-weight:bold;padding-left:20px;}
        span{float:right;padding-right:20px;}
        .inner-table-th-td{padding-right:20px;height:initial;}
    </style>
    
    
</head>
    
<body>

    <div class="container">
        <div style="width:800px;">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-info ml-4" style="text-shadow:0px 0px 3px #000;"><h1>Customer Orders</h1></div>

                    <div class="card-body">

                        <table class="outer-table">
                            <tbody>
                                <tr>
                                    <td class="row-properties">Order Id <span>:</span></td>
                                    <td> {{$customer_orders->id}} </td>
                                </tr>
                                <tr>
                                    <td class="row-properties">Name <span>:</span></td>
                                    <td> {{$customer_orders->fname}} </td>
                                </tr>
                                <tr>
                                    <td class="row-properties">Email <span>:</span></td>
                                    <td> {{$customer_orders->email}} </td>
                                </tr>
                                <tr>
                                    <td class="row-properties" style="vertical-align:top;padding-top:5px;padding-bottom:10px;">Product Details<span>:</span></td>
                                    <td style="padding-top:5px;padding-bottom:10px;">
                                        <table>
                                            <tr>
                                                <th class="inner-table-th-td">Product Name</th>
                                                <th class="inner-table-th-td">Quantity</th>
                                                <th class="inner-table-th-td">Price</th>
                                            </tr>
                                            @foreach($order_lists as $order_list)
                                            <tr>
                                                <td class="inner-table-th-td">{{$order_list->productTable->product_name}}</td>
                                                <td class="inner-table-th-td">{{$order_list->quantity}}</td>
                                                <td class="inner-table-th-td">Tk.{{$order_list->productTable->product_price}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="row-properties">Subtotal <span>:</span></td>
                                    <td> Tk.{{$customer_orders->subtotal}} </td>
                                </tr>
                                <tr>
                                    <td class="row-properties">Total <small style="font-weight:normal;">(Discount price)</small><span>:</span></td>
                                    <td> Tk.{{$customer_orders->total}}</td>
                                </tr>
                                <tr>
                                    <td class="row-properties">Ordered at <span>:</span></td>
                                    <td>{{$customer_orders->created_at->format('d M Y h:i:s a')}}</td>
                                </tr>
                            </tbody>
                        </table>

  
                    </div>
                </div>
            </div>
        </div>
    </div>

  </body>
</html>