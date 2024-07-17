<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'website_id' => 'required|exists:websites,id',
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        $subscription = Subscription::create($request->all());

        return response()->json($subscription, 201);
    }
}
