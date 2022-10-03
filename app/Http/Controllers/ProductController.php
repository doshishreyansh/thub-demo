<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function productList()
    {
        $products = DB::table('products as p')
            ->join('species as s', 's.id', '=', 'p.species_id')
            ->join('grades as g', 'g.id', '=', 'p.grade_id')
            ->join('drying_methods as dm', 'dm.id', '=', 'p.drying_method_id')
            ->leftJoin('treatments as t', 't.id', '=', 'p.treatment_id')
            ->select('g.name as grade', 'g.grade_system', 's.name as species', 'dm.name as drying_method', 't.name as treatment', 'p.id', 'p.thickness', 'p.width', 'p.length')
            ->where('p.is_active', 1)
            ->orderBy('p.id', 'desc')
            ->get();

        return view('product.productList')->with('products', $products);
    }

    public function loadAddProduct()
    {
        $getDryingMethods = DB::table('drying_methods')
            ->where('drying_methods.is_active', 1)
            ->get();
        $getGrades = DB::table('grades')
            ->where('grades.is_active', 1)
            ->get();
        $getSpecies = DB::table('species')
            ->where('Species.is_active', 1)
            ->get();
        $getTreatments = DB::table('treatments')
            ->where('treatments.is_active', 1)
            ->get();
        return view('product.addProduct')->with('getDryingMethods', $getDryingMethods)->with('getSpecies', $getSpecies)->with('getGrades', $getGrades)->with('getTreatments', $getTreatments);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->post());
        return response()->json([
            'message' => 'Product has been added successfully with id ' . $product->id,
            'id' => $product->id
        ]);
    }
}
