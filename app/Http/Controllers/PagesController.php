<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function data(Request $request)
    {
        $dataVerified = false;

        $pw = $request->input('password');
        return view('leiter', compact('pw'));
    }
}
