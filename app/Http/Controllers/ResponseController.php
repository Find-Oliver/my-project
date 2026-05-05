<?php

namespace App\Http\Controllers;

use App\Models\response;
use App\Models\category;
use App\Models\Staff;
use App\Models\questionaire;

use Illuminate\Http\Request;

/////////////////////////////////////////////////// PDF GENERATION
use Barryvdh\DomPDF\Facade\Pdf;

use App\Http\Requests\StoreresponseRequest;
use App\Http\Requests\UpdateresponseRequest;
use App\Models\Pmsrecord;
use App\Models\Response as ModelsResponse;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('response.index');
    }

    public function fetch()
    {
        $response = Pmsrecord::where('deleted', 0)->get();

        foreach($response as $key => $record){

            $response[$key]->owner_name =
                $record->owner ? $record->owner->fullname : 'N/A';

            $response[$key]->conducted_by_name =
                $record->conductedBy ? $record->conductedBy->fullname : 'N/A';

            $response[$key]->conforme_name =
                $record->conformes ? $record->conformes->fullname : 'N/A';
        }

        return response()->json($response);
    }

    public function fetch_qms()
    {
        $questionaires = questionaire::where('deleted', 0)
                        ->orderBy('description', 'asc')
                        ->get();

        return $questionaires;
    }

    public function fetch_employee()
    {
        $data = [];

        $staffs = Staff::where('deleted', 0)
                    ->where('user_id', '<>', 1)
                    ->orderBy('last_name', 'asc')
                    ->get();

        foreach($staffs as $key => $staff){

            $data[$key]['user_id'] = $staff->user_id;
            $data[$key]['name'] = $staff->fullname;
        }

        return $data;
    }

    // =========================================================
    // INFO
    // =========================================================
    public function info()
    {
        if(isset($_POST['response_id'])){

            $response = Pmsrecord::find($_POST['response_id']);

            if($response){

                // 👉 GET ALL QUESTION RESPONSES
                $responses = ModelsResponse::where('pms_id', $response->id)->get();

                $response->responses = $responses;

                return response()->json($response);

            }else{

                return response()->json([
                    'status' => 'false',
                    'message' => 'Response not found'
                ]);
            }
        }
    }

    // =========================================================
    // SAVE / UPDATE
    // =========================================================
    public function save(Request $request)
    {

        // =====================================================
        // CHECK IF EDIT OR ADD
        // =====================================================
        if($request->response_id != ''){

            // ✅ EDIT
            $pms = Pmsrecord::find($request->response_id);

            $pms_id = $pms->id;

        }else{

            // ✅ ADD
            $pms = new Pmsrecord();

            $pms_id =
                substr(round(microtime(true) * 1000), -13)
                . str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);

            $pms->id = $pms_id;
        }

        // =====================================================
        // SAVE PMS RECORD
        // =====================================================
        $pms->name = $request->name;
        $pms->division = $request->division;
        $pms->conducted_by = $request->conducted_by;
        $pms->conforme = $request->conforme;

        $pms->save();

        // =====================================================
        // SAVE RESPONSES
        // =====================================================
        $questionaires = questionaire::where('deleted', 0)->get();

        foreach($questionaires as $questionaire){

            // =================================================
            // CHECK EXISTING RESPONSE
            // =================================================
            $response = ModelsResponse::where('pms_id', $pms_id)
                        ->where('question_id', $questionaire->id)
                        ->first();

            // =================================================
            // CREATE NEW IF NOT EXIST
            // =================================================
            if(!$response){

                $response = new ModelsResponse();

                $response->id =
                    substr(round(microtime(true) * 1000), -13)
                    . str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);

                $response->question_id = $questionaire->id;
                $response->pms_id = $pms_id;
            }

            // =================================================
            // UPDATE VALUES
            // =================================================
            $response->status =
                $request->input($questionaire->id . '.response') ?? 0;

            $response->response_array = json_encode(
                $request->input($questionaire->id)['response_array'] ?? []
            );

            $response->remarks = json_encode(
                $request->input('remarks.' . $questionaire->id) ?? ''
            );

            $response->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Saved successfully'
        ]);
    }

    // =========================================================
    // DELETE
    // =========================================================
    public function delete()
    {
        if(isset($_POST['response_id'])){

            $response = Pmsrecord::find($_POST['response_id']);

            if($response){

                $response->deleted = 1;
                $response->save();

                return response()->json([
                    'status' => 'true',
                    'message' => 'Response deleted successfully'
                ]);

            }else{

                return response()->json([
                    'status' => 'false',
                    'message' => 'Response not found'
                ]);
            }
        }
    }
}
