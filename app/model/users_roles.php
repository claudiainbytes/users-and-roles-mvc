<?php
class UsersRoles{

		private $pdo;

    public $user_id;
		public $role_id;

	public function __CONSTRUCT(){
		try{
			$this->pdo = Database::StartUp();
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getUserRole($user_id){
		try{

			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM users_roles WHERE user_id = ?");
			$stm->execute(array($user_id));

			return $stm->fetchAll(PDO::FETCH_OBJ);

		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getRoleByUser($user_id){
		try{

			$result = array();
			$stm = $this->pdo->prepare("SELECT role_id FROM users_roles WHERE user_id = ?");
			$stm->execute(array($user_id));

			$userRole = $stm->fetch(PDO::FETCH_OBJ);

			if($userRole){
				return $userRole->role_id;
			}else{
				return 0;
			}

		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}


	public function deleteRoleByUser($user_id){
		try{

			$stm = $this->pdo
			            ->prepare("DELETE FROM users_roles WHERE user_id = ?");

			$stm->execute(array($user_id));

		} catch (Exception $e){
			die($e->getMessage());
		}
	}

	public function getNumRolesByUser($user_id){
		try{

			$result = array();
			$stm = $this->pdo->prepare("SELECT COUNT(*) AS total FROM users_roles WHERE user_id = ?");
			$stm->execute(array($user_id));

			$num_roles = $stm->fetch(PDO::FETCH_OBJ);

			return $num_roles->total;

		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function saveRoleByUser($user_id, $role_id){
		try{

			$num_roles = $this->getNumRolesByUser($user_id);

			if($num_roles == 0){

					$sql = "INSERT INTO users_roles (user_id, role_id) VALUES (?,?)";
					$this->pdo->prepare($sql)->execute(array($user_id, $role_id));

			}else{

				  $this->deleteRoleByUser($user_id);
					$this->saveRoleByUser($user_id, $role_id);

			}

		}catch (Exception $e){
			die($e->getMessage());
		}
	}

}
