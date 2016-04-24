<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BrokenItem;
use App\Item;
use App\Http\Requests;

class BrokenItemController extends Controller
{
    public function index()
    {
        $items = BrokenItem::all();

        return view('broken.all', compact('items'));
    }

    public function report($id)
    {
        $item = Item::findOrFail($id);

        return view('broken.report', compact('item'));
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);

        return view('broken.all-item', compact('item'));
    }

    public function edit($id, $broken_id)
    {
        $item = Item::findOrFail($id);
        $broken = BrokenItem::findOrFail($broken_id);

        return view('broken.edit', compact('item', 'broken'));
    }

    public function open($id, Request $request)
    {
        $this->validate($request, [
            'count' => 'required|integer|min:1',
            'comment' => 'required|string'
        ]);

        $item = Item::findOrFail($id);
        $input = $request->input();
        $broken = new BrokenItem;
        $broken->item_id = $id;
        $broken->count = $input['count'];
        $broken->comment = $input['comment'];
        $broken->save();

        return redirect()->action('BrokenItemController@show', ['id' => $id]);
    }

    public function close($id, $broken_id, Request $request)
    {
        BrokenItem::findOrFail($broken_id)->delete();

        return response()->alertBack('Makierung als "defekt" entfernt.', 'success');
    }

    public function change($id, $broken_id, Request $request)
    {
        $this->validate($request, [
            'count' => 'required|integer|min:1',
            'comment' => 'required|string'
        ]);

        $input = $request->input();
        $broken = BrokenItem::findOrFail($broken_id);
        $broken->count = $input['count'];
        $broken->comment = $input['comment'];
        $broken->save();

        return response()->alertBack('Makierung als "defekt" bearbeitet.', 'success');
    }
}
