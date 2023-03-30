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
                    $sub_array[] = '<a onClick="Ver_Sub_Categoria('.$row["cat_id"].')"><span class="label label-pill label-success">SubCategoria</span><a>';
                }else{
                    $sub_array[] = '<a onClick="Add_Sub_Categoria('.$row["cat_id"].')"><span class="label label-pill label-default">SubCategoria</span><a>';
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
                $sub_array[] = $row["cat_id"];
                $sub_array[] = $row["cat_nom"];
                    
                if($row["hay"]=="Si"){
                    $sub_array[] = '<a onClick="Ver_Sub_Categoria('.$row["cat_id"].')"><span class="label label-pill label-success">SubCategoria</span><a>';
                }else{
                    $sub_array[] = '<a onClick="Add_Sub_Categoria('.$row["cat_id"].')"><span class="label label-pill label-default">SubSubCategoria</span><a>';
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

        
        


    }
?>