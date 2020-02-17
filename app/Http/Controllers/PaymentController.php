<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paystack;
use App\videos;
use App\purchases;
use App\users;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PaymentController extends Controller
{

    public function showForm($token){
        $videoDetails = videos::where("video_page_token", $token)
        ->join("users", "videos.uploaded_by", "users.id")
        ->select("*", "videos.created_at AS uploaded_on", "videos.id AS video_id", "videos.video_page_token AS token")
        ->first(); 

        return view("pages.paystackform", ['vd' => $videoDetails]);
    }

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        if ($paymentDetails['status'] == true){
            $videoToken = $paymentDetails['data']['metadata']['vid_token'];

            $videoObj = videos::where("video_page_token", $videoToken)->first();
            
            if ($videoObj){
                $videoID = $videoObj->id;
                
                $purchase = purchases::firstOrCreate(['user_id' => Auth::id(), "video_id" => $videoID]);
                $purchase->save();

                return redirect()->route("video.watch", ['token' => $videoToken]);
            }
        }
    }
}
