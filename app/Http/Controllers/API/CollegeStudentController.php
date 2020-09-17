<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CollegeStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollegeStudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ? $request->search : '';
        $perPage = $request->per_page ? intval($request->per_page) : 10;
        $sortBy = $request->sort_by ? $request->sort_by : '';
        $sortDesc = $request->sort_desc == 'true' ? 'desc' : 'asc';
        $collegeStudents = CollegeStudent::where('name', 'LIKE', $search.'%')->orderBy($sortBy, $sortDesc)->paginate($perPage);
        return response()->json($collegeStudents, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validateData = Validator::make($data, [
            'name' => 'required|string|max:32',
            'email' => 'required|email|unique:college_students',
            'phone' => 'required',
            'address' => 'required|string'
        ]);

        if ($validateData->fails()) {
            return $this->validationError($validateData);
        } else {
            $collegeStudent = CollegeStudent::create($data);
            if ($collegeStudent) {
                return response()->json([
                    'status' => 'OK'
                ], 201);
            } else return $this->errorAction();
        }
    }

    public function show(CollegeStudent $collegeStudent)
    {
        return response()->json([
            'status' => 'OK',
            'data' => $collegeStudent
        ]);
    }

    public function update(Request $request, CollegeStudent $collegeStudent)
    {
        $data = $request->only('name', 'phone', 'address');
        $validateData = Validator::make($data, [
            'name' => 'required|string|max:32',
            'phone' => 'required',
            'address' => 'required|string'
        ]);

        if ($validateData->fails()) {
            return $this->validationError($validateData);
        } else {
            $collegeStudent->update($data);
            return response()->json([
                'status' => 'OK'
            ], 200);
        }
    }

    public function destroy(CollegeStudent $collegeStudent)
    {
        $result = $collegeStudent->delete();
        if ($result) {
            return response()->json([
                'status' => 'OK'
            ], 200);
        } else return $this->errorAction();
    }

    private function validationError($validator) {
        return response()->json([
            'status' => 'ERROR',
            'errors' => $validator->errors()
        ],422);
    }

    private function errorAction() {
        return response()->json([
            'status' => 'ERROR',
            'msg' => 'Unexpected error'
        ], 500);
    }
}
