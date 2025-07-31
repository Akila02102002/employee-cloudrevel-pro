<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller{

    public function list(Request $request) {
        $page_title =  'Employee';
        $page_description = 'Description';
        $page = $request->input('page', '1');
        $resVal = $this->getList($request);
        return view('Employee.list', compact('page_title', 'page_description','resVal','page'));
    }
    public function getList(Request $request)
    {
        $resVal=Array();
        $search = $request->input('search','');
        $limit = $request->input('limit',50);
        $page = $request->input('page', '1');

        $query = DB::table('tbl_employee')
                  ->select('*')
                  ->where('is_active',1);

        $need_page = $request->input('need_page',0);

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $query->orderBy('id', 'desc');

        $resVal['total'] = $query->count();
        $resVal['limit'] = $limit;
        $resVal['list'] = $query->paginate($limit);
        $resVal['page'] =$request->input('page',1);

        if ($resVal['total'] > 0) {
            $resVal['success'] = TRUE;

        } else {
            $resVal['success'] = FALSE;
            $resVal['message'] = 'No Data Found';
        }
       if(isset($need_page)&& $need_page==1)
            return view('Employee/pagination_data', [
                         'resVal' => $resVal,'page' => $page
                     ]);
       else
           return $resVal;
    }
    public function saveView(Request $request) {
        $page_title =  'Employee Add';
        $page_description = 'Description';
        $currentUser = Auth::user();
        if($currentUser->role == 'admin'){
            return view('Employee.add', compact('page_title', 'page_description'));
        }else{
            return view('Employee.noaccess', compact('page_title', 'page_description'));
        }
    }
    public function save(Request $request)
    {
        $resVal = array();
        $resVal['success'] = TRUE;
        $resVal['message'] = 'Employee Added Succcessfully';
        $employee = new Employee;
        $employee->is_active = 1;
        $employee->fill($request->all());
        $employee->save();
        return redirect('admin/employees')->with('success', $resVal['message']);
    }
    public function editView(Request $request,$id) {
        $page_title =  'Employee Edit';
        $page_description = 'Description';
        $page=$request->input('page',1);
        $currentUser = Auth::user();
        $query = DB :: table('tbl_employee')->where('id',$id)->first();
        if($currentUser->role == 'admin'){
            return view('Employee.edit', compact('page_title', 'page_description','query','page'));
        }else{
            return view('Employee.noaccess', compact('page_title', 'page_description'));
        }
    }
    public function edit(Request $request,$id)
    {
        $resVal = array();
        $resVal['success'] = TRUE;
        $resVal['message'] = 'Employee Updated Succcessfully';
        try {
            $employee = Employee::findOrFail($id);
        } catch (ModelNotFoundException $e) {

            $resVal['success'] = FALSE;
            $resVal['message'] ='Employee Not Found';
            return $resVal;
        }
        $employee->fill($request->all());
        $employee->save();
        return redirect('admin/employees')->with('success', $resVal['message']);
    }
    public function view(Request $request,$id) {
        $page_title =  'Employee Edit';
        $page_description = 'Description';
        $page=$request->input('page',1);
        $query = DB :: table('tbl_employee')->where('id',$id)->first();
        return view('Employee.view', compact('page_title', 'page_description','query','page'));
    }
    public function delete(Request $request,$id)
    {
        $resVal = array();
        $resVal['success'] = TRUE;
        $resVal['message'] = 'Employee Deleted Succcessfully';
        try {
            $employee = Employee::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            
            $resVal['success'] = FALSE;
            $resVal['message'] ='Employee Not Found';
            return $resVal;
        }
        $employee->is_active = 0;
        $employee->save();
        return redirect('admin/employees')->with('success', $resVal['message']);
    }
}
