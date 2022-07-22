<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function order_add ($city, $id, Request $request) {
        $order = new Order();

        $order->city_id = $request-> cityID;
        $order->department_id = $request->depID;
        $order->user_id = Auth::user()->id;
        $order->date = $request->date;
        $order->service = $request->service;
        $order->start_minutes = $request->timeStart;
        $order->end_minutes = $request->timeEnd;
        $order->employee_id = $request->empID;

        $order->save();

        return redirect()->route('profile', ['category' => 'user-orders']);
    }

    public function order_change_rating (Request $request) {
        Order::where('id', $request->id)->update(['rating' => $request->rating]);

        return redirect()->route('profile', ['category' => 'user-orders']);
    }

    public function order_change_status (Request $request) {

        $status_id = Order::where('id', $request->id)->get()->first()->status;
        $status_id++;

        if ($status_id <= 3) {
            Order::where('id', $request->id)->update(['status' => $status_id]);
        }
        else {
            $status_id = 1;
            Order::where('id', $request->id)->update(['status' => $status_id]);
        }

        return redirect()->route('profile', ['category' => 'user-orders']);
    }

    static public function order_user ($id) {
        $user = User::where('id', $id)->get()->first();

        return $user;
    }

}
