@include('home.header')
<style>
      .whatsapp-chat{
            bottom:10px;
            left:10px;
            position:fixed;
      }
</style>
@include('home.slider')
      </div>
      <!-- why section -->
@include('home.why')
      <!-- end why section -->
      
      <!-- arrival section -->
    @include('home.new_arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
     @include('home.category')
      <!-- end product section -->


      <div style="text-align:center; padding-bottom:30px;">
            <h1 style="font-size:30px; text-align:center; padding-top:20px; padding-bottom:20px;">Comments</h1>
            <form action="{{url('add_comment')}}" method="post">
                  @csrf
                  <textarea style="height:150px; width:600px;" placeholder="Comment Something here" name="comment"></textarea>

                  <br>

                  <input type="submit" class="btn btn-primary" value="comment">
</form>
      </div>

      <div style="padding-left:20%">
            <h1 style="font-size:20px; padding-bottom:20px;">All Comments</h1>

            @foreach($comment as $comments)
            <div>
                  <b>{{$comments->name}}</b>
                  <p>{{$comments->comment}}</p>

                  <a style="color:blue;" href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$comments->id}}">Reply</a>
            </div>
            @endforeach

            @foreach($reply as $replies)

            @if($replies->comment_id==$comments->id)
            <div style="padding-left:3%; padding-bottom:10px; padding-bottom:10px; ">

            <b>{{$replies->name}}</b>
            <b>{{$replies->reply}}</b>
            <a style="color:blue;" href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$comments->id}}">Reply</a>


            </div>
            @endif
            @endforeach

            <div style="display:none;" class="replyDiv">
            <form action="{{url('add_reply')}}" method="post">
                  @csrf
            <input type="hidden" id="commentId" name="commentId">
            <textarea style="height:100px; width:500px;" name="reply" placeholder="write something here"></textarea>
            <br>
            <button type="submit" class="btn btn-warning">Reply</button>
            <a href="javascript::void(0);" class="btn" onclick="reply_close(this)">Close</a>
</form>

      </div>
      </div>

     

      <!-- subscribe section -->
     @include('home.subscribe')
      <!-- end subscribe section -->
      <!-- client section -->
     @include('home.client')
      <!-- end client section -->
      <!-- <div class="whatsapp-chat">
            <a href="https://wa.me/+918860808389?text=I'm%20interested%20in%20your%20car%20for%20sale" target="_blank">
                  <img src="{{asset('assets/images/Whatsapp.png')}}" alt="whatsapp-logo" height="80px" width="80px">
</a>


      </div> -->
      <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/642ecf504247f20fefea30b6/1gtbdjljv';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
      <script>
            function reply(caller){
              document.getElementById('commentId').value=$(caller).attr('data-Commentid');
              $('.replyDiv').insertAfter($(caller));
              $('.replyDiv').show();
            }

            function reply_close(caller){
              $('.replyDiv').hide();
            }
      </script>

<script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
     @include('home.footer')