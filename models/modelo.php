<?php  
class EnlacesPaginas
{
    public static function enlacesPaginasModel($enlacesModel){
        if($enlacesModel=="celebridades"||
        $enlacesModel=="inicio"||
        $enlacesModel=="peliculas"||
        $enlacesModel=="perfil"||
        $enlacesModel=="series")
        {
            $module="views/modules/".$enlacesModel.".php";
        }else{
            $module="views/modules/inicio.php";
        }
        return $module;
    }

}

?>