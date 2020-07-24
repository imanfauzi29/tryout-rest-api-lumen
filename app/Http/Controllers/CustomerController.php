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

        Log::info("Customer data showing");
        return response()->json([
            "message" => "success retrive data",
            "status" => true,
            "data" => $data
        ], 200)
            ->header("Content-Type", "application/json");
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
            ], 201)
                ->header("Content-Type", "application/json");
        }
    }

    public function getById($id)
    {
        $data = Customer::find($id);

        Log::info("getting data customer by id $id");
        return response()->json(
            [
                "status" => true,
                "message" => "get by id $id",
                "result" => $data
            ],
            200
        )
            ->header("Content-Type", "application/json");
    }

    public function delete($id)
    {
        $data = Customer::find($id);

        if ($data) {
            $data->delete();

            log::info("data deleted");

            $response = response()
                ->json(["status" => "success deleted"], 200)
                ->header("Content-Type", "application/json");

            return $response;
        }
    }

    public function update(Request $request, $id)
    {
        $data = Customer::find($id);

        $data->full_name = $request->input("full_name");
        $data->username = $request->input("username");
        $data->email = $request->input("email");
        $data->phone_number = $request->input("phone_number");
        $data->save();

        log::info("data updated");

        return response()
            ->json(["status" => "success", "result" => $data], 201)
            ->header("Content-Type", "application/json");
    }
}
