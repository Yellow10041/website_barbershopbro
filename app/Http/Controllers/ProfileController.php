<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ModeratorController;
use App\Models\Feedback;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function view (Request $request) {

        if (Auth::user()) {
            $link = 'inc.profile.';
            $category = $request->category;

            if ($category == 'user-feedback') {
                $link .= 'user_feedback';


                if(Gate::check('profile_moderator')) {
                    $feedback = Feedback::get();
                }
                else {
                    $feedback = Feedback::where('user_ID', Auth::user()->id)->get();
                }

                $viewRender = view($link, ['feedbacks' => $feedback])->render();
            }
            elseif ($category == 'user-orders') {
                $link .= 'user_orders';

                if(Gate::check('profile_moderator')) {
                    $orders = Order::where('department_id', ModeratorController::moderator_user(Auth::user()->id)->department_id)->get()->reverse();
                }
                elseif(Gate::check('profile_barber')) {
                    $orders = Order::where('employee_id', EmployeeController::employee_user(Auth::user()->id)->id)->get()->reverse();
                }
                else {
                    $orders = Order::where('user_id', Auth::user()->id)->get()->reverse();
                }


                $viewRender = view($link, ['orders' => $orders])->render();
            }
            else {
                $category = 'user-info';
                $link .= 'user_info';
                $viewRender = view($link)->render();
            }

//            if ($request->ajax() ) {
//
//                $link = 'inc.profile.';
//
//                if ($request->category == 'user-info') {
//                    $link .= 'user_info';
//                    $viewRender = view($link)->render();
//                }
//                elseif ($request->category == 'user-feedback') {
//                    $link .= 'user_feedback';
//
//                    if(Gate::check('profile_moderator')) {
//
//                    }
//                    else {
//                        $feedback = Feedback::where('user_ID', Auth::user()->id)->get();
//                    }
//
//                    $viewRender = view($link, ['feedbacks' => $feedback])->render();
//                }
//                elseif ($request->category == 'user-orders') {
//                    $link .= 'user_orders';
//
//                    if(Gate::check('profile_moderator')) {
//
//                    }
//                    elseif(Gate::check('profile_barber')) {
//                        $orders = Order::where('employee_id', EmployeeController::employee_user(Auth::user()->id)->id)->get()->reverse();
//                    }
//                    else {
//                        $orders = Order::where('user_id', Auth::user()->id)->get()->reverse();
//                    }
//
//                    $viewRender = view($link, ['orders' => $orders])->render();
//                }
//
//
//                return $viewRender;
//            }

            return view('profile', ['content' => $viewRender, 'category' => $category]);
        }
        else {
            return redirect()->route('login');
        }
    }

}
