<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
     @include('admin.header')
     <div class="main-panel">
          <div class="content-wrapper">
            <div class="py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
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
</div>
<div class="col-md-10">
    <div class="card show">
        <div class="card-header bg-primary">
            <h4 class="mb-0 text-white">User Details</h4>

</div>
<div class="card-body">
    <form action="{{url('updpassword')}}" method="post">
        @csrf
                <div class="mb-3">
                    <label>Current Password</label>
                    <input type="text" name="current_password" class="form-control" />
</div>
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="text" name="password" class="form-control" />
</div>
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="text" name="password_confirmation" class="form-control" />
</div>

<div class="mb-3 text-end">
    <hr>
    <button type="submit" class="btn btn-primary">Update</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
   
     @include('admin.script')
  </body>
</html>