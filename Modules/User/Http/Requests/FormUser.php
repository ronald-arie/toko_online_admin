<?php 

namespace Modules\User\Http\Requests;

use App\Helpers\Form\Form;
use Modules\User\Models\User;
use Modules\Role\Models\Role;
// use Illuminate\Contracts\Validation\Rule;

class FormUser extends Form {
    public function __construct($id = 0) {
        parent::__construct();
        $this->add('name', 'text', ['rules'=> 'required'], ['label'=>'Name']);
        $this->add('username', 'text', [
            'rules'=> 
                'required|'.
                'regex:/^[a-z\d\s]+$/i|'.
                'unique:users,username,'. $id .',id'
                // Rule::unique('users','username')->ignore($id)
        ], ['label'=>'Username']);
        $this->add('password', 'password', ['rules'=> 'required'], ['label'=>'Password']);
        $this->add('role_id', 'select',['rules' => 'required|exists:user_role,id'],['label','Role']);
        $role_data = [];
        foreach (Role::All() as $key => $role) {
            $role_data[] = [
                'id' => $role->id,
                'text' => $role->name,
            ];
        }
        $this->setData('role_id', $role_data);
        $this->add('email', 'text',['rules' => 'required|email'],['label','Email']);

        $this->add('is_active', 'select',['rules' => 'required'],['label','Active']);
        $this->setData('is_active',[
            ['id'=>'1','text'=>'Active'],
            ['id'=>'0','text'=>'Inactive'],
          ]);
        $this->setValue('is_active', 1);
    }

    public function editForm($id) {
        $User = User::find($id);
        $this->setValue('name', $User->name);
        $this->setValue('username', $User->username);
        $this->setValue('password', '******');
        $this->setValue('role_id', $User->role_id);
        $this->setValue('email', $User->email);
        $this->setValue('is_active', $User->is_active);
    }

    public function editProcess() {
        $this->add('id', 'text', ['rules' => 'required']);
        $this->addValidator('name', 'rules', 'required|regex:/^[a-z\d\s]+$/i');
    }
    
}