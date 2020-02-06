<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;
use Exception;
/**
 * Class User
 * @package Source\Models
 */
class User extends DataLayer
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("login", ["nome", "sobrenome", "email", "senha"]);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (
            !$this->validaEmail() ||
            !parent::save()
        ) {
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    protected function validaEmail(): bool
    {
         if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
             $this->fail = new Exception("Informe um E-mail valido");
             return false;
        }
         $userByEmail = null;
         if (!$this->id){
             $userByEmail = $this->find("email = :email", "email={$this->email}")->count();
         }else{
             $userByEmail = $this->find("email = :email AND id != :id", "email={$this->email}&id={$this->id}")->count();
         }
         if ($userByEmail){
             $this->fail = new Exception("O E-mail informado já está em uso");
             return false;
         }
         return true;
    }
}
