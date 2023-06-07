@include('home.header')


<h1 class="text-center">Payment Successful</h1>

<a class="text-center" href="">Back to Home</a>

<a class="text-center" href="{{url('generate-invoice/'.$order->id)}}">Download Invoice</a>


@include('home.footer')