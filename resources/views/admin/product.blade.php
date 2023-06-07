<!DOCTYPE html>
<html lang="en">
  <head>
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
            <h2 class="h2_font">Add Product</h2>
            <form action="{{url('/add_product')}}" method="post" enctype="multipart/form-data">
              @csrf
            <div class="div_design">
            <label>Product Title:</label>
            <input class="input_color" type="text" name="title" placeholder="Enter product name" required>
</div>
<div class="div_design">
            <label>Product Description:</label>
            <input class="input_color" type="text" name="description" placeholder="Enter Description" required>
</div>
<div class="div_design">
            <label>Product Price:</label>
            <input class="input_color" type="number" name="price" placeholder="Enter Price" required>
</div>
<div class="div_design">
            <label>Discount Price:</label>
            <input class="input_color" type="number" name="discount_price" placeholder="Enter discount">
</div>
<div class="div_design">
            <label>Product Quantity:</label>
            <input class="input_color" type="number" min="0" name="quantity" placeholder="Enter product quantity" required>
</div>
<div class="div_design">
<label>Product Category:</label>
<select class="input_color" name="cat_id" required>
  <option value="" selected>Add a Category</option>
  @foreach($category as $categories)
    <option value="{{$categories->id}}">{{$categories->category_name}}</option>
    @endforeach
</select>
</div>

<div class="div_design">
    <label>Product Image:</label>
    <input class="input_color" type="file" name="image" required>
</div>

<div class="div_design">
            <input type="submit" value="Add" class="btn btn-success">
</div>
  </form>
</div>
</div>
</div>
   
     @include('admin.script')
  </body>
</html>
