<?php
require_once('../model/FacebookModel.php');
require_once('../model/UserModel.php');
require_once('../model/UserRolModel.php');
$UserModel = new UserModel();
$FacebookModel = new FacebookModel();

class RolUser extends UserRolModel 
{   
    public $nivel_permiso;
    private function set_nivel_permiso($id_user){
        $id_rol_user=new UserRolModel;
        $id_rol_user->getIdRolUser($id_user);
        switch ($id_rol_user->id_rol_user) {
            case '3155088785c3e1d81c12aa0.49838508':
                $nivel=1;
                break;
            case '17255679015c3e1dc96d8b23.71390049':
                $nivel=2;
                break;
            case '2055596465c3e1e5f795363.71197807':
                $nivel=3;
                break;
            case '16658038765c3e1efcd453d5.71704608':
                $nivel=4;
                break;
            default:
                $nivel=0;
                break;
        }
        $this->nivel_permiso=$nivel;
    }
}
?>