<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ChangeRequest;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Image;

class UserController extends Controller
{

    public function user_register(RegisterRequest $request) {
        if(Auth::user()) {
            return redirect()->route('profile');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }

    public function user_login(LoginRequest $request) {
        $user = $request->only(['email', 'password']);
        Auth::attempt($user);
        return redirect()->route('home');
    }

    public function user_logout() {
        Auth::logout();
        return redirect()->route('home');
    }

    public function user_update(ChangeRequest $request) {
        User::where('id', Auth::user()->id)->update([
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('profile');
    }

    public function user_update_photo(Request $request) {
        $imgName = 'user_id_' . Auth::user()->id . '.' . $request->image->GetClientOriginalExtension();

        $img = $request->file("image");
        Image::make($img)->save( public_path("img/user/" . $imgName));

        User::where('id', Auth::user()->id)->update([
            'photo' => $imgName
        ]);

        return redirect()->route('profile');
    }

    public static function user_orders ($id) {
        $user_orders = count(Order::where('user_id', $id)->get());

        return $user_orders;
    }

}
