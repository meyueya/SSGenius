<?php
require_once('../model/FacebookModel.php');
require_once('../model/UserModel.php');
require_once('../model/UserRolModel.php');
class UserPermits extends UserRolModel 
{   

    public $nivel_permiso;
    public $firstPageSsg;

    public function getInfoUserActual($id_user){
        $UserModel = new UserModel();
        $user_actual = $UserModel->getUser($id_user);
        return $user_actual;      
    }

    public function getPermisoPage($id_user, $page_id){
        $UserModel = new UserModel();
        $FacebookModel = new FacebookModel();
        $user = $UserModel->getUser($id_user);
        $pages = $FacebookModel->listPages($user->id_facebook);
        $admin=false;
        foreach ($pages as $value) {
            if ($value['id_facebook_page']==$page_id) {
                $admin=true;
                break;
            }
        }
        return $admin;
    }

    private function setNivelPermiso($id_user){
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

    public function getNivelPermiso($id_user){
        $this->setNivelPermiso($id_user);
        $nivel_permiso=$this->nivel_permiso;
        return $nivel_permiso;
    }

    public function setIDFirstPageSsgUser($id_user){
        $UserModel = new UserModel();
        $FacebookModel = new FacebookModel();
        $user = $UserModel->getUser($id_user);
        $pages = $FacebookModel->listPages($user->id_facebook);
        if (count($pages)>0) {
            $this->firstPageSsg=$pages['0']['id_facebook_page'];
        }
    }

}

?>