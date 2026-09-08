<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prospect = Prospect::create($request->validated());

        return response()->json([
            'message' => 'Prospecto registrado correctamente.',
            'data' => $prospect
        ], 201);
    }

}
