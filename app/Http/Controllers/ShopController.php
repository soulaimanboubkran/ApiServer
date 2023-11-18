<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Requests\UpdateShopRequest;
use App\Mail\ShopActivationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([Shop::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
         $request->validate([
                'name' => 'required',
               
                'description' => 'nullable',

            ]);
            $user = Auth::user();
              // Check if the user already has a shop
    if ($user->shop) {
        // User already has a shop, handle the error as needed
        return response()->json(['error' => 'You can have only one shop.'], 422);
    }
            $shop = $user->shop()->create($request->all());

            $admins = User::whereHas('role', function ($q) {
                $q->where('name','admin');
            })->get();
            Mail::to($admins)->send(new ShopActivationRequest($shop));



         return response()->json(['shop' => $shop], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
