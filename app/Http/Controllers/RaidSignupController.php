<?php

namespace App\Http\Controllers;

use App\Raid;
use App\RaidSignup;
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

        $signup = $raid->addSignup(new RaidSignup($data));

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $signup->id
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
