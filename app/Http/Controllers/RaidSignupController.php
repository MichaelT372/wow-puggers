<?php

namespace App\Http\Controllers;

use App\Raid;
use App\RaidSignup;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RaidSignupController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @param  Raid  $raid
     * @return JsonResponse
     */
    public function store(Request $request, Raid $raid)
    {
        $data = $request->validate([
            'character_name' => 'required|string',
            'class' => 'required|string',
            'spec' => 'required|string',
            'note' => 'nullable|string',
            'soft_reserve' => 'string',
            'douse' => 'nullable|boolean'
        ]);

        $signup = new RaidSignup($data);
        $signup->note = $data['note'] ?? null;

        $signup = $raid->addSignup($signup);

        return response()->json([
            'status' => 'success',
            'signup' => $signup
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  RaidSignup  $raidSignup
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, RaidSignup $raidSignup)
    {
        $this->authorize('update', $raidSignup);

        $data = $request->validate([
            'character_name' => 'string',
            'class' => 'string',
            'spec' => 'string',
            'confirmed' => 'boolean',
            'soft_reserve' => 'string',
            'douse' => 'nullable|boolean'
        ]);

        $raidSignup->update($data);

        return response()->json([
            'status' => 'success',
            'signup' => $raidSignup
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RaidSignup  $raidSignup
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(RaidSignup $raidSignup)
    {
        $this->authorize('delete', $raidSignup);

        try {
            $raidSignup->delete();
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Could not find this raid, it was probably already deleted'
            ], 400);
        }

        return response()->json([
            'status' => 'OK',
            'message' => 'signup deleted'
        ]);
    }
}
