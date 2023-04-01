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
                    $sub_array[] = '<a onClick="Ver_Sub_Categoria('.$row["cat_id"].',1)"><span class="label label-pill label-success">SubCategoria</span><a>';
                }else{
                    //$sub_array[] = '<a onClick="Add_Sub_Categoria('.$row["cat_id"].',1)"><span class="label label-pill label-default">SubCategoria</span><a>';
                     $sub_array[] = '<a onClick="Ver_Sub_Categoria('.$row["cat_id"].',2)"><span class="label label-pill label-default">SubCategoria</span><a>';
                }

                $sub_array[] = '<a onClick="Ver_usu_categoria('.$row["cat_id"].')"><span class="label label-pill label-success">Usuarios</span><a>';
                

                if ($row["est"]==1){
                   $sub_array[] = '<a onClick="CambiarEstado('.$row["cat_id"].','.$row["est"].')"><span class="label label-pill label-success">Activo</span><a>';
                }elseif($row["est"]==2){
                   $sub_array[] = '<a onClick="CambiarEstado('.$row["cat_id"].','.$row["est"].')"><span class="label label-pill label-default">Pendiente</span><a>';
                }else{
                   $sub_array[] = '<a><span class="label label-pill label-danger">Borrado</span><a>'; 
                }

                $sub_array[] = '<button type="button" onClick="Editar('.$row["cat_id"].');"  id="'.$row["cat_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="Eliminar('.$row["cat_id"].');"  id="'.$row["cat_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';



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
            $datos=$categoria->listar_subcategoria($_POST["cat_id"]); //funcion en model Categorias
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

                $sub_array[] = '<button type="button" onClick="EditarSub('.$row["sub_cat_id"].');"  id="'.$row["sub_cat_id"].'" class="btn btn-outline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="EliminarSub('.$row["sub_cat_id"].');"  id="'.$row["sub_cat_id"].'" class="btn btn-outline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';

                $boton = $row["sub_cat_id"].",".$_POST["cat_id"];

                $boton = "<button type=\"button\" onclick=\"DeleteSubCategoria(".$boton.");\" id=\" ".$row["sub_cat_id"]." \" class=\"btn btn-outline btn-primary btn-sm ladda-button\"><i class=\"fa fa-minus\"></i></button>";
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

        //*********--
        case "mostrarSub";
            $categoria->get_subcat_x_id($_POST["Sub_cat_id"]);  //funcion en model Depto.php
            
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["sub_cat_id"] = $row["sub_cat_id"];
                    $output["sub_cat_nom"] = $row["sub_cat_nom"];
                }
                //print_r($output);
                echo json_encode($output);
            }   

        case "CambiarEstadoSub":
            $categoria->CambiarEstadoSub($_POST["sub_cat_id"],$_POST["sub_cat_est"]);
        break; 
        
        case "AddSubCategoria":
           $categoria->AddSubCategoria($_POST["sub_cat_id"],$_POST["cat_id"]); //funcion en model Categorias
           break;
        


    }
?>