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
                        <div class="col-md-10">
                            <h4>User Profile
                                <a href="{{url('change-password')}}" class="btn btn-warning float-end">Change Password</a>
                            </h4>
                            <div class="underline mb-4"></div>
</div>
<div class="col-md-10">
    <div class="card show">
        <div class="card-header bg-primary">
            <h4 class="mb-0 text-white">User Details</h4>

</div>
<div class="card-body">
    <form action="{{url('updprofile')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" />
</div>
</div>
<div class="col-md-6">
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" />
</div>
</div>
<div class="col-md-6">
                <div class="mb-3">
                    <label>Phone Number</label>
                    <input type="number" name="phone" value="{{Auth::user()->phone}}" class="form-control" />
</div>
</div>
<div class="col-md-6">
                <div class="mb-3">
                    <label>Address</label>
                    <input type="text" name="address" value="{{Auth::user()->address}}" class="form-control" />
</div>
</div>
<div class="col-md-12">
    <button type="submit" class="btn btn-primary">Update</button>
</div>
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