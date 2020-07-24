<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function get()
    {
        $data = Customer::all();

        Log->info("Customer data showing");
        return response()->json(["message" => "success retrive data", "status" => true, "data" => $data], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "full_name" => "required",
            "username" => "required",
            "email" => "required",
            "phone_number" => "required"
        ]);

        $data = new Customer();
        $data->full_name = $request->input("full_name");
        $data->username = $request->input("username");
        $data->email = $request->input("email");
        $data->phone_number = $request->input("phone_number");
        $save = $data->save();

        if ($save) {
            Log::info("Data Customer Success Add");
            return response()->json([
                "data" => [
                    "attributes" => $data
                ]
            ], 201);
        }
    }

    //
}
