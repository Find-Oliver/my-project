<?php

namespace App\Http\Controllers;

use App\Models\sub_category;
use App\Http\Requests\Storesub_categoryRequest;
use App\Http\Requests\Updatesub_categoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        return view('sub_category.index');
    }

    public function fetch(){
        $sub_category = sub_category::where('deleted',0)->orderBy('description', 'desc')->get();
        $sub_category->load('category');
        return response()->json($sub_category);
    }
    public function info(){
        if(isset($_POST['sub_category_id'])){
            $sub_category = sub_category::find($_POST['sub_category_id']);
            if($sub_category){
                return response()->json($sub_category);
            }else{
                return response()->json(['status' => 'false', 'message' => 'Sub Category not found']);
            }
        }
    }
    public function save(){
        if(isset($_POST)){
            if($_POST['sub_category_id']!=""){
                $sub_category = sub_category::find($_POST['sub_category_id']);
            }else{
                $sub_category = new sub_category();
                $timestamp = substr(round(microtime(true) * 1000), -13);
                $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
                $sub_category->id = $timestamp . $random;
            }
            $sub_category->category_id = $_POST['category_id'];
            $sub_category->description = $_POST['description'];
            $sub_category->save();
            return response()->json(['status' => 'true', 'message' => 'Sub Category saved successfully']);
        }
    }
    public function delete(){
        if(isset($_POST['sub_category_id'])){
            $sub_category = sub_category::find($_POST['sub_category_id']);
            if($sub_category){
                $sub_category->deleted = 1;
                $sub_category->save();
                return response()->json(['status' => 'true', 'message' => 'Sub Category deleted successfully']);
            }else{
                return response()->json(['status' => 'false', 'message' => 'Sub Category not found']);
            }

        }
    }
}
