<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

if (!cadastro_valido($_POST))
    throw new Exception("Cadastro inválido!");

require_once "../../../resources/Conexao.class.php";

cadastrar_usuario($_POST);
echo "Cadastrado com sucesso!";

function cadastrar_usuario($cadastro)
{
    $sql = "INSERT INTO `users` 
                    SET nome = :nome,
                       login = :login,
                       senha = :senha,
                       email = :email";

    $statement = Conexao::getInstance()->prepare($sql);
    $statement->bindValue("nome", $cadastro['nome'], PDO::PARAM_STR);
    $statement->bindValue("login", $cadastro['login'], PDO::PARAM_STR);
    $statement->bindValue("senha", $cadastro['senha'], PDO::PARAM_STR);
    $statement->bindValue("email", $cadastro['email'], PDO::PARAM_STR);
    $salvo = $statement->execute();

    if(!$salvo)
        throw new Exception("Não foi possível cadastrar o usuário!");
}

function cadastro_valido($cadastro)
{
    return (
        isset($cadastro['token'])
        && isset($cadastro['nome'])
        && isset($cadastro['login'])
        && isset($cadastro['senha'])
        && isset($cadastro['email'])
    );
}

function validar_token()
{

}