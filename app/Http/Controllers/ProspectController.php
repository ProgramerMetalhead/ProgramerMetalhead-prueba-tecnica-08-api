<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use App\Http\Requests\StoreProspectRequest;

class ProspectController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProspectRequest $request)
    {
        $prospect = Prospect::create($request->validated());

        $prospect->refresh();

        return response()->json([
            'message' => 'Prospecto registrado correctamente.',
            'data' => $prospect
        ], 201);
    }

}
