<?php
    class Depto extends Conectar{

        public function listar_depto(){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="SELECT depto_id,depto_nom,est FROM tm_depto WHERE est=1;";
            //$sql="SELECT depto_id,depto_nom,est FROM tm_depto ORDER BY depto_nom DESC ;";
            /*
            $sql="SELECT d.depto_id, d.depto_nom, d.est, u.usu_id, u.usu_nom, u.usu_ape
                FROM tm_depto d
                    LEFT JOIN td_usu_depto ud ON d.depto_id = ud.depto_id
                    LEFT JOIN tm_usuario u ON u.usu_id = ud.usu_id;";
            */
            $sql="SELECT d.depto_id, d.depto_nom, d.est,IF(u.usu_id IS NULL, 'No', 'Si') AS hay 
            FROM tm_depto d 
            LEFT JOIN td_usu_depto ud ON d.depto_id = ud.depto_id 
            LEFT JOIN tm_usuario u ON u.usu_id = ud.usu_id 
            GROUP BY d.depto_id; ";        

            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_depto_x_id($depto_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_l_depto(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $depto_id);
            $sql->execute();
            //print_r($sql->fetchAll());
            return $resultado=$sql->fetchAll();
        }
        
        public function insert_depto($depto_nom){
            //print_r("funcion insert a desarrollar".$depto_id); 
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_i_depto(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $depto_nom);
            $sql->execute();
            print_r($sql->fetchAll());
            //return $resultado=$sql->fetchAll();
        } 

        public function update_depto($depto_id,$depto_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_depto 
                set 
                    depto_nom = '".$depto_nom."'
                where
                    depto_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $depto_id);
            $sql->execute();
            //print_r($sql->fetchAll());
            return $resultado=$sql->fetchAll();

        }

        
        public function cambiar_estado($depto_id,$est){
            
            $conectar= parent::conexion();
            parent::set_names();
            
            switch($est){
                case 1:
                    $est=2;
                    break;
                case 2:
                    $est=1;           
                    break;
            } 
            
            /*
            if($est==1){
                $est=2;
            }elseif($est=2){
                $est=1;
            }else{
                $est=0;
            }
            */
            
            $sql="update tm_depto 
                set 
                    est = '".$est."'
                where
                    depto_id = ?";
            print_r($sql);

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $depto_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 
        
    }
?>