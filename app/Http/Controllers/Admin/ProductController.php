<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\SubCategories;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
      $categories = Category::all();
      $subategories = SubCategories::all();
      // return $subategories;
      return view('products.index',compact('categories','subategories'));
    }

    public function create($id)
    {
      $subcategory = SubCategories::findOrFail($id);
      $category = Category::where('id','=',$subcategory->category_id)->first();
      return view('products.create',compact('subcategory','category'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
