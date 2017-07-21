<?php
require_once 'app/helpers/gump/gump.class.php';
require_once 'app/model/permission.php';

class PermissionController{

    private $model;
    private $gump;

    public function __CONSTRUCT(){
        $this->model = new Permission();
        $this->gump = new GUMP();
    }

    public function Index(){
        require_once 'app/view/header.php';
        require_once 'app/view/permission/permission.php';
        require_once 'app/view/footer.php';
    }

    public function Crud(){
        $alm = new Permission();

        if(isset($_REQUEST['id'])){
            $alm = $this->model->getPermission($_REQUEST['id']);
        }

        require_once 'app/view/header.php';
        require_once 'app/view/permission/permission-edit.php';
        require_once 'app/view/footer.php';
    }

    public function Validate(){

        $_POST = $this->gump->sanitize($_POST);

        $this->gump->validation_rules(array(
            'permission' => 'required'
        ));

        $this->gump->filter_rules(array(
            'permission' => 'trim|sanitize_string'
        ));

        $validated_data = $this->gump->run($_POST);

        if($validated_data === false) {
            return $this->gump->get_errors_array();
        } else {
            return true;
        }

    }

    public function Save(){

        $alm = new Permission();

        $alm->id = $_REQUEST['id'];
        $alm->permission = $_REQUEST['permission'];

        $validation = $this->Validate();

        if( is_bool( $validation ) ){

            $alm->id > 0
                ? $this->model->update($alm)
                : $this->model->addNew($alm);

            $this->Index();

        }else{

             require_once 'app/view/header.php';
             require_once 'app/view/permission/permission-validation.php';
             require_once 'app/view/footer.php';

        }

    }

    public function Delete(){
        $this->model->delete($_REQUEST['id']);
        $this->Index();
    }
}
