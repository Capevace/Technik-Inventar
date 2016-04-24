<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ItemType;
use App\Http\Requests;

class ItemTypeController extends Controller
{
    public function index()
    {
        $types = ItemType::all();

        return view('items.types', compact('types'));
    }
}
