<?php

namespace App\Http\Controllers;


use App\Answer;
use Illuminate\Http\Request;
use function auth;
use function back;
use function request;

class VoteAnswerController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function __invoke(Answer $answer)
    {
        $vote = (int) request()->vote;
        auth()->user()->voteAnswer($answer, $vote);
        return back();
    }
}
