<!DOCTYPE html>
<html lang="en">
  <head>
    
    <base href="{{asset('public')}}">
   
    @include('admin.css')
   <style>
     .div_center{

text-align: center;
padding-top: 40px;
}

.h2_font{

font-size:40px;
padding-bottom:40px;
}

.input_color{
      
      color:black;
    }
    label{
      display:inline-block;
      width:200px;
    }
    .div_design{
      padding-bottom:15px;
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

         <div class="div_center">
            <h2 class="h2_font">Update Product</h2>
            <form action="{{url('/update_product_confirm',$product->id)}}" method="post" enctype="multipart/form-data">
              @csrf
            <div class="div_design">
            <label>Product Title:</label>
            <input class="input_color" type="text" name="title" value="{{$product->title}}" required>
</div>
<div class="div_design">
            <label>Product Description:</label>
            <input class="input_color" type="text" name="description" value="{{$product->description}}" required>
</div>
<div class="div_design">
            <label>Product Price:</label>
            <input class="input_color" type="number" name="price" value="{{$product->price}}" required>
</div>
<div class="div_design">
            <label>Discount Price:</label>
            <input class="input_color" type="number" name="discount_price" value="{{$product->discount_price}}" >
</div>
<div class="div_design">
            <label>Product Quantity:</label> 
            <input class="input_color" type="number" min="0" name="quantity" value="{{$product->quantity}}" required>
</div>
<div class="div_design">
<label>Product Category:</label>
<select class="input_color" name="category" required>
  <option value="{{$product->category}}" selected>{{$product->category}}</option>
  @foreach($category as $categories)
    <option value="{{$categories->category_name}}">{{$categories->category_name}}</option>
    @endforeach
</select>
</div>

<div class="div_design">
    <label>Current Product Image:</label>
    <img style="margin:auto;" height="100" width="100" src="{{ asset('products/'.$product->image) }}">
</div>

<div class="div_design">
    <label>Change Product Image:</label>
    <input type="file" name="image">
</div>

<div class="div_design">
            <input type="submit" value="Update" class="btn btn-success">
</div>
  </form>
</div>
</div>
</div>
   
     @include('admin.script')
  </body>
</html>
