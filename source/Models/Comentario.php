<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Comentario extends DataLayer
{
public function __construct()
{//	id	titulo	texto	date    foto	usuario_id
    parent::__construct("comentario", ["titulo", "texto", "nome", "usuario_id"], "id", false);
}
}