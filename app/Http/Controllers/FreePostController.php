<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategories;
use Illuminate\Http\Request;

class FreePostController extends Controller
{
  public function index()
  {
  	$categories = Category::all();
    $subategories = SubCategories::all();
  	return view('freeads.index',compact('categories','subategories'));
  }

  public function create($id)
  {
		$subcategory = SubCategories::findOrFail($id);
    $category = Category::where('id','=',$subcategory->category_id)->first();  	
  	return view('freeads.create',compact('subcategory','category'));
  }
}
