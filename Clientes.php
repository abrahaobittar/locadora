<?php
require_once 'Crud.php';

class Clientes extends Crud 
{
     protected $table = 'Clientes';
     private $id = NULL;
     private $nome;
     private $cpf;
     private $email;
     private $telefone;
     private $endereco;
 
     public function getId()
     {
         return $this->id;
     }
 
     public function setId($id)
     {
         $this->id = $id;
     }
 
     public function getNome()
     {
         return $this->nome;
     }
 
     public function setNome($nome)
     {
         $this->nome = $nome;
     }
 
     public function getCpf()
     {
         return $this->cpf;
     }
 
     public function setCpf($cpf)
     {
         $this->cpf = $cpf;
     }
 
     public function getEmail()
     {
         return $this->email;
     }
 
     public function setEmail($email)
     {
         $this->email = $email;
     }
 
     public function getTelefone()
     {
         return $this->telefone;
     }
 
     public function setTelefone($telefone)
     {
         $this->telefone = $telefone;
     }
 
     public function getEndereco()
     {
         return $this->endereco;
     }
 
     public function setEndereco($endereco)
     {
         $this->endereco = $endereco;
     }

     public function insert()
     {
        $sql = "INSERT INTO $this->table (cli_id,cli_nome,cli_cpf,cli_email,cli_telefone,cli_endereco) VALUES (:id, :nome, :cpf, :email, :telefone, :endereco)";
        $stmt = Connection::prepare($sql);
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':nome',$this->nome);
        $stmt->bindParam(':cpf',$this->cpf);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':telefone',$this->telefone);
        $stmt->bindParam(':endereco',$this->endereco);
        return $stmt->execute();
    }

    public function update($id)
    {
        $sql = "UPDATE $this->table SET cli_nome = :nome, cli_cpf = :cpf, cli_email = :email, cli_telefone = :telefone, cli_endereco = :endereco where cli_id = :id";
        $stmt->bindParam(':cli_id',$id);
        $stmt->bindParam(':cli_nome',$this->nome);
        $stmt->bindParam(':cli_cpf',$this->cpf);
        $stmt->bindParam(':cli_email',$this->email);
        $stmt->bindParam(':cli_telefone',$this->telefone);
        $stmt->bindParam(':cli_endereco',$this->endereco);
        return $stmt->execute();
    }

    public function updateCliente() 
    {
        $sql = "UPDATE $this->table SET cli_nome = :nome, cli_cpf = :cpf, cli_email = :email, cli_telefone = :telefone, cli_endereco = :endereco where cli_id = :id";
        $stmt->bindParam(':id',$this->id);    
        $stmt->bindParam(':nome',$this->nome);
        $stmt->bindParam(':cpf',$this->cpf);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':telefone',$this->telefone);
        $stmt->bindParam(':endereco',$this->endereco);
        return $stmt->execute();
    }

    public function findByCPF($cpf)
    {
        $sql = "SELECT * FROM $this->table WHERE cli_cpf = :cpf";
        $stmt = Connection::prepare($sql);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_INT);
        return $stmt->fetch();
    }
}