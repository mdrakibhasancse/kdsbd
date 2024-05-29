<?php

namespace Cp\Frontend\Controllers;


use App\Http\Controllers\Controller;
use Cp\Product\Models\Product;
use Cp\Product\Models\ProductCategory;
use Cp\Product\Models\ProductSubCategory;
use Cp\Product\Models\Branch;
use Cp\Product\Models\BranchArea;
use Cp\Product\Models\Order;
use Cp\Product\Models\OrderItem;
use Cp\Menupage\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Cp\Product\Models\Cart;
use Cp\Slider\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Models\User;
use Carbon\Carbon;
use Mail;


class FrontendController extends Controller
{
    public function welcome(Request $request)
    {

        $name = $request->cookie('area_name');
        $area = BranchArea::where('name_en',  $name)->first();
        if($area){
           $branch = $area->branch;
           $categories = $branch->categories()->whereHas('products', function($q){
              $q->whereActive(true);
           })->whereActive(true)->latest()->get();
           $sliders = Slider::whereActive(true)->latest()->take(4)->get();
           return view('frontend::welcome.welcome',compact('categories', 'branch', 'sliders'));
         
        }else{
        //    $branch = Branch::inRandomOrder()->first();
           $categories = ProductCategory::whereHas('products', function($q){
              $q->whereActive(true);
           })->whereActive(true)->latest()->get();
           $sliders = Slider::whereActive(true)->latest()->take(4)->get();
           return view('frontend::welcome.welcome',compact('categories', 'sliders'));
        }
  
       
    }


    public function offerProducts(Request $request)
    {
        $name = request()->cookie('area_name');
        $area = BranchArea::where('name_en',  $name)->first();
        if($area){
            $branch = $area->branch;
            $products = $branch->products()->where('discount', '>', 0.00)->simplePaginate(8);
            $nextPageUrl = $products->nextPageUrl() ?: null;
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'view' => view('frontend::welcome.includes.productItems', ['products' => $products])->render(),
                    'nextPageUrl' => $nextPageUrl,
                ]);
            }

            return view('frontend::welcome.offerProducts',compact('products' , 'nextPageUrl'));
        }else{
            return back();
        }
  
       
    }


    
    public function categoriesAll(Request $request){
        $categories = ProductCategory::whereActive(true)->latest()->get();
        return view('frontend::welcome.categoriesAll',compact('categories'));
    }

    public function category(Request $request, $slug){

        
        $category = ProductCategory::where('slug', $slug)->first();
        if(!$category){
            abort(404);
        }

        $products =  $category->products()->whereActive(true)->simplePaginate(8);
        $nextPageUrl = $products->nextPageUrl() ?: null;
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'view' => view('frontend::welcome.includes.productItems', ['products' => $products])->render(),
                'nextPageUrl' => $nextPageUrl,
            ]);
        }

        $subcategories = ProductSubCategory::whereHas('products')->where('product_category_id', $category->id)->get();


        return view('frontend::welcome.category',compact('category','products' , 'nextPageUrl', 'subcategories'));
    }


    public function subcategory(Request $request)
    {

        $category = ProductCategory::where('id', $request->cat_id)->first();
        if ($request->has('subcategory_ids') && !empty($request->input('subcategory_ids'))) {
            $productsIds = DB::table('product_subcats')
                ->whereIn('product_subcategory_id', $request->input('subcategory_ids'))
                ->pluck('product_id');
            $products = Product::whereIn('id', $productsIds)->latest()->simplePaginate(100);
            $nextPageUrl = $products->nextPageUrl() ?: null;

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'view' => view('frontend::welcome.includes.productItems', ['products' => $products])->render(),
                    'nextPageUrl' => $nextPageUrl,
                ]);
            }

            return view('frontend::welcome.category',compact('category','products' , 'nextPageUrl'));
        } else {


            $products =  $category->products()->whereActive(true)->latest()->simplePaginate(100);
            $nextPageUrl = $products->nextPageUrl() ?: null;
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'view' => view('frontend::welcome.includes.productItems', ['products' => $products])->render(),
                    'nextPageUrl' => $nextPageUrl,
                ]);
            }

            return view('frontend::welcome.category',compact('category','products' , 'nextPageUrl'));
            }
    }



    public function product(Request $request, $slug , $id){

        $product = Product::where('slug', $slug)->where('id', $id)->first();
        if(!$product){
            abort(404);
        }
        return view('frontend::welcome.product',compact('product'));
    }





    public function areaChange(Request $request)
    {
        $id = $request->id;
        $area = BranchArea::where('id',$id)->first();

        $cookie = $request->cookie('area_name');
        if($cookie){
            cookie()->queue(cookie()->forget('area_name'));
            cookie()->queue(cookie('area_name', $area->name_en, 60 * 24 * 30 * 2));
        }else{
            cookie()->queue(cookie('area_name', $area->name_en, 60 * 24 * 30 * 2));
        }
        
        if ($request->ajax()) {
            return Response()->json([
                'view' => View('frontend::welcome.includes.areaLocation', [
                ])->render()
            ]);
        }
    }


    public function addToCart(Request $request)
    {

        $session_id = Session::get('session_id');
        if(empty($session_id)){
            $session_id = Session::getId();
            Session::put('session_id', $session_id);
        }

        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = 0;
        }

        $name = $request->cookie('area_name');
        $area = BranchArea::where('name_en',  $name)->first();
        $product = Product::where('id', $request->product)->first();

        if($area){
           $branch = $area->branch;

           if($branch){
                $cart = Cart::where('product_id', $product->id)->where('session_id', $session_id)->where('user_id', $user_id)->where('branch_id', $branch->id)->first();
            
                if ($cart) {
                    $cart->quantity   = $cart->quantity + $request->qty;
                    $cart->save();
                } else {
                    $cart             = new Cart();
                    $cart->product_id = $product->id;
                    $cart->session_id = $session_id;
                    $cart->user_id    = $user_id;
                    $cart->branch_id  = $branch->id;
                    $cart->quantity   = $request->qty;
                    $cart->addedby_id = $user_id;
                    $cart->save();
                }

                $totalCartAmount = totalCartAmount();
                $totalCartItems = totalCartItems();
                if ($request->ajax()) {
                    $collections = Cart::getCartItems();
                    return Response()->json([
                        'status' => true,
                        'message' => 'item is added to cart!',
                        'totalCartItems' => $totalCartItems,
                        'totalCartAmount' => $totalCartAmount,
                        
                        'view' => View('frontend::layouts.inc.headerCart', [
                            'collections' => $collections,
                        ])->render(),

                        'chekoutBtn' => View('frontend::layouts.inc.chekoutBtn', [
                            // 'cart' =>  $cart,
                            // 'product' =>  $product,
                        ])->render(),

                        'productCartItem' => View('frontend::welcome.includes.productCartItem', [
                            'cart' =>  $cart,
                            'product' =>  $product,
                        ])->render(),


                    ]);
                }
        

            }else{
                abort(404);
            }
         
        }

        
    }


    public function cartUpdateQty(Request $request)
    {
        $cart = Cart::find($request->cart);
        $product = $cart->product;
        if($request->new_qty == 0){
            $cart->delete();
        }
        Cart::where('id', $request->cart)->update(['quantity' => $request->new_qty]);
        $totalCartAmount = totalCartAmount();
        $totalCartItems = totalCartItems();
        $totalDiscountCartAmount = totalDiscountCartAmount();
        $totalOriginalCartAmount = totalCartAmount() + totalDiscountCartAmount();

        if ($request->ajax()) {
            
            $collections = Cart::getCartItems();
            return response()->json([
                'status' => true,
                'message' => 'item is updated to cart!',
                'totalCartAmount' => $totalCartAmount,
                'totalCartItems' => $totalCartItems,
                'totalDiscountCartAmount' => $totalDiscountCartAmount,
                'totalOriginalCartAmount' => $totalOriginalCartAmount,

                'view' => View('frontend::layouts.inc.headerCart', [
                    'collections' => $collections,
                ])->render(),

                'productCartItem' => View('frontend::welcome.includes.productCartItem', [
                    'cart' =>  $cart,
                    'product' =>  $product,
                ])->render(),

                'chekoutBtn' => View('frontend::layouts.inc.chekoutBtn', [
                    // 'cart' =>  $cart,
                    // 'product' =>  $product,
                ])->render(),

                'checkoutItems' => View('frontend::welcome.includes.checkoutItems', [
                    'collections' => $collections,
                ])->render(),

                
            ]);
        }
    }


    public function cartRemoveItem(Request $request)
    {
        $cart = Cart::find($request->cart);
        $product = $cart->product;
        $cart->delete();
        $totalCartItems = totalCartItems();
        $totalCartAmount = totalCartAmount();
        $totalDiscountCartAmount = totalDiscountCartAmount();
        $totalOriginalCartAmount = totalCartAmount() + totalDiscountCartAmount();
        if ($request->ajax()) {
            $collections = Cart::getCartItems();
            return response()->json([
                'status' => true,
                'message' => 'item is remove from cart!',
                'totalCartAmount' => $totalCartAmount,
                'totalDiscountCartAmount' => $totalDiscountCartAmount,
                'totalOriginalCartAmount' => $totalOriginalCartAmount,
                'totalCartItems' => $totalCartItems,

                'view' => View('frontend::layouts.inc.headerCart', [
                        'collections' => $collections,
                    ])->render(),

                'productCartItem' => View('frontend::welcome.includes.productCartItem', [
                    'product' => $product,
                ])->render(),

                'chekoutBtn' => View('frontend::layouts.inc.chekoutBtn', [
                    // 'cart' =>  $cart,
                    // 'product' =>  $product,
                ])->render(),

                'checkoutItems' => View('frontend::welcome.includes.checkoutItems', [
                    'collections' => $collections,
                ])->render(),
            ]);
        }
    }


    public function checkout()
    {
        $collections = Cart::getCartItems();
        $order = Auth::user()->orders()->first();  

        $total_amount = 0;
        foreach ($collections as $cart) {
           $total_amount = $total_amount + ($cart->product->final_price * $cart->quantity);
        }
        
        if($total_amount >= 1000){
           return view('frontend::welcome.checkout', compact('collections','order'));
        }else{
            alert()->error('Orders below 1000tk are not accepted');
            return redirect('/');
        }
        
    }



    public function sendOtp(Request $request)
    {

        // dd('ok');
        $request->merge([
            'mobile' => $request->valid_mobile,
        ]);


        $validation = Validator::make(
            $request->all(),
            [
                'mobile'    => 'required',
            ]
        );

        if ($validation->fails()) {
            if ($request->ajax()) {
                return Response()->json(array(
                    'success' => false,
                    'errors' => $validation->errors()->toArray(),
                    'message' => 'Please, fill-up the form correctly and try again.'
                ));
            }

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $to = $request->mobile;
        $otp = rand(111111,999999);


        $cookie = $request->cookie('mobile_saved');
        if($cookie){
            cookie()->queue(cookie()->forget('mobile_saved'));
            cookie()->queue(cookie('mobile_saved', $otp."|".$to , 1 * 4));
        }else{
            cookie()->queue(cookie('mobile_saved', $otp."|".$to, 1 * 4));
        }

        $otp = $otp . ' is Your One-Time PIN Code. It will expire in next 4 Minutes. kdsbd.com';
    
        $url = smsUrl($to, $otp);
        $client = new Client();
        try {
            $r = $client->request('GET', $url);
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
        } catch (\GuzzleHttp\Exception\ClientException $e) {
        }

       if($request->ajax())
       {
            return response()->json([
                'success' => true,
            ]);
       }

       return back();

    }


   


    public function sendOtpMatch(Request $request){
     
      
        $cookie = $request->cookie('mobile_saved');

          if($cookie){
            $code = substr($cookie, 0, 6);
            $requestCode = $request->code;
       
            if ($code === $requestCode) {
                $mobile = substr($cookie, -14);
                $user = User::where('mobile', $mobile)->first(); 
                if($user){
                    Auth::loginUsingId($user->id, true);
                    cartSessionToUser();
                    cookie()->queue(cookie()->forget('mobile_saved'));
                    if (request()->ajax()) {
                        return response()->json([
                            'loginSuccess' => true,
                        ]);
                    } 
                }else{
                    if (request()->ajax()) {
                        $page = View('frontend::welcome.includes.sentOtpSubmit')->render();
                        return response()->json([
                            'success' => true,
                            'page' =>  $page,
                        ]);
                    }
                }

               
            }else{
                if (request()->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' =>  'Please Enter a Valid Pin Code!',
                    ]);
                }
            }

        }else{
            return back();
        }
        
    }


    public function sendOtpMatchUser(Request $request){

        $cookie = $request->cookie('mobile_saved');
        if($cookie){
            $mobile = substr($cookie, -14);
            $user = User::where('mobile', $mobile)->first(); 
            if ($user) {
                Auth::loginUsingId($user->id, true);
                cartSessionToUser();
                cookie()->queue(cookie()->forget('mobile_saved'));
                return redirect()->route('checkout');   
            } else {
                $user = new User;
                $user->name = $request->name;
                $user->mobile = $mobile;
                $user->password = Hash::make('11112222');
                $user->password_temp = '11112222';
                $user->save();
                Auth::loginUsingId($user->id, true);
                cartSessionToUser();
                cookie()->queue(cookie()->forget('mobile_saved'));
                alert()->success('user created successfully');
                return redirect()->route('checkout');
            }
            
        }else{
            return back();
        }
    }



    public function orderStore(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'nullable|email',
            'address_title' => 'required',
            'address_line' => 'required',
            'area_name' => 'required',
        ]);

        

        $collections = Cart::getCartItems();
        $total_amount = 0;
        foreach ($collections as $cart) {
           $total_amount = $total_amount + ($cart->product->final_price * $cart->quantity);
        }

        if($total_amount >= 1000){
            $name = $request->cookie('area_name');
            $area = BranchArea::where('name_en',  $name)->first();
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->branch_id = $area->branch_id;
            $order->name = $request->name;
            $order->mobile = $request->mobile;
            $order->email = $request->email;
            $order->address_title = $request->address_title;
            $order->address_line = $request->address_line;
            $order->area_name = $request->area_name;
            $order->total_amount = totalCartAmount();
            $order->pending_at = Carbon::now();
            $order->addedby_id = Auth::user()->id;
            $order->save();

            $cardItems = Cart::where('user_id', Auth::user()->id)->get();

            if ($cardItems) {
                foreach ($cardItems as $cart) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->branch_id = $area->branch_id;
                    $orderItem->user_id = Auth::user()->id;
                    $orderItem->product_id = $cart->product_id;
                    $orderItem->product_name = $cart->product->name_en;
                    $orderItem->product_price = $cart->product->final_price;
                    $orderItem->quantity = $cart->quantity;
                    $orderItem->total_cost = $cart->product->final_price * $cart->quantity;
                    $orderItem->addedby_id = Auth::user()->id;
                    $orderItem->save();
                }
            }

            Cart::where('user_id', Auth::user()->id)->delete();
            alert()->success('Order Successfully');
            return redirect('/');
        }else{
            alert()->error('Orders below 1000tk are not accepted');
            return redirect('/');
        }


       
    }


    public function page($slug)
    {
        $data['page'] = Page::whereActive(true)->where('slug', $slug)->first();
        return view('frontend::welcome.page', $data);
    }



    public function search(Request $request)
    {
        $q = $request->q;
        $products = Product::where(function ($qq) use ($q) {
            $qq->orWhere('name_en', 'like', "%" . $q . "%")
                ->orWhere('name_bn', 'like', "%" . $q . "%");
        })->paginate(12);

        if ($request->ajax()) {
            return response()->json([
                'view' => view('frontend::welcome.includes.productItems', ['products' => $products])->render(),
            ]);
        } else {
            return view('frontend::welcome.search', ['products' => $products]);
        }
    }

    
    public function sitemap()
    {
        // $data['pages'] = Page::where('active', true)->get();
        return response()->view('frontend::welcome.sitemap')->header('Content-Type', 'text/xml');
    }

    

    
}