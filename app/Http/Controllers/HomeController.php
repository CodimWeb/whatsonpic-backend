<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function search(Request $request): JsonResponse {

        $query = Home::query();

        foreach ($request->all() as $key => $value) {
            if($key == 'name') {
                $query->where($key, 'LIKE', "%{$value}%");
            }

            else if ($key == 'priceFrom') {
                $query->where('price', '>=', $request->input('priceFrom'));
            }

            else if ($key == 'priceTo') {
                $query->where('price', '<=', $request->input('priceTo'));
            }

            else {
                $query->where($key, '=', $value);
            }
        }

        $result = $query->get();
        return response()->json($result);
    }
}
