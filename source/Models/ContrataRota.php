<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class ContrataRota extends DataLayer
{//	id	valor	date	rota_id	login_id
public function __construct(){
    parent::__construct("venda", [ "date"], "id", false);
}
}