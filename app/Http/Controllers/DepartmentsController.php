<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Departments;
use App\Models\City;
use App\Models\Service;
use App\Models\Employee;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DepartmentsController extends Controller
{
    public function departments($city) {
        $city_info = City::where('city', $city)->get()->first();


        $cities = ['Ternopil', 'Kyiv', 'Krakow'];
        $cities_ready[] = $city;
        foreach ($cities as $town) {
            if ($town != $city) {
                $cities_ready[] = $town;
            }
        }

        if ($city_info) {
            $departments = Departments::where('city_id', $city_info->id)->get();

            return view('departments', ['data' => $departments, 'city' => $city, 'cities' => $cities_ready]);
        }
        else {
            return view('departments', ['city' => $city, 'cities' => $cities_ready]);
        }
    }

    public function department_view(Request $request, $city, $id) {

        $data = Departments::where('id', $id)->get();

        $employyes = Employee::where('city_id', $request->cityID)->where('department_id', $id)->get();

        $services = Service::get();




//        dd($request->cityID, $request->depID, $request->date);
//dd($employees = Employee::get());
//        dd(Order::where('city_id', 1)->where('department_id', 1)->where('date', '2022.04.30')->where('employee_id', 2)->get()->first());
        if ($request->ajax()) {
            //вибірка всіх працівників
            $employees = Employee::get();
            $employee_id = 1;

            //цикл з переліченням кожного працівника
            foreach ($employees as $employee) {
                //вибірка всіх замовлень даного працівника
                $orders = Order::where('city_id', $request->cityID)
                    ->where('department_id', $request->depID)
                    ->where('date', $request->date)
                    ->where('employee_id', $employee->id)
                    ->get();

                $employee_ready[$employee_id] = 0;

                //цикл з перебором всіх замовлень даного працівника
                foreach ($orders as $order) {
                    //перевірка чи працівник вільний в період часу
                    if (
                        $request->timeStart >= $order->start_minutes AND $request->timeStart < $order->end_minutes
                        OR
                        $request->timeEnd > $order->start_minutes AND $request->timeEnd < $order->end_minutes
                        OR
                        $request->timeStart < $order->start_minutes AND $order->start_minutes < $request->timeEnd
                        OR
                        $request->timeStart < $order->end_minutes AND $order->end_minutes < $request->timeEnd
                    ) {
                        $employee_ready[$employee_id] = 1;
                        break;
                    }
                }
                print_r($employee_ready[$employee_id]);
                $employee_id++;
            }

            return 0;
        };

        return view('view', [
            'data' => $data,
            'city' => $city,
            'employees' => $employyes,
            'services' => $services
        ]);
    }



}
