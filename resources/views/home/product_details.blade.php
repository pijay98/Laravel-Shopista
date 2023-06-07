@include('home.header')

      <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; width:50%; padding:30px;">
                     <div class="img-box" style="padding:20px;">
                        <img src="{{ asset('products/'.$product->image) }}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$product->title}}
                        </h5>

                        @if($product->discount_price!=null)
                        <h6 style="color:red">
                        Discount price
                        <br>
                           Rs {{$product->discount_price}}
                        </h6>

                        <h6 style="text-decoration:line-through;color:blue">
                        Price
                        <br>
                           Rs {{$product->price}}
                        </h6>

                        @else
                        <h6 style="color:blue">
                        Price
                        <br>
                           Rs {{$product->price}}
                        </h6>
                        @endif

                        <h6>Product Quantity: {{$product->category}}</h6>
                        <h6>Product Description: {{$product->description}}</h6>
                        <h6>Product Quantity: {{$product->quantity}}</h6>

                        <form action="{{url('add_cart',$product->id)}}" method="post">
                              @csrf
                              <div class="row">
                                 <div class="col-md-4">
                              <input type="number" name="quantity" value="1" min="1" style="width:100px">
                                 </div>
                                 <div class="col-md-4">
                              <input type="submit" value="Add to Cart">
                                 </div>
</div>
                           </form>

                       
                     </div>
                  </div>
               </div>
     @include('home.footer')