<?php

namespace App\Http\Controllers;

use App\Models\CustodianInfo;
use App\Http\Requests\StoreCustodianInfoRequest;
use App\Http\Requests\UpdateCustodianInfoRequest;
use App\Models\Custodian_Info;

class CustodianInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Custodian_Info.index');
        //
    }

    public function fetch()
    {
        $CustodianInfos = Custodian_Info::where('deleted', 0)->get();
        return response()->json($CustodianInfos);
    }
    public function info(){
        if(isset($_POST['custodian_info_id'])){
            $CustodianInfo = Custodian_Info::find($_POST['custodian_info_id']);
            if($CustodianInfo){
                return response()->json($CustodianInfo);
            }else{
                return response()->json(['status' => 'false', 'message' => 'Custodian Info not found']);
            }
        }
    }
    // this funtion
    public function save(){
        if(isset($_POST)){
            if($_POST['custodian-info_id']!=""){
                $CustodianInfo = Custodian_Info::find($_POST['custodian-info_id']);
            }else{
                $CustodianInfo = new Custodian_Info();
                $timestamp = substr(round(microtime(true) * 1000), -13);
                $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
                $CustodianInfo->id = $timestamp . $random;
            }

            $CustodianInfo->user_id = $_POST['user_id'];
            $CustodianInfo->brand = $_POST['brand'];
            $CustodianInfo->model = $_POST['model'];
            $CustodianInfo->type = $_POST['type'];
            $CustodianInfo->serial_number = $_POST['serial_number'];
            $CustodianInfo->mac_address = $_POST['mac_address'];
            $CustodianInfo->ip_address = $_POST['ip_address'];

            if($CustodianInfo->save()){
                return response()->json(['status' => 'true', 'message' => 'Custodian Info saved successfully']);
            }else{
                return response()->json(['status' => 'false', 'message' => 'Failed to save custodian info']);
            }
        }

    }
    public function delete(){
        if(isset($_POST['custodian_info_id'])){
            $CustodianInfo = Custodian_Info::find($_POST['custodian_info_id']);
            if($CustodianInfo){
                $CustodianInfo->deleted = 1;
                if($CustodianInfo->save()){
                    return response()->json(['status' => 'true', 'message' => 'Custodian Info deleted successfully']);
                }else{
                    return response()->json(['status' => 'false', 'message' => 'Failed to delete custodian info']);
                }
            }else{
                return response()->json(['status' => 'false', 'message' => 'Custodian Info not found']);
            }
        }
    }

}
