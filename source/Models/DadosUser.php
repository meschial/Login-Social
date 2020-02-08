<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class DadosUser extends DataLayer
{public function __construct()
{
    parent::__construct("documento", ["cpf", "rg", "date", "celular"], "id", false);
}
}