<?php
require_once 'Crud.php';

class Filmes extends Crud 
{
    protected $table = 'filmes';
    private $id = null;
    private $nome;
    private $quantidade;
    private $tipo_media;

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

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getTipo_media()
    {
        return $this->tipo_media;
    }

    public function setTipo_media($tipo_media)
    {
        $this->tipo_media = $tipo_media;
    }

    public function insert()
    {
        $sql = "INSERT INTO $this->table (fil_id,fil_nome,fil_quantidade,fil_tipo_media) 
          VALUES (:id, :nome, :quantidade, :tipo_media)";
        $stmt = Connection::prepare($sql);
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':nome',$this->nome);
        $stmt->bindParam(':quantidade',$this->quantidade);
        $stmt->bindParam(':tipo_media',$this->tipo_media);
        return $stmt->execute();
    }

    public function update($id)
    {
        $sql = "UPDATE $this->table SET fil_nome = :nome, fil_quantidade = :quantidade, fil_tipo_media = :tipo_media 
          WHERE fil_id = :id";
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':nome',$this->nome);
        $stmt->bindParam(':quantidade',$this->quantidade);
        $stmt->bindParam(':tipo_media',$this->tipo_media);
        return $stmt->execute();
    }
}