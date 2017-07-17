<?php
require_once 'app/model/users_roles.php';

class User{

		private $pdo;
		private $usersRoles;

		public $id;
    public $name;
    public $username;
		public $password;
		public $email;
    public $register_date;

	public function __CONSTRUCT(){
		try{
			$this->pdo = Database::StartUp();
			$this->usersRoles = new UsersRoles();

		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getUsers(){
		try{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM users");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getUser($id){
		try{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM users WHERE id = ?");

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		}catch (Exception $e){
			die($e->getMessage());
		}
	}

	public function delete($id)
	{
		try
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM users WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function update($data){
		try{

			$current_rol_id = $this->usersRoles->getRoleByUser($data->id);

			$sql = "UPDATE users SET name = ?, username = ?, password = ?, email = ? WHERE id = ?";
			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                  $data->name,
                  $data->username,
                  $data->password,
                  $data->email,
                  $data->id
								)
				);

			$data->role_id != $current_rol_id
						? $this->usersRoles->saveRoleByUser($data->id, $data->role_id)
						: false ;

		}catch (Exception $e){
			die($e->getMessage());
		}
	}

	public function addNew(User $data){
		try{

			$register_date = time();

			$sql = "INSERT INTO users (name,username,password,email,register_date)
			        VALUES (?, ?, ?, ?, ?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
	                    $data->name,
	                    $data->username,
	                    $data->password,
	                    $data->email,
	                    $register_date
	                )
				);


		    //$data->role_id > 0
						//?
						$data->id = $this->getUserID($data->username, $register_date);
						$this->usersRoles->saveRoleByUser($data->id, $data->role_id);
					//	: false ;

		}catch (Exception $e){
			die($e->getMessage());
		}
	}

	public function getUserID($username, $register_date){
		try{

			$result = array();
			$stm = $this->pdo->prepare("SELECT id FROM users WHERE username = ? AND register_date = ?");
			$stm->execute(array($username, $register_date));

			$user = $stm->fetch(PDO::FETCH_OBJ);

			if($user){
				return $user->id;
			}else{
				return 0;
			}

		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

}
