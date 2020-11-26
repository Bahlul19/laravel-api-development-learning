<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showSubjectData = Subject::all();
        return response()->json($showSubjectData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'class_id' => 'required',
            'subject_name' => 'required|unique:subjects|max:255',
            'subject_code' => 'required|unique:subjects|max:255',
        ]);

        $subjectDataStored = Subject::create($request->all());
        return response('Successfull');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showIndividualData = Subject::findorfail($id);
        return response($showIndividualData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // $data = array();
        // $data['class_id'] = $request->class_id;
        // $data['subject_name'] = $request->subject_name;
        // $data['suject_code'] = $request->subject_code;
        // // $updateSubjectData = DB::table('subjects')->where('id', $id)->update($data);
        // $updateData = Subject::where('id', $id)->update($id);
        // return response('Data Updated');

        $subjectData= Subject::findorfail($id);
        $subjectDataUpdate = $subjectData->update($request->all());
        return response('Data Updated');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteData = Subject::where('id', $id)->delete();
        return response('Data Deleted');
    }
}
