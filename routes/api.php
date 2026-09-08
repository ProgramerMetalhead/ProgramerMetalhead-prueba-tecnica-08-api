<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProspectController;

Route::post('/prospects', [ProspectController::class, 'store']);
