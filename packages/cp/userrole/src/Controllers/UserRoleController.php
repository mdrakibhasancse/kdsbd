<?php

namespace Cp\UserRole\Controllers;


use Event;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use Cp\Menupage\Models\Menu; 
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
class UserRoleController extends Controller
{ 
    public function dashboard(){
       $user = Auth::user();
       $todayOrdersCount = $user->orders->where('created_at', '>', now()->toDateString())->count();
       $cancelOrdersCount = $user->orders->where('order_status', 'canceled')->count();
       $orders = $user->orders()->paginate(30);
       return view('userrole::user.userDashboard', compact('user', 'todayOrdersCount', 'cancelOrdersCount', 'orders'));
    }

    public function changeMyInformation(Request $request){

        $user = Auth::user();
        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->mobile  = $request->mobile;
        $old_password = $user->password;

        if (Hash::check($request->old_password, $old_password)) {
            if (!Hash::check($request->new_password, $old_password)) {
                if ($request->new_password == $request->confirm_password) {
                    $user = User::find(Auth::id());
                    $user->password = Hash::make($request->new_password);
                } else {
                    alert()->error('New password and Confirm doed not match!');
                    return redirect()->back();
                }
            } else {
                alert()->error('New password and old password are same!');
                return redirect()->back();
            }
        } else {
            alert()->error('Current password is not match!');
            return redirect()->back();
        }

        $user->save();
        Auth::logout();
        alert()->success('Profile Update successfuly');
        return redirect()->back();
        
    }
}