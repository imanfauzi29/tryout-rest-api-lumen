<?php

namespace App\Http\Controllers;

use App\Order;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
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
        $data = Order::all();

        Log::info("Order data showing");
        return response()->json([
            "message" => "success retrive data",
            "status" => true, "data" => $data
        ], 200)
            ->header("Content-Type", "application/json");
    }

    public function create()
    {
        $order = new Order();
        $order->status = "pending";
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
        $data = Author::find($id);

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
        $data = Author::find($id);

        $data->name = $request->input("name");
        $data->password = $request->input("password");
        $data->salt = $request->input("salt");
        $data->email = $request->input("email");
        $data->profile = $request->input("profile");
        $data->save();

        log::info("data updated");

        return response()
            ->json(["status" => "success", "result" => $data], 201)
            ->header("Content-Type", "application/json");
    }
}
