<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Stripe;
use Razorpay\Api\Api;
use Redirect;




class HomeController extends Controller
{
    public function index(){

        if(Auth::id()){
        $category = Category::paginate(3);
        $comment=Comment::orderby('id','desc')->get();
        $reply=Reply::all();
        $userid = Auth::user()->id;
        $cart_count = Cart::where('user_id','=',$userid)->count();
       
        return view('home.userpage',compact('category','comment','reply','cart_count'));
        }
        else{
            $category = Category::paginate(3);
            $comment=Comment::orderby('id','desc')->get();
            $reply=Reply::all();

        return view('home.userpage',compact('category','comment','reply'));


        }
    }
    public function redirect(){

    $usertype = Auth::user()->usertype;

    if($usertype == '1'){

        $total_product = Product::all()->count();
        $total_order = Order::all()->count();
        $total_user = User::where('usertype','=',0)->get()->count();
        $order = Order::all();
        $total_revenue = 0;

        foreach($order as $orders){

            $total_revenue+=$orders->total_price;
        }

        // $total_delivered = Order::where('delivery_status','=','delivered')->get()->count();

        // $total_processing = Order::where('delivery_status','=','processing')->get()->count();


        return view('admin.home',compact('total_product','total_order','total_user','total_revenue'));
    }
    else{

        $category = Category::paginate(3);
        $comment=Comment::orderby('id','desc')->get();
        $reply=Reply::all();

        return view('home.userpage',compact('category','comment','reply'));

    }
}
    public function product_details($id){

        $product = Product::find($id);
        return view('home.product_details',compact('product'));
    }

    public function add_cart(Request $req,$id){

        if(Auth::id()){

            $user = Auth::user();
            $userid = Auth::user()->id;
            $product = product::find($id);

            $product_exist_id = Cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();
            if($product_exist_id){

                $cart = Cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $req->quantity;

                

                if($product->discount_price!=null){
               
                    $cart->price = $product->discount_price*$req->quantity ;
                    
                   }
                   else{
                   $cart->price = $product->price*$req->quantity;
       
                   }
                $cart->save();

                Alert::success('Product Added Successfully');


                return back();

            }
            else{

                $cart = new Cart;
            
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->title;
                if($product->discount_price!=null){
               
                 $cart->price = $product->discount_price*$req->quantity ;
                 
                }
                else{
                $cart->price = $product->price*$req->quantity;
    
                }
                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->quantity = $req->quantity;
    
                $cart->save();
    
                Alert::success('Product Added Successfully');
    
                return back();

            }
           




        }
        else{

            return redirect('login');
        }
    }

    public function show_cart(){

        if(Auth::id()){

            $id = Auth::user()->id;
            $cart = Cart::where('user_id','=',$id)->get();
            return view('home.showcart',compact('cart'));
        }
        else{

            return redirect('login');
        }

       
    }

    public function remove_product($id){

        $cart = Cart::find($id);
        $cart->delete();

        return back();
    }

    public function cash_order(){

     $userid = Auth::user()->id;

     $data = Cart::where('user_id','=',$userid)->get();
     
     foreach($data as $datas){

        $order = new Order;
        $order->name = $datas->name;
        $order->email = $datas->email;
        $order->phone = $datas->phone;
        $order->address = $datas->address;
        $order->user_id = $datas->user_id;
        $order->product_title = $datas->product_title;
        $order->price = $datas->price;
        $order->total_price = $datas->quantity*$datas->price;
        $order->quantity = $datas->quantity;
        $order->image = $datas->image;
        $order->product_id = $datas->product_id;
        $order->payment_status = 'Processing';
        $order->payment_mode = 'Cash on delivery';

        $order->save();

        $cart_id = $datas->id;
        $cart = Cart::find($cart_id);
        $cart->delete();

     }
     return back()->with('success','We have received your order. We will connect with you soon... ');
    }

    public function stripe($totalprice){

        return view('home.stripe',compact('totalprice'));
    }

    public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
       
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for using our service" 
        ]);

        $userid = Auth::user()->id;

     $data = Cart::where('user_id','=',$userid)->get();
     
     foreach($data as $datas){

        $order = new Order;
        $order->name = $datas->name;
        $order->email = $datas->email;
        $order->phone = $datas->phone;
        $order->address = $datas->address;
        $order->user_id = $datas->user_id;
        $order->product_title = $datas->product_title;
        $order->price = $datas->price;
        $order->total_price = $datas->quantity*$datas->price;
        $order->quantity = $datas->quantity;
        $order->image = $datas->image;
        $order->product_id = $datas->product_id;
        $order->payment_status = 'Paid';
        $order->payment_mode = 'Online';

        $order->save();

        $cart_id = $datas->id;
        $cart = Cart::find($cart_id);
        $cart->delete();

     }

      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }

    public function show_order(){

        if(Auth::id()){

        $userid = Auth::user()->id;
        $order = Order::where('user_id','=',$userid)->get();

            return view('home.order_cancel',compact('order'));
        }
        else{

            return redirect('login');
        }
    }

    public function cancel_order($id){

        $order = Order::find($id);
        $order->delivery_status = 'You have cancelled the order';
        $order->save();

        return back();
    }

    public function add_comment(Request $request){

       if(Auth::id()){
      
        $comment = new Comment;
        $comment->name = Auth::user()->name;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        return back();

       }
       else{
        return redirect('login');
       }
    }

    public function view_category($category_name){

        $category = Category::where('category_name',$category_name)->paginate(3)->first();
        $product = Product::where('cat_id',$category->id)->get();

        return view('home.product',compact('category','product'));
    }

    public function add_reply(Request $request){

        if(Auth::id()){

            $reply = new Reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();

            return back();

        }
        else{
            return redirect('login');
        }
    }

    public function category_search(Request $request){

        $search_text = $request->search;
        $category = Category::where('category_name','LIKE',"%$search_text%")->paginate(10);
        $comment=Comment::orderby('id','desc')->get();
        $reply = Reply::all();

        return view('home.userpage',compact('category','comment','reply'));
    }

    public function all_products(){

        $product = Product::paginate(10);
        return view('home.all_products',compact('product'));
    }

    public function invoice($id){

        $order = Order::find($id);
        return view('home.invoice',compact('order'));
    }

    public function success($id){

        $order = Order::find($id);
        return view('home.success',compact('order'));
    }

    public function razorpay($totalprice)
    {        
        return view('home.razorpay',compact('totalprice'));
    }

    public function payment(Request $request,$totalprice)
    {        
        $input = $request->all();
        $api = new Api (env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                $payment = Payment::create([
                    'r_payment_id' => $response['id'],
                    'method' => $response['method'],
                    'currency' => $response['currency'],
                    'user_email' => $response['email'],
                    'amount' => $totalprice*100,
                    'json_response' => json_encode((array)$response)
                ]);

                $userid = Auth::user()->id;

                $data = Cart::where('user_id','=',$userid)->get();
                
                foreach($data as $datas){
           
                   $order = new Order;
                   $order->name = $datas->name;
                   $order->email = $datas->email;
                   $order->phone = $datas->phone;
                   $order->address = $datas->address;
                   $order->user_id = $datas->user_id;
                   $order->product_title = $datas->product_title;
                   $order->price = $datas->price;
                   $order->total_price = $datas->quantity*$datas->price;
                   $order->quantity = $datas->quantity;
                   $order->image = $datas->image;
                   $order->product_id = $datas->product_id;
                   $order->payment_status = 'Paid';
                   $order->payment_mode = 'Online';
           
                   $order->save();
           
                   $cart_id = $datas->id;
                   $cart = Cart::find($cart_id);
                   $cart->delete();
           
                }
            } catch(Exception $e) {
                return $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }

          
        }
        Session::put('success',('Payment Successful'));
        return redirect()->back();
    }
    
}
