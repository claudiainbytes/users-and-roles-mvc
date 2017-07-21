<?php
require_once 'app/helpers/gump/gump.class.php';
require_once 'app/model/user.php';
require_once 'app/model/role.php';
require_once 'app/model/users_roles.php';

class UserController{

    private $model;
    private $role;
    private $usersRoles;
    private $gump;

    public function __CONSTRUCT(){
        $this->model = new User();
        $this->role = new Role();
        $this->usersRoles = new UsersRoles();
        $this->gump = new GUMP();
    }

    public function Index(){
        require_once 'app/view/header.php';
        require_once 'app/view/user/user.php';
        require_once 'app/view/footer.php';
    }

    public function Crud(){

        $alm = new User();

        $roles = $this->role->getRoles();

        $current_role_role = null;

        if(isset($_REQUEST['id'])){
            $alm = $this->model->getUser($_REQUEST['id']);
            $current_role_role = $this->usersRoles->getRoleRoleByUser($_REQUEST['id']);
        }

        require_once 'app/view/header.php';
        require_once 'app/view/user/user-edit.php';
        require_once 'app/view/footer.php';
    }

    public function Validate(){

        $roles = implode(" ", $this->role->getRolesRol());
        if($roles !== ""){
           $roles = "|contains, ".$roles;
        }

        $_POST = $this->gump->sanitize($_POST);

        $this->gump->validation_rules(array(
            'name' => 'required',
            'username' => 'required|alpha_numeric',
            'password' => 'required|max_len,6|min_len,6',
            'email'    => 'required|valid_email',
            'role' => 'required'.$roles,
        ));

        $this->gump->filter_rules(array(
            'name' => 'trim|sanitize_string',
            'username' => 'trim|sanitize_string',
            'password' => 'trim',
            'email'    => 'trim|sanitize_email',
            'role'     => 'trim'
        ));

        $validated_data = $this->gump->run($_POST);

        if($validated_data === false) {
            return $this->gump->get_errors_array();
        } else {
            return true;
        }

    }

    public function Save(){

        $alm = new User();

        $alm->id = $_REQUEST['id'];
        $alm->name = $_REQUEST['name'];
        $alm->username = $_REQUEST['username'];
        $alm->password = $_REQUEST['password'];
        $alm->email = $_REQUEST['email'];
        $alm->role = $_REQUEST['role'];

        $validation = $this->Validate();

        if( is_bool( $validation ) ){

            $alm->id > 0
                ? $this->model->update($alm)
                : $this->model->addNew($alm);

            header('Location: index.php');

        }else{

             require_once 'app/view/header.php';
             require_once 'app/view/user/user-validation.php';
             require_once 'app/view/footer.php';

        }

    }

    public function Delete(){
        $this->model->delete($_REQUEST['id']);
        header('Location: index.php');
    }

}
