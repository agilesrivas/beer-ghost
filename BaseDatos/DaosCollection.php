<?php namespace BaseDatos;

       interface DaosCollection
       {
       	 public function insert($dato);
       	 public function buscar($id);
       	 public function delete($dato);
       	 public function update($datonuevo);
       }

  ?>
