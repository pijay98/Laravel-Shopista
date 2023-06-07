<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
   <style>
     .center{
      margin:auto;
      width:50%;
      text-align:center;
      margin-top:30px;
      border:3px solid white;
    }
    .font_size{

      text-align:center;
      font-size:40px;
      padding-bottom:40px;
    }
    .img_size{
      width:150px;
      height:150px;
    }
    .th_color{
      background:skyblue;
    }
    .th_deg{
      padding:30px;
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

          @if(session()->has('success'))
          <div class="alert alert-success msg">
            <button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
            {{session()->get('success')}}
          </div>
          @endif

          @if(session()->has('fail'))
          <div class="alert alert-danger msg">
            <button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
            {{session()->get('fail')}}
          </div>
          @endif

          <h2 class="font_size">Products</h2>

          <table class="center">
            <tr class="th_color">
                <th class="th_deg">Product Title</th>
                <th class="th_deg">Description</th>
                <th class="th_deg">Quantity</th>
                <th class="th_deg">Category</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Discount Price</th>
                <th class="th_deg">Product Image</th>
                <th class="th_deg">Delete</th>
                <th class="th_deg">Edit</th>


            </tr>

            @foreach($product as $products)
            <tr>
                <td>{{$products->title}}</td>
                <td>{{$products->description}}</td>
                <td>{{$products->quantity}}</td>
                <td>{{$products->category_name}}</td>
                <td>{{$products->price}}</td>
                <td>{{$products->discount_price}}</td>
                <td>
                  <img class="img_size" src="{{ asset('products/'.$products->image) }}">
                  
                </td>
                <td>
                 <a onclick="return confirm('Are you sure you want to delete?')" href="{{url('delete_product',$products->id)}}" class="btn btn-danger">Delete</a>
                </td>
                <td>
                 <a href="{{url('update_product',$products->id)}}" class="btn btn-success">Edit</a>
                </td>

            </tr>
            @endforeach
          </table>
</div>
</div>
   
     @include('admin.script')
     <script>
      $(function(){
       $('.msg').delay(2000).fadeOut();
      });
      </script>
  </body>
</html>