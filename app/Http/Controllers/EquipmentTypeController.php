<?php

namespace App\Http\Controllers;

use App\Models\equipment_type;
use App\Http\Requests\Storeequipment_typeRequest;
use App\Http\Requests\Updateequipment_typeRequest;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('equipment_type.index');
    }

    public function fetch()
    {
        $equipment_types = equipment_type::where('deleted', 0)->get();
        return response()->json($equipment_types);

    }
    public function info(){
        if(isset($_POST['equipment_type_id'])){
            $equipment_type = equipment_type::find($_POST['equipment_type_id']);
            if($equipment_type){
                return response()->json($equipment_type);
            }else{
                return response()->json(['status' => 'false', 'message' => 'Equipment Type not found']);
            }
        }
    }
    public function save(){
        if(isset($_POST)){
            if($_POST['equipment_type_id']!=""){
                $equipment_type = equipment_type::find($_POST['equipment_type_id']);
            }else{
                $equipment_type = new equipment_type();
                $timestamp = substr(round(microtime(true) * 1000), -13);
                $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
                $equipment_type->id = $timestamp . $random;
            }
            $equipment_type->category = $_POST['category'];
            $equipment_type->sub_category = $_POST['sub_category'];
            $equipment_type->save();
            return response()->json(['status' => 'true', 'message' => 'Equipment Type saved successfully']);
        }
    }
    public function delete(){
        if(isset($_POST['equipment_type_id'])){
            $equipment_type = equipment_type::find($_POST['equipment_type_id']);
            if($equipment_type){
                $equipment_type->deleted = 1;
                $equipment_type->save();
                return response()->json(['status' => 'true', 'message' => 'Equipment Type deleted successfully']);
            }else{
                return response()->json(['status' => 'false', 'message' => 'Equipment Type not found']);
            }
        }
    }

}
