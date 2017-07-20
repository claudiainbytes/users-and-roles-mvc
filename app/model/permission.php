<?php
class Permission{

		private $pdo;
		public $id;

    public $permission;

	public function __CONSTRUCT(){
		try{
			$this->pdo = Database::StartUp();
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getPermissions(){
		try{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM permissions");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getPermission($id){
		try{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM permissions WHERE id = ?");

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		}catch (Exception $e){
			die($e->getMessage());
		}
	}

	public function delete($id){
		try{
			$stm = $this->pdo
			            ->prepare("DELETE FROM permissions WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e){
			die($e->getMessage());
		}
	}

	public function update($data){
		try{
			$sql = "UPDATE permissions SET permission = ? WHERE id = ?";
			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                  $data->permission,
                  $data->id
								)
				);
		}catch (Exception $e){
			die($e->getMessage());
		}
	}

	public function addNew(Permission $data){
		try{
			$sql = "INSERT INTO permissions (permission)
			        VALUES (?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
	                    $data->permission
	                )
				);
		}catch (Exception $e){
			die($e->getMessage());
		}
	}

}
