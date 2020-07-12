<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\Http\Requests\FormUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $FormUser;

    public function __construct(Request $request) {
        $id = $request->route('id');
        $this->FormUser = new FormUser($id);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('user::index');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function data()
    {
        $User = User::join('user_role', 'users.role_id', '=', 'user_role.id')
                ->select('users.*', 'user_role.name as role_name');
        $user = DataTables::of($User)->addIndexColumn()->make(true);
        return $user;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function form($id = null)
    {
        if ($id) {
            $data['id'] = $id;
            $this->FormUser->editForm($id);
        }
        $data['Form'] = $this->FormUser;
        return view('user::form', $data);
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
            $this->FormUser->editProcess();
        }
        if (!$this->FormUser->validate()) {
            $errors = $this->FormUser->errors->all();
            $request->session()->flash('error', ' - '.implode('<br> - ', $errors));
            return redirect()->back()
                            ->withErrors($this->FormUser->getValidator())
                            ->withInput();
        }
        
        $data_form = $this->FormUser->getNameValueAll();
        if ($data_form['password'] == '******') {
            unset($data_form['password']);
        } else {
            $data_form['password'] = Hash::make($data_form['password']);
        }
        try { 
            if($id){
                $User = User::where('id', $id)->update($data_form);
            }else{
                $User = User::create($data_form);
            }
        } catch(\Illuminate\Database\QueryException $ex){ 
            $message = explode("(SQL:", $ex->getMessage(), 2)[0];
            $message = explode($ex->getCode().']:', $message, 2)[1];
            $request->session()->flash('error', $message);
            return redirect()->back()->withInput();
        }
            
        if (!@$User) {
            $request->session()->flash('error', $process_name . ' Data User Failed. ');
            return redirect()->back()->withInput();
        }
        $request->session()->flash('success', $process_name . ' Data User Success.');


        return redirect('user');
    }
    
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function deleteProcess(Request $request, $id = null)
    {
        $process_name = 'Delete';
        try { 
            $User = User::where('id', $id)->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            $message = explode("(SQL:", $ex->getMessage(), 2)[0];
            $message = explode($ex->getCode().']:', $message, 2)[1];
            $request->session()->flash('error', $message);
            return redirect()->back()->withInput();
        }
            
        if (!@$User) {
            $request->session()->flash('error', $process_name . ' Data User Failed. ');
        }else{
            $request->session()->flash('success', $process_name . ' Data User Success.');
        }

        return redirect('user');
    }
    



}
