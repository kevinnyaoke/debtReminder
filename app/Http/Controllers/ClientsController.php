<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients;
use Illuminate\Support\Facades\Auth;
use Knox\AFT\AFT;

class ClientsController extends Controller
{

    public function resetpass($id)
    {
        // $six_digit_random_number = mt_rand(100000, 999999);
        // $phone=$request->phone;
       $client= Clients::find($id);
        AFT::sendMessage($client->phone,'Kindly repay your Loan' );
        return[ 'status'=>true, 'message'=>'message sent'];
    }

    public function addclient(Request $request)
    {
        $request['balance'] = $request->amount;
        $request['added_by']= Auth::user()->id;
        $data = Clients::create($request->all());
        return ['status' => true, 'message' => 'Successfully Created'];
    }

    public function allclients()
    {
        $client = Clients::all();
        return ['status' => true, 'list' => $client];
    }

    public function getclient($id)
    {
        $client = Clients::find($id);
        return ['status' => true, 'client' => $client];
    }

    public function updateclient(Request $request, $id)
    {
        $client = Clients::find($id);
        $client->update($request->all());
        return ['status' => true, 'message' => 'Successfully updated'];
    }

    public function deleteclient($id)
    {
        $client = Clients::find($id);
        $client->delete();
        return ['status' => true, 'message' => 'Successfully deleted'];
    }


    public function remind($id){
        $client=Clients::find($id);
        AFT::sendMessage($client->phone,'Hello '.$client->name.', kindly pay your loan of Ksh.'.$client->balance.'.Send your payments to 0797909406, thank you');
        return ['status' => true, 'message' => 'A reminder is sent Successfully'];


    }
}
