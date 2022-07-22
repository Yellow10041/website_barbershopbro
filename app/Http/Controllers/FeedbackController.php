<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Feedback;
use App\Models\User;

use App\Http\Requests\FeedbackRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FeedbackController extends Controller
{
    public function feedback() {
        return view('feedback', ['data' => Feedback::get()->reverse()]);
    }

    public function feedback_add(FeedbackRequest $request) {
        $feedback = new Feedback();
        $feedback->user_ID = Auth::user()->id;
        $feedback->text = $request->text;
        $feedback->score = $request->score;
        $feedback->save();

        $user = User::where('ID', Auth::user()->id)->get();

        return redirect()->route('feedback', ['data' => Feedback::get()->reverse(), 'user' => $user]);
    }

    public function feedback_delete(Request $request) {
        if(Gate::check('profile_moderator')) {
            $feedback = Feedback::where('id', $request->id);
        }
        else {
            $feedback = Feedback::where('user_ID', Auth::user()->id)->where('id', $request->id);
        }

        if ($feedback){
            $feedback->delete();
        }


        return redirect()->route('profile');
    }
}
