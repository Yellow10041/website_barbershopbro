<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Moderator;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    public static function moderator_user ($id) {
        $moderator = Moderator::where('user_id', $id)->get()->first();

        return $moderator;
    }
}
