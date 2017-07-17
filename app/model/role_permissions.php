<?php
class RolePermissions{

		private $pdo;

		public $role_id;
    public $permission_id;

	public function __CONSTRUCT(){
		try{
			$this->pdo = Database::StartUp();
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getRolePermissions($role_id){
		try{

			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM roles_permissions WHERE role_id = ?");
			$stm->execute(array($role_id));

			return $stm->fetchAll(PDO::FETCH_OBJ);

		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getNumPermissions($role_id){
		try{

			$result = array();
			$stm = $this->pdo->prepare("SELECT COUNT(*) AS total FROM roles_permissions WHERE role_id = ?");
			$stm->execute(array($role_id));

			$num_permissions = $stm->fetch(PDO::FETCH_OBJ);

			return $num_permissions->total;

		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function deleteRolePermissions($role_id){
		try{
			$stm = $this->pdo
			            ->prepare("DELETE FROM roles_permissions WHERE role_id = ?");

			$stm->execute(array($role_id));
		} catch (Exception $e){
			die($e->getMessage());
		}
	}

	public function save(int $role_id, Array $permissions){
		try{

			$num_permissions = $this->getNumPermissions($role_id);

			if($num_permissions == 0){

				foreach($permissions as $data){
					$sql = "INSERT INTO roles_permissions (role_id, permission_id) VALUES (?,?)";
					$this->pdo->prepare($sql)->execute(array($role_id, $data));
				}

			}else{

				$this->deleteRolePermissions($role_id);

				if(!empty($permissions)){
					$this->save($role_id, $permissions);
				}

			}

		}catch (Exception $e){
			die($e->getMessage());
		}
	}

}
