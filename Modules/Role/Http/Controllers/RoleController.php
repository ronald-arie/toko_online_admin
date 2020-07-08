<?php

namespace Modules\Role\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Role\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Modules\Role\Http\Requests\FormRole;

class RoleController extends Controller
{
    private $FormRole;

    public function __construct() {
        $this->FormRole = new FormRole();
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('role::index');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function data()
    {
        $role = DataTables::of(Role::query()) ->addIndexColumn()->make(true);
        return $role;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function form($id = null)
    {
        if ($id) {
            $data['id'] = $id;
            $this->FormRole->editForm($id);
        }
        $data['Form'] = $this->FormRole;
        return view('role::form', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function formProcess(Request $request, $id = null)
    {
        $process_name = 'Create';
        if($id){
            $process_name = 'Update';
            $this->FormRole->editProcess();
        }
        if (!$this->FormRole->validate()) {
            $errors = $this->FormRole->errors->all();
            $request->session()->flash('error', ' - '.implode('<br> - ', $errors));
            return redirect()->back()
                            ->withErrors($this->FormRole->getValidator())
                            ->withInput();
        }
        
        $data_form = $request->all();
        unset($data_form['_token']);
        $data_form['permissions'] = json_encode($data_form['permissions'], JSON_PRETTY_PRINT);
        
        if($id){
            $Role = Role::where('id', $id)->update($data_form);
        }else{
            $Role = Role::create($data_form);
        }
            
        if (!$Role) {
            $request->session()->flash('error', $process_name . ' Data Role Failed, ' . $insert_process_result['meta']['message']);
            return redirect()->back()->withInput();
        }
        $request->session()->flash('success', $process_name . ' Data Role Success');


        return redirect('role');
    }
    

}
