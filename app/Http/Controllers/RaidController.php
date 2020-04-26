<?php

namespace App\Http\Controllers;

use App\Raid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $raids = Auth::user()->raids()->simplePaginate(10, ['*'], 'myRaids');

        return view('raids.index', compact('raids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
            'faction' => 'required|in:Horde,Alliance',
            'location' => 'required',
            'loot_rules' => 'required',
            'soft_reserves' => 'boolean',
            'start_at' => 'required|date'
        ]);

        $raid = new Raid($data);
        $raid->loot_rules = $data['loot_rules'];

        Auth::user()->raids()->save($raid);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $raid->id
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Raid  $raid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Raid $raid)
    {
        $raid->load(['raiders' => function ($query) {
            $query->select(['id', 'character_name', 'class', 'spec', 'soft_reserve', 'douse', 'confirmed', 'raid_id']);
        }]);

        return view('raids.show', compact('raid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Raid  $raid
     * @return \Illuminate\Http\Response
     */
    public function edit(Raid $raid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Raid  $raid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Raid $raid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Raid  $raid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Raid $raid)
    {
        //
    }
}
