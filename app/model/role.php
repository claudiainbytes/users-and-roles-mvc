<?php
class Role{

		private $pdo;

		public $id;
    public $role;

	public function __CONSTRUCT(){
		try{
			$this->pdo = Database::StartUp();
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getRoles(){
		try{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM roles");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getRole($id){
		try{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM roles WHERE id = ?");

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		}catch (Exception $e){
			die($e->getMessage());
		}
	}

	public function delete($id){
		try{
			$stm = $this->pdo
			            ->prepare("DELETE FROM roles WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e){
			die($e->getMessage());
		}
	}

	public function update($data){
		try{
			$sql = "UPDATE roles SET role = ? WHERE id = ?";
			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                  $data->role,
                  $data->id
								)
				);
		}catch (Exception $e){
			die($e->getMessage());
		}
	}

	public function addNew(Role $data){
		try{
			$sql = "INSERT INTO roles (role)
			        VALUES (?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
	                    $data->role
	                )
				);
		}catch (Exception $e){
			die($e->getMessage());
		}
	}

}
