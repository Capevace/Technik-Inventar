<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Fund;

class FundController extends Controller
{
    public function index()
    {
        $funds = Fund::all();

		$total = 0;

		foreach ($funds as $fund) {
			$total += $fund->value;
		}

        return view('funds.index', compact('funds', 'total'));
    }

	public function create(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|string|max:255',
			'value' => 'required|numeric'
		]);

		Fund::create($request->input());

		return response()->alertBack('Transaktion erfolgreich hinzugefügt.', 'success');
	}

	public function update(Fund $fund, Request $request)
	{
		$this->validate($request, [
			'name' => 'required|string|max:255',
			'value' => 'required|numeric'
		]);

		$input = $request->input();
		$fund->name = $input['name'];
		$fund->value = $input['value'];
		$fund->save();

		return response()->alertBack('Transaktion erfolgreich bearbeitet.', 'success');
	}

	public function delete(Fund $fund)
	{
		$fund->delete();

		return response()->alertBack('Transaktion erfolgreich gelöscht.', 'success');
	}
}
