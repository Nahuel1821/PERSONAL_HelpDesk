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
            $sql="SELECT c.cat_id, c.cat_nom, c.est,IF(sc.cat_id IS NULL, 'No', 'Si') AS hay 
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
            $sql="SELECT * FROM tm_sub_categoria WHERE cat_id(?)
            GROUP BY 1;";

            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>