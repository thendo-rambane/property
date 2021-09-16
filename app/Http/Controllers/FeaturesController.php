<?php

namespace App\Http\Controllers;

use App\Models\Features;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FeaturesController extends Controller
{
    /**
     * Store a new Feature
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * @var App\Models\User $user  
         */
        $user = Auth::user();

        $request->validate([
            'feature' => 'required|string|unique',
        ]);
        if ($user && ($user->isAdmin() || $user->isAgent())) {
            $feature = new Features();
            $feature->feature = $request->feature;
            return response()->json([], Response::HTTP_CREATED);
        }
        return response()->json([], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Get All Features
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Features::all();
    }
}
