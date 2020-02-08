<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Usuario extends DataLayer
{
public function __construct()
{//cpf	rg	date	tipo	celular	ativo	login_id
    parent::__construct("usuario", ["cpf", "rg", "celular", "login_id"], "id", false);
}
}