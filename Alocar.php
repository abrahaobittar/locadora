<?php
require_once 'Crud.php';

class Alocar extends Crud
{
    protected $table = 'cliente_aluga_filme';
    private $filme_fil_id;
    private $cliente_cli_id;
    private $caf_dias;
    private $caf_data_aluguel;
    private $caf_data_entrega;
    private $caf_ordem_servico;

    public function getCaf_Ordem_Servico()
    {
        return $this->caf_ordem_servico;
    }

    public function setCaf_Ordem_Servico($caf_ordem_servico)
    {
        $this->caf_ordem_servico = $caf_ordem_servico;
    }

    public function getFilme_fil_id()
    {
        return $this->filme_fil_id;
    }

    public function setFilme_fil_id($filme_fil_id)
    {
        $this->filme_fil_id = $filme_fil_id;
    }

    public function getCliente_cli_id()
    {
        return $this->cliente_cli_id;
    }

    public function setCliente_cli_id($cliente_cli_id)
    {
        $this->cliente_cli_id = $cliente_cli_id;
    }

    public function getCaf_dias()
    {
        return $this->caf_dias;
    }

    public function setCaf_dias($caf_dias)
    {
        $this->caf_dias = $caf_dias;
    }

    public function getCaf_data_aluguel()
    {
        return $this->caf_data_aluguel;
    }

    public function setCaf_data_aluguel($caf_data_aluguel)
    {
        $this->caf_data_aluguel = $caf_data_aluguel;
    }

    public function getCaf_data_entrega()
    {
        return $this->caf_data_entrega;
    }

    public function setCaf_data_entrega($caf_data_entrega)
    {
        $this->caf_data_entrega = $caf_data_entrega;
    }

    public function insert()
    {
        $sql = "INSERT INTO $this->table (filme_fil_id,cliente_cli_id,caf_data_aluguel)
          VALUES (:fil_id, :cli_id, :data_aluguel)";
        $stmt = Connection::prepare($sql);
        $stmt->bindParam(':fil_id',$this->filme_fil_id);
        $stmt->bindParam(':cli_id',$this->cliente_cli_id);
        $stmt->bindParam(':data_aluguel',$this->caf_data_aluguel);
        return $stmt->execute();
    }

    public function update($os)
    {
        $sql = "UPDATE $this->table SET caf_dias = :dias, caf_data_aluguel = :data_aluguel, caf_data_entrega = :data_entrega
          WHERE caf_ordem_servico :os";
        $stmt->bindParam(':os',$this->caf_ordem_servico);
        $stmt->bindParam(':dias',$this->caf_dias);
        $stmt->bindParam(':data_aluguel',$this->caf_data_aluguel);
        $stmt->bindParam(':data_entrega',$this->caf_data_entrega);
        return $stmt->execute();
    }

    public function selectOS()
    {
        /*Select para selecionar todas as ordens de serviço com nome do cliente
        e respectivo filme */
/*           $sql = "SELECT a.caf_ordem_servico, c.cli_nome, f.fil_nome, a.caf_data_aluguel
        	FROM (( cliente_aluga_filme a 
    		JOIN clientes c ON a.cliente_cli_id = c.cli_id)
            JOIN filmes f ON a.filme_fil_id = f.fil_id) limit 5"; */

        $sql = "SELECT a.caf_ordem_servico, c.cli_nome, f.fil_nome, date_format(a.caf_data_aluguel, '%d/%m/%Y') as Data
                    FROM (( cliente_aluga_filme a 
                    JOIN clientes c ON a.cliente_cli_id = c.cli_id)
                    JOIN filmes f ON a.filme_fil_id = f.fil_id) limit 5";
        $stmt = Connection::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}