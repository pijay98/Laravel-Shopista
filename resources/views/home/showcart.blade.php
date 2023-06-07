@include('home.header')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>

    
    .center{
        margin:auto;
        width:50%;
        text-align:center;
        padding:30px;
    }
    table,th,td{
        border:1px solid grey;
    }
    .th_deg{
        font-size:20px;
        padding:5px;
        background:skyblue;
    }
    .img_size{
      width:150px;
      height:150px;
    }
    .total_deg{
        font-size: 20px;
        padding: 40px;
    }
</style>

@if(session()->has('success'))
          <div class="alert alert-success msg">
            <button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
            {{session()->get('success')}}
          </div>
          @endif

          @include('sweetalert::alert')


<div class="center">
    <table>
        <tr>
            <th class="th_deg">Product Title</th>
            <th class="th_deg">Product Quantity</th>
            <th class="th_deg">Price</th>
            <th class="th_deg">Image</th>
            <th class="th_deg">Actions</th>

        </tr>
        <?php $totalprice=0; ?>
        @foreach($cart as $carts)
        <tr>
            <td>{{$carts->product_title}}</td>
            <td>{{$carts->quantity}}</td>
            <td>Rs{{$carts->price}}</td>
            <td><img class="img_size" src="{{ asset('products/'.$carts->image) }}"></td>
            <td><a href="{{url('remove_product',$carts->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this product?')">Remove</a></td>

        </tr>
        <?php $totalprice+=$carts->price*$carts->quantity ?>
        @endforeach
    </table>
    <div>
        <h1 class="total_deg">Total Price:Rs{{$totalprice}}</h1>
    </div>
    <div>
        <h1 style="font-size:25px; padding-bottom:15px;">Proceed to Order</h1>
        <a href="{{url('cash_order')}}" class="btn btn-danger">Cash On Delivery</a>
        <a href="{{url('stripe',$totalprice)}}" class="btn btn-danger">Pay using Card</a>
        <a href="{{route('razorpay',$totalprice)}}" class="btn btn-danger">Pay using Razorpay</a>


    </div>
</div>
     @include('home.footer')
     <script>
      $(function(){
       $('.msg').delay(2000).fadeOut();
      });
      </script>

     