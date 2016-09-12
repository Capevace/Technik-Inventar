<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Item;
use App\Job;
use DB;

class SearchController extends Controller
{
    public function index()
    {
        return 'search view here';
        
    }

    public function search($query)
    {
        $results = collect([]);
        $id = intval(ltrim($query, '#'));

        if (starts_with($query, '#') && is_int($id) && $id != 0) {
            $item = Item::find($id);
            if ($item != null) {
                $results->push([
                    'id' => $item->id,
                    'name' => $item->name,
                    'type' => 'item',
                    'description' => $item->comment,
                    'img' => $item->img
                ]);
            }

            $job = Job::find($id);
            if ($job != null) {
                $results->push([
                    'id' => $job->id,
                    'name' => $job->name,
                    'type' => 'job',
                    'description' => $item->description
                ]);
            }
        } else {
            // Query all items that fit
            $items = DB::table('items')->where('name', 'LIKE', '%'.$query.'%')->get();
            foreach ($items as $item) {
                $results->push([
                    'id' => $item->id,
                    'name' => $item->name,
                    'type' => 'item',
                    'description' => $item->comment,
                    'img' => $item->img
                ]);
            }

            // Query all jobs that fit
            $jobs = DB::table('jobs')->where('name', 'LIKE', '%'.$query.'%')->get();
            foreach ($jobs as $job) {
                $results->push([
                    'id' => $job->id,
                    'name' => $job->name,
                    'type' => 'job',
                    'description' => $job->description
                ]);
            }
        }

        if ($results->count() == 1) {

        } else if ($results->count() <= 0) {

        }

        return $results;
    }
}
