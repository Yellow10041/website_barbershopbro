<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public static function view () {
        $employees = Employee::take(4)->get();

        return view('home', ['employees' => $employees]);
    }
}
