<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
   <style>
    .title_deg{
        text-align:center;
        font-size:25px;
        font-weight:bold;
        padding-bottom:40px;
    }
    .table_deg{
        border:2px solid white;
        width:100%;
        margin:auto;
        text-align:center;
    }
    .th_deg{
        background-color:skyblue;
    }
    .img_size{
      width:150px;
      height:150px;
    }
   </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
     @include('admin.header')

     <div class="main-panel">
          <div class="content-wrapper">
            <h1 class="title_deg">All Orders</h1>
            <table class="table_deg">
                <tr class="th_deg">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Payment Status</th>
                    <th>Payment Mode</th>
                    <th>Image</th>
                    <th>Delivery</th>
                    <th>View</th>
                    <th>Send Email</th>




                </tr>
                @foreach($order as $orders)
                <tr>
                    <td>{{$orders->name}}</td>
                    <td>{{$orders->email}}</td>
                    <td>{{$orders->address}}</td>
                    <td>{{$orders->phone}}</td>
                    <td>{{$orders->product_title}}</td>
                    <td>{{$orders->quantity}}</td>
                    <td>{{$orders->price}}</td>
                    <td>{{$orders->payment_status}}</td>
                    <td>{{$orders->payment_mode}}</td>
                    <td>
                  <img class="img_size" src="{{ asset('products/'.$orders->image) }}">

                    </td>
                    <td>
                      @if($orders->payment_status == 'Processing')
                      <a href="{{url('delivered',$orders->id)}}" onclick="return confirm('Are you sure this product is delivered?')" class="btn btn-primary">Delivery</a>
                      @else
                      <p style="color:green">Done</p>
                      @endif
                    </td>
                    <td>
                      <a href="{{url('print_pdf',$orders->id)}}" class="btn btn-secondary">View</a>
  </td>
                    <td>
                      <a href="{{url('send_email',$orders->id)}}" class="btn btn-info">Send Email</a>
                    </td>

                </tr>
                @endforeach
            </table>
</div>
</div>
   
     @include('admin.script')
  </body>
</html>