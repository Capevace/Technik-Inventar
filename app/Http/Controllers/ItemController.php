<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Item;
use App\ItemType;
use App\Http\Requests;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('items.all', compact('items'));
    }

    public function create()
    {
        $types = ItemType::all();

        return view('items.create', compact('types'));
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);

        return view('items.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $types = ItemType::all();

        return view('items.edit', compact('item', 'types'));
    }


    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|max:255',
        //     'type' => 'required|integer|min:1',
        //     'total_count' => 'required|integet|min:0'
        // ]);
        $input = $request->input();
        $validator = $this->validateOrBack($request);
        if ($validator) {
            return $validator;
        }

        $item = Item::create($input);

        return response()->alertBack('Artikel wurde hinzugefügt! ' . link_to('items/' . $item->id, 'Anzeigen'), 'success');
    }

    public function change($id, Request $request)
    {
        $input = $request->input();

        $validator = $this->validateOrBack($request);
        if ($validator) {
            return $validator;
        }

        $item = Item::findOrFail($id);
        $item->name = $input['name'];
        $item->type_id = $input['type_id'];
        $item->total_count = $input['total_count'];
        $item->comment = $input['comment'];
        $item->img = $input['img'];
        $item->save();

        return response()->alertBack('Artikel wurde bearbeitet!', 'success');
    }

    public function delete($id, Request $request)
    {
        Item::findOrFail($id)->delete();

        return $this->index();
    }

    public function validateOrBack($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'type_id' => 'required|integer|min:1',
            'total_count' => 'required|integer|min:1',
            'comment' => '',
            'img' => 'url'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        return false;
    }
}
