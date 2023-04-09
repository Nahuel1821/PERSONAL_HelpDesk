<?php
    require_once("../config/conexion.php");
    require_once("../models/Categoria.php");
    $categoria = new Categoria();

    switch($_GET["op"]){
        case "combo":
            $datos = $categoria->get_categoria();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['cat_id']."'>".$row['cat_nom']."</option>";
                }
                echo $html;
            }
        break;

        case "listar_categoria":
            $datos=$categoria->listar_categoria(); //funcion en model Depto
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["cat_id"];
                $sub_array[] = $row["cat_nom"];
                    
                if($row["hay"]=="Si"){
                    $sub_array[] = '<button type="button" onClick="Ver_Sub_Categoria('.$row["cat_id"].',1)" class="btn btn-outline btn-primary btn-sm ladda-button" title="contiene SubCategorias presione aqui para ver"><i class="fa fa-eye"></i></button>';


                }else{
                    //$sub_array[] = '<a onClick="Add_Sub_Categoria('.$row["cat_id"].',1)"><span class="label label-pill label-default">SubCategoria</span><a>';
                     $sub_array[] = '<button type="button" onClick="Ver_Sub_Categoria('.$row["cat_id"].',2)" class="btn btn-outline btn-default btn-sm ladda-button" title="Sin SubCategorias presione aqui para agregar"><i class="fa fa-eye-slash"></i></button>';
                }


                if($row["uhay"]=="SI"){
                    $sub_array[] = '<button type="button" onClick="Ver_usu_categoria('.$row["cat_id"].')" class="btn btn-outline- btn-primary btn-sm ladda-button"><i class="fa fa-users"></i>';


                }else{
                    $sub_array[] = '<button type="button" onClick="Ver_usu_categoria('.$row["cat_id"].')" class="btn btn-outline- btn-default btn-sm ladda-button"><i class="fa fa-users"></i>';
                }                


                
                

                if ($row["est"]==1){
                   $sub_array[] = '<button type="button" onClick="CambiarEstado('.$row["cat_id"].','.$row["est"].')" class="btn btn-outline- btn-success btn-sm ladda-button"><i class="fa fa-check-square-o"></i>';
                }elseif($row["est"]==2){
                    $sub_array[] = '<button type="button" onClick="CambiarEstado('.$row["cat_id"].','.$row["est"].')" class="btn btn-outline- btn-default btn-sm ladda-button"><i class="fa fa-square-o"></i>';
                }else{
                   //$sub_array[] = '<a><span class="label label-pill label-danger">Borrado</span><a>';
                   $sub_array[] = '<button type="button" class="btn btn-outline- btn-danger btn-sm ladda-button"><i class="fa fa-remove"></i>'; 
                }



                $sub_array[] = '<button type="button" onClick="Editar('.$row["cat_id"].');"  id="'.$row["cat_id"].'" class="btn btn-outline- btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i>'; 
                
                $sub_array[] = '<button type="button" onClick="Eliminar('.$row["cat_id"].');"  id="'.$row["cat_id"].'" class="btn btn-outline- btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i>'; 

                //$sub_array[] = '<button type="button" onClick="Eliminar('.$row["cat_id"].');"  id="'.$row["cat_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';



                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "listar_subcategoria":
            $datos=$categoria->listar_subcategoria($_POST["cat_id"]); //metodo de la clase en models Categorias
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["sub_cat_id"];
                $sub_array[] = $row["sub_cat_nom"];
                  

                if($row["uhay"]=="SI"){
                    $sub_array[] = '<button type="button" onClick="Ver_usu_Subcategoria('.$row["sub_cat_id"].',1)" class="btn btn-outline- btn-primary btn-sm ladda-button" title="ver los usuarios que dan soporte a esta subcategoria"><i class="fa fa-users"></i>';
                }else{
                    $sub_array[] = '<button type="button" onClick="Ver_usu_Subcategoria('.$row["sub_cat_id"].',2)" class="btn btn-outline- btn-default btn-sm ladda-button" title="listar los usuarios para agregar al soporte de esta subcategoria,"><i class="fa fa-users"></i>';
                } 


                if ($row["sub_cat_est"]==1){
                   $sub_array[] = '<button type="button" onClick="CambiarEstadoSub('.$row["sub_cat_id"].','.$row["sub_cat_est"].')" class="btn btn-outline- btn-success btn-sm ladda-button" title="Cambiar el estado de esta subcategoria"><i class="fa fa-check-square-o"></i>';
                }elseif($row["sub_cat_est"]==2){
                    $sub_array[] = '<button type="button" onClick="CambiarEstadoSub('.$row["sub_cat_id"].','.$row["sub_cat_est"].')" class="btn btn-outline- btn-default btn-sm " title="esta subcategoria esta inactiva! presione aqui para activarla."><i class="fa fa-square-o"></i>';
                }else{
                   $sub_array[] = '<button type="button" class="btn btn-outline- btn-danger btn-sm ladda-button" title="El estado de esta subcategoria fue eliminada"><i class="fa fa-remove"></i>'; 
                }

                $sub_array[] = '<button type="button" onClick="EditarSub('.$row["sub_cat_id"].');"  id="'.$row["sub_cat_id"].'" class="btn btn-outline btn-warning btn-sm ladda-button" title="Editar la subcategoria"><i class="fa fa-edit"></i></button>';
                
                $sub_array[] = '<button type="button" onClick="EliminarSub('.$row["sub_cat_id"].');"  id="'.$row["sub_cat_id"].'" class="btn btn-outline btn-danger btn-sm ladda-button" title="Eliminar esta subcategoria"><i class="fa fa-trash"></i></button>';

                $boton = $row["sub_cat_id"].",".$_POST["cat_id"];

                $boton = "<button type=\"button\" onclick=\"Sacar_Sub_Cat(".$boton.");\" id=\" ".$row["sub_cat_id"]." \" class=\"btn btn-outline btn-primary btn-sm ladda-button\" title=\"Sacar esta subcategoria de la categoria\"><i class=\"fa fa-minus\"></i></button>";
                $sub_array[] = $boton;

                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break; 

        case "listar_sin_subcategoria":
            $datos=$categoria->listar_sin_subcategoria($_POST["cat_id"]); //funcion en model Categorias
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["sub_cat_id"];
                $sub_array[] = $row["sub_cat_nom"];
                    

                if ($row["sub_cat_est"]==1){
                   $sub_array[] = '<a onClick="CambiarEstadoSub('.$row["sub_cat_id"].','.$row["sub_cat_est"].')"><span class="label label-pill label-success">Activo</span><a>';
                }elseif($row["sub_cat_est"]==2){
                   $sub_array[] = '<a onClick="CambiarEstadoSub('.$row["sub_cat_id"].','.$row["sub_cat_est"].')"><span class="label label-pill label-default">Pendiente</span><a>';
                }else{
                   $sub_array[] = '<a><span class="label label-pill label-danger">Borrado</span><a>'; 
                }

                $sub_array[] = '<button type="button" onClick="EditarSub('.$row["sub_cat_id"].');"  id="'.$row["sub_cat_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="EliminarSub('.$row["sub_cat_id"].');"  id="'.$row["sub_cat_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';

                $boton = $row["sub_cat_id"].",".$_POST["cat_id"];

                $boton = "<button type=\"button\" onclick=\"AddSubCategoria(".$boton.");\" id=\" ".$row["sub_cat_id"]." \" class=\"btn btn-inline btn-success btn-sm ladda-button\"><i class=\"fa fa-plus\"></i></button>";
                $sub_array[] = $boton;

                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break; 

        case "Ver_usu_Subcategoria":
            $datos=$categoria->Ver_usu_Subcategoria($_POST["sub_cat_id"]); //funcion en model Categorias
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                


                $sub_array[] = $row["usu_id"];
                $sub_array[] = $row["usu_ape"];
                $sub_array[] = $row["usu_nom"];


                if ($row["usu_subcat_est"]==1){
                   /*
                   $sub_array[] = '<a onClick="CambiarEstadoSub('.$row["usu_subcat_id"].','.$row["usu_subcat_est"].')"><span class="label label-pill label-success"><i class="fa fa-check-square-o"></i></span><a>';
                   */ 
                   $sub_array[] = '<button type="button" onclick="CambiarEstadoSub('.$row["usu_subcat_id"].','.$row["usu_subcat_est"].')" class="btn btn-outline- btn-success btn-sm ladda-button" title="Cambiar el estado del soporte a esta subcategoria"><i class="fa fa-check-square-o"></i></button>';

                }elseif($row["usu_subcat_est"]==2){
                   $sub_array[] = '<a onClick="CambiarEstadoSub('.$row["usu_subcat_id"].','.$row["usu_subcat_est"].')"><span class="label label-pill label-default">Pendiente</span><a>';
                }else{
                   $sub_array[] = '<a><span class="label label-pill label-danger">Borrado</span><a>'; 
                }



                $sub_array[] = '<button type="button" onClick="EliminarUsuSub('.$row["usu_subcat_id"].');"  id="'.$row["usu_subcat_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';

                

                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break; 

        case "Ver_usu_sin_Subcategoria":
            $datos=$categoria->Ver_usu_sin_Subcategoria($_POST["sub_cat_id"]); //funcion en model Categorias
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                
                $sub_array[] = $row["usu_id"];
                $sub_array[] = $row["usu_ape"];
                $sub_array[] = $row["usu_nom"];

                $sub_array[] = '<button type="button" onClick="AddUsuSub('.$row["usu_id"].','.$_POST["sub_cat_id"].');"  id="'.$row["usu_id"].'" class="btn btn-inline btn-success btn-sm ladda-button"><i class="fa fa-plus"></i></button>';

                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break; 

        //*********--
        case "mostrarSub";
              
            $datos=$categoria->get_subcat_x_id($_POST["sub_cat_id"]);  //funcion en model Categoria.php
            
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["sub_cat_id"] = $row["sub_cat_id"];
                    $output["sub_cat_nom"] = $row["sub_cat_nom"];
                }
                echo json_encode($output);
            }
            break;



        case "CambiarEstadoSub":
            $categoria->CambiarEstadoSub($_POST["sub_cat_id"],$_POST["sub_cat_est"]);
        break; 

        case "Cambiar_Estado":
            $categoria->CambiarEstado($_POST["cat_id"],$_POST["est"]);
        break; 
        
        case "AddSubCategoria":
           $categoria->AddSubCategoria($_POST["sub_cat_id"],$_POST["cat_id"]); //funcion en model Categorias
           break;
        
        case "guardaryeditarSubcat":
            if(empty($_POST["sub_cat_id"])){       
                //print_r("insert nooooo"); 
                $categoria->insert_subcat($_POST["sub_cat_nom"],2); 

            }
            else {
                //print_r("update si"); 
                $categoria->update_subcat($_POST["sub_cat_id"],$_POST["sub_cat_nom"]);
            }
            break;
        case "EliminarSub":
            $categoria->CambiarEstadoSub($_POST["sub_cat_id"],3);
        break;       

        case "Sacar_Sub_cat":
            $categoria->AddSubCategoria($_POST["sub_cat_id"],NULL);//le pasamos null para sacarlo de la categoria que estaba
        break;       

        case "AddUsuSubcat":
            $categoria->AddUsuSubcat($_POST["usu_id"],$_POST["sub_cat_id"]);//le pasamos null para sacarlo de la categoria que estaba
        break;

    }
?>