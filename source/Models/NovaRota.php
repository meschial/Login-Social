<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class NovaRota extends DataLayer
{
    public function __construct()
    {//id	quantidade	valor	cep_inicio	cep_fim	data_inicio	cidade_inicio	cidade_fim	tamahno	motorista_id
        parent::__construct("rota", ["quantidade", "valor", "cep_inicio", "cep_fim", "data_inicio", "cidade_inicio", "cidade_fim", "tamanho"], "id", false);
    }

    public function rota(User $user, string $cidade_inicio): NovaRota
    {
        $this->login_id = $user->id;
        $this->cidade_inicio = $cidade_inicio;
        return $this;
    }
}