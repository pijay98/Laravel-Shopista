<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function view_category(){

        $cat = Category::all();
        return view('admin.category',compact('cat'));
    }

    public function add_category(Request $req){

        $data = new Category();
        $data->category_name = $req->category_name;
        $image = $req->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $req->image->move('categories',$imagename);
        $data->image = $imagename;
        $data->save();

        return redirect('view_category')->with('success','Added Successfully');
    }

    public function delete_category($id){

        $data = Category::find($id);
        $data->delete();

        return redirect('view_category')->with('fail','Deleted Successfully');
    }

    public function view_product(){
        
        $category = Category::all();
        return view('admin.product',compact('category'));
    }

    public function add_product(Request $req){

      $product = new Product();
      $product->title = $req->title;
      $product->description = $req->description;
      $product->price = $req->price;
      $product->discount_price = $req->discount_price;
      $product->quantity = $req->quantity;
      $product->cat_id = $req->cat_id;
      
      $image = $req->image;
      $imagename = time().'.'.$image->getClientOriginalExtension();
      $req->image->move('products',$imagename);
      $product->image = $imagename;
      $product->save();

      return redirect('show_product')->with('success','Added Successfully');

    }

    public function show_product(){

        $product = Product::join('categories','categories.id','=','products.cat_id')
                          ->select('categories.*','products.*',)
                          ->get();
        return view('admin.product_lists',compact('product'));
    }

    public function delete_product($id){

        $product = Product::find($id);
        $product->delete();

        return redirect('show_product')->with('fail','Deleted Successfully');
    }

    public function update_product($id){

        $product = Product::find($id);
        $category = Category::all();
        return view('admin.update_product',compact('product','category'));
    }

    public function update_product_confirm(Request $req,$id){

        $product = Product::find($id);
        $product->title = $req->title;
        $product->description = $req->description;
        $product->price = $req->price;
        $product->discount_price = $req->discount_price;
        $product->quantity = $req->quantity;
        $product->category = $req->category;

        $image = $req->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $req->image->move('products',$imagename);
            $product->image = $imagename;
        }
       
        $product->save();

        return redirect('show_product')->with('success','Updated Successfully');
    }

    public function order(){

        $order = Order::all();
        return view('admin.order',compact('order'));
    }

    public function delivered($id){

        $order = Order::find($id);
        $order->payment_status = "Paid";
        $order->save();

        return back();
    }

    public function print_pdf($id){

        $order = Order::find($id);
        // return view('admin.pdf',compact('order'));
        $pdf = PDF::loadView('admin.pdf',compact('order'));
        return $pdf->download('invoice.pdf');
    }

    public function send_email($id){

        try{
        $order = Order::find($id);
        Mail::to("$order->email")->send(new InvoiceMail($order));
        return redirect('order');
          
        }
        catch(Exception $e){

        }

    }

    public function profile(){

        return view('admin.userprofile');
    }

    public function updateprofile(Request $request){

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return back();
    }

    public function passwordcreate(){

        return view('admin.change-password');
    }

    public function updatepassword(Request $request){

        $request->validate([

            'password' => ['required','confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password,auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password)
            ]);

            return back()->with('success','Password Updated Successfully');
        }
        else{
            return back()->with('fail','Password does not match');
        }
    }

    // public function send_user_email(Request $request,$id){

    //     $order = Order::find($id);

    //     $details = [
    //         'greeting' => $request->greeting,
    //         'firstline' => $request->firstline,
    //         'body' => $request->body,
    //         'button' => $request->button,
    //         'url' => $request->url,
    //         'lastline' => $request->lastline,
    //     ];
    //     Notification::send($order,new SendEmailNotification($details));

    //     return back();
    // }
}
