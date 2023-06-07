@include('home.header')

<style>
    .center{
        margin:auto;
        width:70%;
        padding:30px;
        text-align:center;
    }
    table,th,td{
        border:1px solid black;
    }
    .th_deg{
        padding:10px;
        background-color:skyblue;
        font-size:20px;
        font-weight:bold;
    }
    .img_size{
      width:100px;
      height:100px;
    }
</style>
<div class="center">
    <table>
        <tr>
            <th class="th_deg">Product Title</th>
            <th class="th_deg">Quantity</th>
            <th class="th_deg">Price</th>
            <th class="th_deg">Payment_status</th>
            <th class="th_deg">Delivery_status</th>
            <th class="th_deg">Image</th>
            <th class="th_deg">Cancel Order</th>
            

        </tr>

        @foreach($order as $orders)
        <tr>
            <td>{{$orders->product_title}}</td>
            <td>{{$orders->quantity}}</td>
            <td>{{$orders->price}}</td>
            <td>{{$orders->payment_status}}</td>
            <td>{{$orders->delivery_status}}</td>
            <td><img class="img_size" src="{{ asset('products/'.$orders->image) }}"></td>
            <td>
                @if($orders->delivery_status=='processing')
                <a onclick="return confirm('Are you sure you want to cancel this order?')" class="btn btn-danger" href="{{url('cancel_order',$orders->id)}}">Cancel Order</a>
                @else
                <p style="color:blue">Not Allowed</p>
                @endif
            </td>
            

        </tr>
        @endforeach
    </table>
</div>