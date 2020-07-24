<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
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
        $data = Product::all();

        Log::info("Product data showing");
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
            "name" => "required",
            "price" => "required",
        ]);

        $data = new Product();
        $data->name = $request->input("name");
        $data->price = $request->input("price");
        $save = $data->save();

        if ($save) {
            Log::info("Data Product Success Add");
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
        $data = Product::find($id);

        Log::info("getting data Product by id $id");
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
        $data = Product::find($id);

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
        $data = Product::find($id);

        $data->name = $request->input("name");
        $data->price = $request->input("price");
        $data->save();

        log::info("data updated");

        return response()
            ->json(["status" => "success", "result" => $data], 201)
            ->header("Content-Type", "application/json");
    }
}
