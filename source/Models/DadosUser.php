<?php


namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;
use Masterkey\ValidDocs\ValidDocs;

class DadosUser extends DataLayer
{public function __construct()
{
    parent::__construct("documentos", ["cpf", "rg", "date", "celular"], "id", false);
}
    public function save(): bool
    {

        if (!$this->validaCpf() ||
            !parent::save()
        ){
            return false;
        }
        return true;
    }

    protected function validaCpf()
    {
        // Validando um CPF
        if(!ValidDocs::validaCPF($this->cpf)) {
            $this->fail = new Exception("Informe um CPF valido");
            return false;
        }
        return true;
    }
}