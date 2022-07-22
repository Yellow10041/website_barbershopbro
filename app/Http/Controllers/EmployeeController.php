<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Order;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public static function employee_rating_avg ($id) {
        $employee_ratings = Order::where('employee_id', $id)->get();

        $rating_num = 0;
        $rating_sum = 0;
        $rating = 0;

        foreach ($employee_ratings as $employee_rating) {
            if ($employee_rating->rating) {
                $rating_num++;
                $rating_sum += $employee_rating->rating;
            }
        }

        if($rating_num != 0) {
            $rating = round($rating_sum / $rating_num, 1);
        }

        return $rating;
    }

    public static function employee_orders_count ($id) {
        $orders_count = count(Order::where('employee_id', EmployeeController::employee_user($id)->id)->where('status', 2)->get());

        return $orders_count;
    }

    public static function employee_user ($id) {
        $employee = Employee::where('user_id', $id)->get()->first();

        return $employee;
    }

    public static function user_employee ($id) {
        $user = User::where('id', Employee::where('id', $id)->get()->first()->user_id)->get()->first();

        return $user;
    }

    public static function employee_user_rate ($id) {
        $employee_id = EmployeeController::employee_user($id)->id;
        $employee_rate = EmployeeController::employee_rating_avg($employee_id);
        return $employee_rate;
    }


}
