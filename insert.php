<?php

$host = "localhost";
$user = "root";
$pass = "root";
$db = "remember_development";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$nome = $data['nome'];
$sobrenome = $data['sobrenome'];
$botao = $data['acaoBotao'];

if($botao == 'Cadastrar')
{
    $sql = "INSERT INTO usuarios (nome, sobrenome) VALUES ('$nome', '$sobrenome')";
    if ($conn->query($sql) === TRUE)
    {
        echo "Armazenado com sucesso!";
    }
    else
    {
        echo "Erro detectado: ".$sql."<br/>".$conn->error;
    }
}
else if ($botao == 'Atualizar')
{
    $id = $data['id'];
    $sql = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome' WHERE id = $id";
    if ($conn->query($sql) === TRUE)
    {
        echo "Atualizado com sucesso!";
    }
    else
    {
        echo "Erro detectado: ".$sql."<br/>".$conn->error;
    }
}

$conn->close();