<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ItemType;
use App\Item;
use App\Http\Requests;

class ItemTypeController extends Controller
{
    public function index()
    {
        $types = ItemType::all();

        return view('items.types', compact('types'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:item_types',
            'comment' => 'required|string'
        ]);

        $input = $request->input();
        $type = new ItemType;
        $type->name = $input['name'];
        $type->comment = $input['comment'];
        $type->save();

        return response()->alertBack('Artikel-Kategorie erfolgreich hinzugefügt.', 'success');
    }

    public function change($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:item_types',
            'comment' => 'required|string'
        ]);

        $input = $request->input();
        $type = ItemType::findOrFail($id);
        $type->name = $input['name'];
        $type->comment = $input['comment'];
        $type->save();

        return response()->alertBack('Artikel-Kategorie erfolgreich bearbeitet.', 'success');
    }

    public function delete($id)
    {
        if ($id == 1)
            return response()->alertBack('Kategorie "Allgemein" darf nicht gelöscht werden.', 'warning');

        $type = ItemType::findOrFail($id);

        $items = $type->items;
        foreach ($items as $item) {
            $item->type_id = 1;
            $item->save();
        }

        $type->delete();

        return response()->alertBack('Artikel-Kategorie erfolgreich gelöscht.', 'success');
    }
}
