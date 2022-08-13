<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function createGoldSubscription(Request $request){
        $subscription = DB::table("subscriptions")->insert([
            "user_id" => $request->session()->get('user')->id,
            "plan" => $request->subscription_plan,
            "amount" => $request->amount,
            "transaction_id" => $request->transaction_id,
            "card_limit" => $request->card_limit,
            "card_type" => $request->card_type
        ]);
        
        if($subscription){
            return $request->all();
            
        }else{
            return false;
        }
    }
}
