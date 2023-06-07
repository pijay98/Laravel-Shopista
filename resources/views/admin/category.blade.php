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

    .center{
      margin:auto;
      width:50%;
      text-align:center;
      margin-top:30px;
      border:3px solid white;
    }
    .div_design{
      padding-top:15px;
    }
    .th_deg{
      padding:30px;
    }
    .th_color{
      background:skyblue;
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

          <div class="div_center">
            <h2 class="h2_font">Add Category</h2>

            <form action="{{url('/add_category')}}" method="post" enctype="multipart/form-data">
              @csrf
              <input class="input_color" type="text" name="category_name" placeholder="Write Category Name">

              <div class="div_design">
    <label>Product Image:</label>
    <input class="input_color" type="file" name="image" required>
</div>

              <input type="submit" class="btn btn-success" name="submit" value="Add Category">
            </form>
           </div>
           
         <table class="center">
          <tr class="th_color">
            <th class="th_deg">Category Name</th>
            <th class="th_deg">Image</th>
            <th class="th_deg">Action</th>
          </tr>
          @foreach($cat as $cats)
          <tr>
           <td>{{$cats->category_name}}</td>
          <td> <img class="img_size" src="{{ asset('categories/'.$cats->image) }}"></td>
           <td>
            <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" href="{{url('/delete_category',$cats->id)}}">Delete</a>
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
