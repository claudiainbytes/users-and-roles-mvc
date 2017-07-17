<?php
require_once 'app/model/user.php';
require_once 'app/model/role.php';
require_once 'app/model/users_roles.php';

class UserController{

    private $model;
    private $role;
    private $usersRoles;

    public function __CONSTRUCT(){
        $this->model = new User();
        $this->role = new Role();
        $this->usersRoles = new UsersRoles();
    }

    public function Index(){
        require_once 'app/view/header.php';
        require_once 'app/view/user/user.php';
        require_once 'app/view/footer.php';
    }

    public function Crud(){

        $alm = new User();

        $roles = $this->role->getRoles();

        if(isset($_REQUEST['id'])){
            $alm = $this->model->getUser($_REQUEST['id']);
            $current_role_id = $this->usersRoles->getRoleByUser($_REQUEST['id']);
        }

        require_once 'app/view/header.php';
        require_once 'app/view/user/user-edit.php';
        require_once 'app/view/footer.php';
    }

    public function Sanitize(){

    /*
        $_REQUEST['c'] => User
        $_REQUEST['a'] => Save
        $_REQUEST['id'] => 37
        $_REQUEST['name'] => Antonia
        $_REQUEST['username'] => antonia
        $_REQUEST['password'] => 666666666666666
        $_REQUEST['email'] => antonia@gmail.com
        $_REQUEST['role'] => 0
      */
/*
        if( isset($_REQUEST['email'])  && is_string($_REQUEST['email']) ){
          if ( strlen( $_REQUEST['email'] ) >= 1 && strlen( $_REQUEST['email'] ) <= 2 ){
            $email = strip_tags(trim($_REQUEST['email']));
            echo $email;
          }else{
            echo "fallo";
          }

        }else{
          echo es vacio y no existe la variable
        }


        echo "<pre>".print_r($_REQUEST, true)."</pre>";
        exit;*/

    }



    public function Save(){

        //$this->Sanitize();

        $alm = new User();

        $alm->id = $_REQUEST['id'];
        $alm->name = $_REQUEST['name'];
        $alm->username = $_REQUEST['username'];
        $alm->password = $_REQUEST['password'];
        $alm->email = $_REQUEST['email'];
        $alm->role_id = $_REQUEST['role'];

        $alm->id > 0
            ? $this->model->update($alm)
            : $this->model->addNew($alm);

        header('Location: index.php');
    }

    public function Delete(){
        $this->model->delete($_REQUEST['id']);
        header('Location: index.php');
    }
}
