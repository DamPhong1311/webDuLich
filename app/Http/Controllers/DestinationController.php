<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{

    public function index()
    {
        $destinations = Destination::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(9);
        return view('destinations.index', compact('destinations'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Destination $destination)
    {
        $destination->load([
            'comments.user:id,name'
        ]);
        return view('destinations.show', compact('destination'));
    }


    public function edit(Destination $destination)
    {
        //
    }


    public function update(Request $request, Destination $destination)
    {
        //
    }

    public function destroy(Destination $destination)
    {
        //
    }
}
