<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\OnlineClass;
use Illuminate\Http\Request;
use DB;

class OnlineClassController extends Controller
{
    public function index()
    {
        // $data = OnlineClass::all();
        // dd($data);
        // return response()->json($data);
        $data = DB::table('online_class')->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'class_name' => 'required|unique:online_class|max:255',
        ]);
        
        $data = array();
        $data['class_name'] = $request->class_name;
        DB::table('online_class')->insert($data);
        return response('done');
    }

    public function show($id)
    {
        $show = DB::table('online_class')->where('id', $id)->first();
        return response()->json($show);
    }

    public function destroy($id)
    {
     DB::table('online_class')->where('id', $id)->delete();
        return response('deleted');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'class_name' => 'required|unique:online_class|max:255',
        ]);
        $data = array();
        $data['class_name'] = $request->class_name;
        $updatedData = DB::table('online_class')->where('id', $id)->update($data);
        return response('updated');

    }
}
