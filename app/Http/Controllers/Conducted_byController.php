<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conducted_by;

class Conducted_byController extends Controller
{
    // SHOW PAGE
    public function index()
    {
        return view('Conducted_by.index');
    }

    // FETCH ALL DATA (datatable)
    public function fetch()
    {
        $conducted = Conducted_by::with('staff')
                    ->where('deleted', 0)
                    ->orderBy('user_id', 'asc')
                    ->get();

        return response()->json($conducted);
    }

    // GET SINGLE DATA (for edit modal)
    public function info(Request $request)
    {
        $conducted = Conducted_by::where('user_id', $request->user_id)->first();

        return response()->json($conducted);
    }

    // SAVE (create / update)
    public function save(Request $request)
    {
        if ($request->id) {
            // UPDATE
            $conducted = Conducted_by::find($request->id);
        } else {
            // CREATE
            $conducted = new Conducted_by();
            $conducted->deleted = 0;
        }

        $conducted->user_id = $request->user_id ?? '';
        $conducted->save();

        return response()->json([
            'status' => true,
            'message' => 'Saved successfully'
        ]);
    }

    // DELETE (soft delete style)
    public function delete(Request $request)
    {
        $conducted = Conducted_by::find($request->id);

        if ($conducted) {

            $conducted->deleted = 1;

            $conducted->save();

            return response()->json([
                'status' => true,
                'message' => 'Deleted successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data not found'
        ]);
    }
}

