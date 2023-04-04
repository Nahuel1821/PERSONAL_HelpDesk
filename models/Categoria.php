<?php
class Categoria extends Conectar{

        public function get_categoria(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_categoria WHERE est=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function listar_categoria(){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="SELECT * FROM tm_categoria;";
            /*
            $sql="SELECT c.cat_id, c.cat_nom, c.est,IF(sc.cat_id IS NULL, 'No', 'Si') AS hay 
            FROM tm_categoria c LEFT JOIN tm_sub_categoria sc ON c.cat_id = sc.cat_id
            GROUP BY 1;";
            */
            $sql="SELECT c.cat_id, 
            c.cat_nom, 
            c.est,IF(sc.cat_id IS NULL, 'No', 'Si') AS hay,
            IF((select t.cat_id from td_usu_cat as t where t.cat_id=c.cat_id) IS NULL,'NO','SI') AS uhay
            FROM tm_categoria c LEFT JOIN tm_sub_categoria sc ON c.cat_id = sc.cat_id
            GROUP BY 1;";

            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function listar_subcategoria($cat_id){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="SELECT * FROM tm_categoria;";
            //$sql="SELECT * FROM tm_sub_categoria WHERE cat_id = (?);";
            //$sql="SELECT tm_sub_categoria.*,(select usu_id from td_usu_subcat where tm_sub_categoria.sub_cat_id=td_usu_subcat.sub_cat_id ) as Hay FROM tm_sub_categoria WHERE cat_id = (?); ";
            $sql="SELECT tm_sub_categoria.*,IF((select usu_id from td_usu_subcat where tm_sub_categoria.sub_cat_id=td_usu_subcat.sub_cat_id) IS NULL,'NO','SI' ) AS uhay FROM tm_sub_categoria WHERE cat_id = (?); ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cat_id);
            $sql->execute();
            //print_r($sql->fetchAll());
            return $resultado=$sql->fetchAll();
        }

        public function listar_sin_subcategoria($cat_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT u.sub_cat_id, u.sub_cat_nom, u.sub_cat_est 
            FROM tm_sub_categoria u where u.cat_id 
            NOT in (select cat_id from tm_categoria where tm_categoria.cat_id=(?) AND cat_id IS not null); ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cat_id);
            $sql->execute();
            //print_r($sql->fetchAll());
            return $resultado=$sql->fetchAll();
        }

        public function get_subcat_x_id($id){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="call sp_l_subcat(?)";
            $sql="SELECT sub_cat_id,sub_cat_nom FROM tm_sub_categoria where sub_cat_id=(?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }
        
        public function CambiarEstadoSub($id,$est){
            $conectar= parent::conexion();
            parent::set_names();
            
            switch($est){
                case 0:
                    $est=2;
                case 1:
                    $est=2;
                    break;
                case 2:
                    $est=1;           
                    break;
                case 3:
                    $est=0;
                    break;    
            } 
            
            
            $sql="update tm_sub_categoria 
                set 
                    sub_cat_est = '".$est."'
                where
                    sub_cat_id = ?";
            //print_r($sql);

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function AddSubCategoria($sub_cat_id,$cat_id){
            $conectar= parent::conexion();
            parent::set_names();
            
           
            $sql="update tm_sub_categoria 
                set 
                    cat_id = (?)
                where
                    sub_cat_id = ?";
            
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $sub_cat_id);
            $sql->execute();
            //print_r($sql->fetchAll());
            return $resultado=$sql->fetchAll();

        }



        public function update_usuario($sub_cat_id,$sub_cat_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_sub_categoria set
                sub_cat_nom = ?
                WHERE
                sub_cat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sub_cat_nom);
            $sql->bindValue(2, $sub_cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_d_usuario_01(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_subcat($sub_cat_id,$sub_cat_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_sub_categoria set
                sub_cat_nom = ?
                WHERE
                sub_cat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sub_cat_nom);
            $sql->bindValue(2, $sub_cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

         public function insert_subcat($sub_cat_nom,$est){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_sub_categoria (sub_cat_nom, sub_cat_est) VALUES ((?),(?));";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sub_cat_nom);
            $sql->bindValue(2, $est);
            $sql->execute();
            print_r($sql->fetchAll());
            return $resultado=$sql->fetchAll();
            
        }

//******************************
}
?>