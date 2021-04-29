<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    public function index()
    {
        return view('error.index');
    }

    public function applyEnd()
    {
        return view('error.apply_end');
    }

    public function giftRedemptionEnd()
    {
        return view('error.gift_redemption_end');
    }
}
