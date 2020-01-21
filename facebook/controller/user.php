<?php
require_once('UserPermits.php');
require_once('ssgfactor.php');
// Este controlador controla quien es el propietario de la sesion y por lo tanto le da permisos para ver si puede acceder a este contenido
    if (isset($_SESSION['id_user'])){
        $id_user=$_SESSION['id_user'];
        $page_id = (isset($_SESSION['psid'])) ? $_SESSION['psid'] : '' ;
        $UserModel = new UserModel();
        $FacebookModel = new FacebookModel();
        // verificar la existencia en el ssg del usuario logeado
        $checkUser = $UserModel->checkUser($id_user);
        if ($checkUser == true){
            $userpermits= new UserPermits;
            // ver que nivel de permiso tiene este usuario
            $nivel_permiso= $userpermits->getNivelPermiso($id_user);
            if ($nivel_permiso>=NIVEL_MIN_PERMISO) {
                $user= $userpermits->getInfoUserActual($id_user);
                $pages = $FacebookModel->listPages($user->id_facebook);
                // si el usuario no es modo dios e intenta acceder a una pagina que no le corresponde ¡pues se va!
                if($nivel_permiso<4 && $userpermits->getPermisoPage($id_user, $page_id)==false){               
                    header('location: sinpermisos.php');
                }
                $userpermits->setIDFirstPageSsgUser($id_user);
                $firstPageSsg = ($userpermits->firstPageSsg!=null) ? $userpermits->firstPageSsg : '' ;
            }else{
                header('location: sinpermisos.php');
            }
        } else {
            header('Location: https://ssgenius.com/app/facebook/login');
        }
    } else {
        header('Location: https://ssgenius.com/app/facebook/login');
    }
?>