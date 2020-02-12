<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Motorista extends DataLayer
{
public function __construct()
{//id	tipo_cnh	cnh	foto	ativo	login_id
    parent::__construct("motorista", ["tipo_cnh", "cnh", "foto"], "id", false);
}

    public function rota()
    {
        return (new NovaRota())->find("motorista_id = :id","id={$this->id}")->fetch();
    }



}