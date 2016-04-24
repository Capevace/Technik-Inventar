<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Job;
use App\User;
use App\UsedItem;
use App\Item;
use App\Http\Requests;
use Validator;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();

        return view('jobs.all', compact('jobs'));
    }

    public function create()
    {
        $users = User::all();

        return view('jobs.create', compact('users'));
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);

        return view('jobs.show', compact('job'));
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        $users = User::all();
        $items = Item::all();

        return view('jobs.edit', compact('job', 'users', 'items'));
    }

    public function store(Request $request)
    {
        $input = $request->input();

        $validator = $this->validateOrBack($request);
        if ($validator) {
            return $validator;
        }

        $job = Job::create($input);

        return response()->alertBack('Auftrag wurde hinzugefügt! ' . link_to('jobs/' . $job->id, 'Anzeigen'), 'success');
    }

    public function change($id, Request $request)
    {
        $input = $request->input();

        $validator = $this->validateOrBack($request);
        if ($validator) {
            return $validator;
        }

        $job = Job::findOrFail($id);
        $job->name = $input['name'];
        $job->is_rental = $input['is_rental'];
        $job->description = $input['description'];
        $job->recipent = $input['recipent'];
        $job->leader = $input['leader'];
        $job->time_start = $input['time_start'];
        $job->time_end = $input['time_end'];
        $job->save();

        return response()->alertBack('Artikel wurde bearbeitet!', 'success');
    }

    public function changeItems(Request $request)
    {
        $input = $request->input();

        $validator = Validator::make($request->all(), [
            'items' => 'required|json',
            'items.*.item_id' => 'required|integer|min:1',
            'items.*.job_id' => 'required|integer|min:1',
            'items.*.use_count' => 'required|integer|min:1'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        UsedItem::where('job_id', $input['job_id'])->delete();

        $items = json_decode($input['items']);
        foreach ($items as $item) {;
            $used = new UsedItem;
            $used->item_id = $item->item_id;
            $used->job_id = $input['job_id'];
            $used->use_count = $item->use_count;
            $used->save();
        }

        return response()->alertBack('Artikel wurde bearbeitet!', 'success');
    }

    public function validateOrBack($request)
    {
        $real_time_start = $request->input()['time_start'] - 1;
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => '',
            'recipent' => 'max:255',
            'is_rental' => 'required|boolean',
            'leader' => 'required|integer|min:1',
            'time_start' => 'required|date',
            'time_end' => 'required|date|after:real_time_start'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    }
}
