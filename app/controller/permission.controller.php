<?php
require_once 'app/model/permission.php';

class PermissionController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new Permission();
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

    public function Save(){
        $alm = new Permission();

        $alm->id = $_REQUEST['id'];
        $alm->permission = $_REQUEST['permission'];

        $alm->id > 0
            ? $this->model->update($alm)
            : $this->model->addNew($alm);

        $this->Index();
    }

    public function Delete(){
        $this->model->delete($_REQUEST['id']);
        $this->Index();
    }
}
