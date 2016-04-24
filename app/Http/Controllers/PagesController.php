<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function about()
    {
        $name = 'Lukas';

        return view('pages.about', compact('name'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
