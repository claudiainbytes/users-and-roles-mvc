<?php
require_once 'app/helpers/gump/gump.class.php';
require_once 'app/model/role.php';
require_once 'app/model/permission.php';
require_once 'app/model/role_permissions.php';

class RoleController{

    private $model;
    private $permissions;
    private $rolePermissions;
    private $gump;

    public function __CONSTRUCT(){
        $this->model = new Role();
        $this->permissions = new Permission();
        $this->rolePermissions = new RolePermissions();
        $this->gump = new GUMP();
    }

    public function Index(){
        require_once 'app/view/header.php';
        require_once 'app/view/role/role.php';
        require_once 'app/view/footer.php';
    }

    public function Crud(){
        $alm = new Role();

        if(isset($_REQUEST['id'])){
            $alm = $this->model->getRole($_REQUEST['id']);
        }

        require_once 'app/view/header.php';
        require_once 'app/view/role/role-edit.php';
        require_once 'app/view/footer.php';
    }

    public function SetPermissions(){

        $role = new Role();

        $view = 'app/view/role/role.php';

        if( isset($_REQUEST['id']) ){
          $_REQUEST['id'] = (int) $_REQUEST['id'];
          $role = $this->model->getRole($_REQUEST['id']);
          $permissions = $this->permissions->getPermissions();
          $rolePermissions = $this->rolePermissions->getRolePermissions($_REQUEST['id']);

          if($role){
            $view = 'app/view/role/role-set-permissions.php';
          }

        }

        require_once 'app/view/header.php';
        require_once $view;
        require_once 'app/view/footer.php';

    }

    public function SavePermissions(){

        if( isset($_REQUEST['id']) ){

          $role_id = $_REQUEST['id'];
          $permissions = isset($_REQUEST['permissions']) ? $_REQUEST['permissions'] : Array();
          $this->rolePermissions->save($role_id, $permissions);

        }

        $this->Index();

    }

    public function Validate(){

        $_POST = $this->gump->sanitize($_POST);

        $this->gump->validation_rules(array(
            'role' => 'required'
        ));

        $this->gump->filter_rules(array(
            'role' => 'trim|sanitize_string'
        ));

        $validated_data = $this->gump->run($_POST);

        if($validated_data === false) {
            return $this->gump->get_errors_array();
        } else {
            return true;
        }

    }

    public function Save(){
        $alm = new Role();

        $alm->id = $_REQUEST['id'];
        $alm->role = $_REQUEST['role'];

        $validation = $this->Validate();

        if( is_bool( $validation ) ){

            $alm->id > 0
                ? $this->model->update($alm)
                : $this->model->addNew($alm);

            $this->Index();

         }else{

             require_once 'app/view/header.php';
             require_once 'app/view/role/role-validation.php';
             require_once 'app/view/footer.php';

        }

    }

    public function Delete(){
        $this->model->delete($_REQUEST['id']);
        $this->Index();
    }
}
