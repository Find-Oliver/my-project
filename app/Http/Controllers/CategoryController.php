<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;

class CategoryController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category.index');
    }

    public function fetch()
    {
        $categories = category::where('deleted', 0)->orderBy('description', 'asc')->get();
        return response()->json($categories);
    }


    public function save(){
        if(isset($_POST)){
            if($_POST['category_id']!=""){
                $category = category::find($_POST['category_id']);
            }else{
                $category = new category();
                $timestamp = substr(round(microtime(true) * 1000), -13);
                $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
                $category->id = $timestamp . $random;
            }

            $category->description = $_POST['name'];
            if($category->save()){
                return response()->json(['status' => 'true', 'message' => 'Category saved successfully']);
            }else{
                return response()->json(['status' => 'false', 'message' => 'Failed to save category']);
            }
        }
    }

    public function info(){
        if(isset($_POST['category_id'])){
            $category = category::find($_POST['category_id']);
            if($category){
                return response()->json($category);
            }else{
                return response()->json(['status' => 'false', 'message' => 'Category not found']);
            }
        }
    }

    public function delete(){
        if(isset($_POST['category_id'])){
            $category = category::find($_POST['category_id']);
            $category->deleted = 1;
            if($category->save()){
                return response()->json(['status' => 'true', 'message' => 'Category deleted successfully']);
            }else{
                return response()->json(['status' => 'false', 'message' => 'Failed to delete category']);
            }
        }
    }

}
