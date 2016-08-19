<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class QuickViewController extends Controller
{
    public function index()
    {
        return view('quickview.index');
    }

    public function items()
    {
        return 'not implemented';
    }

    public function jobs()
    {
        return 'not implemented';
    }
}
