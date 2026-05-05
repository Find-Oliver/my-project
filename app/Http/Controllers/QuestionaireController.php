<?php

namespace App\Http\Controllers;

use App\Models\questionaire;
use App\Http\Requests\StorequestionaireRequest;
use App\Http\Requests\UpdatequestionaireRequest;

class QuestionaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('questionaire.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function fetch()
    {
        $questionaire = questionaire::from('questionaire as q')
            ->join('category as c', 'q.category_id', '=', 'c.id')
            ->where('q.deleted', 0) // then question sorting
            ->orderBy('q.sorting', 'asc') // ✅ ADD THIS
            ->select('q.*')
            ->get();

        $questionaire->load('category');

        return response()->json($questionaire);
    }

      public function info(){
        if(isset($_POST['questionaire_id'])){
            $questionaire = questionaire::find($_POST['questionaire_id']);
            if($questionaire){
                return response()->json($questionaire);
            }else{
                return response()->json(['status' => 'false', 'message' => 'Questionaire not found']);
            }
        }
    }
    public function save(){
    if(isset($_POST)){
        if($_POST['questionaire_id']!=""){
            $questionaire = questionaire::find($_POST['questionaire_id']);
        }else{
            $questionaire = new questionaire();
            $timestamp = substr(round(microtime(true) * 1000), -13);
            $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
            $questionaire->id = $timestamp . $random;

            // ✅ AUTO SORTING
            $last = questionaire::max('sorting');
            $questionaire->sorting = $last + 1;
        }

        $questionaire->category_id = $_POST['category_id'];
        $questionaire->question = $_POST['question'];
        $questionaire->is_required = $_POST['is_required'];
        $questionaire->input_type = $_POST['input_type'];

        $questionaire->save();

        return response()->json([
            'status' => 'true',
            'message' => 'Questionaire saved successfully'
        ]);
    }
}
    public function delete(){
        if(isset($_POST['questionaire_id'])){
            $questionaire = questionaire::find($_POST['questionaire_id']);
            if($questionaire){
                $questionaire->deleted = 1;
                $questionaire->save();
                return response()->json(['status' => 'true', 'message' => 'Questionaire deleted successfully']);
            }else{
                return response()->json(['status' => 'false', 'message' => 'Questionaire not found']);
            }
        }
    }

}
