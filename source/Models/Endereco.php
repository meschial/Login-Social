<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Endereco extends DataLayer
{
public function __construct()
{//	id	cep	rua	complemento	bairro	cidade	estado	numero	usuario_id
    parent::__construct("endereco", ["cep", "rua", "complemento", "bairro", "cidade", "estado", "numero", "usuario_id"], "id", false);
}

}