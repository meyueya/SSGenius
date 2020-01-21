<?php

require_once("Database.php");

class UserRolModel
{
    protected $id_rol_user;
    public $rol_user;

    protected function getIdRolUser($id_user){
			$sql = "SELECT id_rol FROM `ssg_rol_user` WHERE `id_user` =:id";
            $dbh = Database::getInstance();
            $stmt=$dbh->prepare($sql);
            $stmt->bindParam(':id', $id_user);
            $stmt->execute();
            $id_rol_user=$stmt->fetchObject();
            $this->id_rol_user=$id_rol_user->id_rol;
    }
    
    public function getInfoUser($id_user){
        $con = Database::getInstance();
        $stmt = $con->prepare("SELECT * FROM ssg_user WHERE id_user = :id_user");
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        $object = $stmt->fetchObject();
        return $object;
    }

    public function getRolUser($id_user){
        $con = Database::getInstance();
        $this->getIdRolUser($id_user);
		$sql = "SELECT nombre FROM `ssg_roles` WHERE `id_rol` =:id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $this->id_rol_user);
        $stmt->execute();
        $rol_user = $stmt->fetchObject();;
        $this->rol_user=$rol_user->nombre;
    }

    public function getRoles(){
        $con = Database::getInstance();
		$sql = "SELECT nombre FROM `ssg_roles` WHERE `id_rol` !='16658038765c3e1efcd453d5.71704608'";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function updateRol($array){
        $con = Database::getInstance();
        $sql = "SELECT id_rol FROM `ssg_roles` WHERE `nombre` =:nombre";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':nombre', $array['rol_update'], PDO::PARAM_STR);
        $stmt->execute();
        $id_rol_up = $stmt->fetchObject();
        $sqlup = "UPDATE `ssg_rol_user` SET `id_rol`=:id_rol WHERE `id_user`=:id_user";
        $stmt = $con->prepare($sqlup);
        $stmt->bindParam(':id_user', $array['id_user'], PDO::PARAM_STR);
        $stmt->bindParam(':id_rol', $id_rol_up->id_rol, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getInfoRolUsers(){//esta funcion solo la usaran los super administradores
        $con = Database::getInstance();
		$sql = "SELECT ssg_roles.nombre AS nombre_rol, ssg_user.name, ssg_user.id_user
        FROM ssg_roles INNER JOIN  ssg_rol_user
                ON ssg_rol_user.id_rol=ssg_roles.id_rol
             INNER JOIN ssg_user 
                ON ssg_rol_user.id_user=ssg_user.id_user
        WHERE ssg_roles.id_rol!='16658038765c3e1efcd453d5.71704608'";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

}