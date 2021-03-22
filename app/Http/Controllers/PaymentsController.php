<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use MPESA;


class PaymentsController extends Controller
{
    public function pushMpesa(Request $request){

        $mpesa = MPESA::stkPush('254712083128', 1, 'OpangaAccount','oiiuu');
        return ['message'=>$mpesa];
    }
}
