<?php

namespace App\Http\Controllers;

use App\Columnist;
use Illuminate\Http\Request;

class ColumnistController extends Controller
{
    /**
     * Columnist Page
     */
    public function show(Request $request, $domain)
    {
        $columnist = Columnist::where('domain', $domain)->firstOrFail();

        return view('columnist.show', compact('columnist'));
    }
}
