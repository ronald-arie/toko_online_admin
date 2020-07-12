<?php 

namespace Modules\Role\Http\Requests;

use App\Helpers\Form\Form;
use Modules\Role\Models\Role;

class FormRole extends Form {
    public function __construct() {
        parent::__construct();
        $this->add('name', 'text', ['rules'=> 'required|regex:/^[a-z\d\s]+$/i|unique:user_role,name'], ['label'=>'Name']);
        $permissions = config('permissions.permissions');
        foreach ($permissions as $key => $permission) {
            $this->add("permissions[$key]", 'checkbox', [], ['label'=>$key]);
            $permission_items = [];
            foreach ($permission as  $item) {
                $permission_items[] = ['id'=> $item, 'text' => $item];
            }
            $this->setData("permissions[$key]", $permission_items);
        }
        $this->add('is_active', 'select',['rules' => 'required'],['label','Active']);
        $this->setData('is_active',[
            ['id'=>'1','text'=>'Active'],
            ['id'=>'0','text'=>'Inactive'],
          ]);
        $this->setValue('is_active', 1);
    }

    public function editForm($id) {
        $Role = Role::find($id);
        $this->setValue('name', $Role->name);
        $permissions_value = json_decode($Role->permissions, true);
        foreach ($permissions_value as $key => $permission) {
            $this->setValue("permissions[$key]", $permission);
        }
        $this->setValue('is_active', $Role->is_active);
    }

    public function editProcess() {
        $this->add('id', 'text', ['rules' => 'required']);
        $this->addValidator('name', 'rules', 'required|regex:/^[a-z\d\s]+$/i');
    }
    
}