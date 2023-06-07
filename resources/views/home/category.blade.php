<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>Categories</span>
               </h2>
               <div>
                  <form action="{{url('category_search')}}" method="get">
                     @csrf
                     <input style="width:500px;" type="text" name="search" placeholder="Search for something">

                     <input type="submit" value="search">
                  </form>
               </div>
            </div>
            <div class="row">
               @foreach($category as $categories)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('view-category',$categories->category_name)}}" class="option1">
                           Product Details
                           </a>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="{{ asset('categories/'.$categories->image) }}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$categories->category_name}}
                        </h5>
                     </div>
                  </div>
               </div>
              @endforeach
              <span style="padding-top:20px;">
              {!!$category->withQueryString()->links('pagination::bootstrap-5')!!}
</span>
         </div>
      </section>