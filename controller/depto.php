<?php
    require_once("../config/conexion.php");
    require_once("../models/Depto.php");
    $depto = new Depto();

    switch($_GET["op"]){
        case "combo":
            $datos = $depto->combo_depto();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['depto_id']."'>".$row['depto_nom']."</option>";
                }
                echo $html;
            }
        break;
        
        case "listar":
            $datos=$depto->listar_depto(); //funcion en model Depto
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["depto_id"];
                $sub_array[] = $row["depto_nom"];

                if($row["hay"]=="Si"){
                    $sub_array[] = '<a onClick="Ver_usuarios('.$row["depto_id"].')"><img src="../../public/2.png" alt=""></i><a>';
                }else{
                    $sub_array[] = '<a onClick="Add_usuarios('.$row["depto_id"].')"><img src="../../public/2a.png" alt=""><a>';
                }




                if ($row["est"]==1){
                   $sub_array[] = '<a onClick="CambiarEstado('.$row["depto_id"].','.$row["est"].')"><span class="label label-pill label-success">Activo</span><a>';
                }elseif($row["est"]==2){
                   $sub_array[] = '<a onClick="CambiarEstado('.$row["depto_id"].','.$row["est"].')"><span class="label label-pill label-default">Pendiente</span><a>';
                }else{
                   $sub_array[] = '<a><span class="label label-pill label-danger">Borrado</span><a>'; 
                }

                $sub_array[] = '<button type="button" onClick="Editar('.$row["depto_id"].');"  id="'.$row["depto_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="Eliminar('.$row["depto_id"].');"  id="'.$row["depto_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';



                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "mostrar";
            $datos=$depto->get_depto_x_id($_POST["depto_id"]);  //funcion en model Depto.php
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["depto_id"] = $row["depto_id"];
                    $output["depto_nom"] = $row["depto_nom"];
                }
                //print_r($output);
                echo json_encode($output);
            }   
            break;
        case "guardaryeditar":
            if(empty($_POST["depto_id"])){       
                $depto->insert_depto($_POST["depto_nom"]);     
            }
            else {
                $depto->update_depto($_POST["depto_id"],$_POST["depto_nom"]);
            }
            break;
        case "cambiar_estado":
            $depto->cambiar_estado($_POST["depto_id"],$_POST["est"]);
        break; 

        case "eliminar":
            $depto->cambiar_estado($_POST["depto_id"],0);
        break;       

    }
?>