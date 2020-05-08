<?php

namespace App\Http\Controllers;

use App\Raid;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RaidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $raids = Auth::user()
                    ->raids()
                    ->withCount('raiders')
                    ->latest()
                    ->get();

        return view('raids.index', compact('raids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
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

        $raid->loadCount('raiders');

        return response()->json([
            'status' => 'success',
            'raid' => $raid
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Raid  $raid
     * @return Factory|View
     */
    public function show(Raid $raid)
    {
        $raid->load('raiders');

        return view('raids.show', compact('raid'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Raid  $raid
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Raid $raid)
    {
        $this->authorize('update', $raid);

        $data = $request->validate([
            'description' => 'required',
            'faction' => 'required|in:Horde,Alliance',
            'location' => 'required',
            'soft_reserves' => 'boolean',
            'start_at' => 'required|date'
        ]);

        $raid->update($data);
        $raid->loadCount('raiders');

        return response()->json([
            'status' => 'success',
            'raid' => $raid
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Raid  $raid
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Raid $raid)
    {
        $this->authorize('delete', $raid);

        try {
            $raid->delete();
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Could not find this raid, it was probably already deleted'
            ], 400);
        }

        return response()->json([
            'status' => 'OK',
            'message' => 'raid deleted'
        ]);
    }
}
