<?php
    require_once 'Filmes.php';
    require_once 'Clientes.php';
    require_once 'Alocar.php'
?>
<!DOCTYPE HTML>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
<script type="text/javascript" src="script.js"></script>

    <title>Alocar Filme</title>

    <script type="text/javascript">
        function removeMensagem() {
            setTimeout(function () {
                var msg = document.getElementById("msg_sucesso");
                msg.parentNode.removeChild(msg);
            }, 2000);
        }

        document.onreadystatechange = () => {
            if (document.readyState === 'complete') {
                // toda vez que a pagina carregar, vai limpar a mensagem (se houver)
                // timer de 5 segundos
                removeMensagem();
            }
        };
    </script>
</head>
<body>

<?php
    $filmes = new Filmes();
    $clientes = new Clientes();
    $alocar = new Alocar();

    if(isset($_POST['efetuar_alocacao'])):
        // POST está recuperando a ID do filme e cliente
        $filme = $_POST['select_filmes'];
        $cliente = $_POST['select_clientes'];
        $data_aluguel = $_POST['data_aluguel'];

        $alocar->setFilme_fil_id($filme);
        $alocar->setCliente_cli_id($cliente);
        echo $data_aluguel;

        if ($data_aluguel != "") {
            $alocar->setCaf_data_aluguel($data_aluguel.':'.date('H:i:s'));
            $alocar->insert();
            /* TODO colocar update na quantidade do filme
             * Colocar update de quantidade?
             * Se for colocar é preciso fazer uma verificaçao para trazer a alocação em quantidade negativa
             *
             * */
            echo '<p id="msg_sucesso">Alocação feita com sucesso</p>';
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=AlocarFilme.php'>";
        } else {
            echo "<script language=\"javascript\">alert(\"Favor informar a data correta!\")</script>";
        }
        endif;


    if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):
       $id = (int)$_GET['id'];
            if( $alocar->delete( $id,'caf_ordem_servico' ) ) {
                echo '<p id="msg_sucesso">Deletado com sucesso!</p>';
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=AlocarFilme.php'>";
            }
        endif;
?>

<form name="form_alocarfilme" method="post">
    <div class="form-group">
        <div class="col-md-4">
            <p>Titulo</p>
    <!-- colocar a tag option dentro da tag php, se colocar fora a lista dos titulos fica em uma única linha -->
            <select name="select_filmes" class="custom-select">
                <?php foreach ($filmes->findAll() as $key => $value): ?>
                    <?php echo "<option value=\"$value->fil_id\">$value->fil_nome</option>" ?>
                <?php endforeach; ?>
            </select>

            <p>Cliente</p>
            <select name="select_clientes" class="custom-select">
                <?php foreach ($clientes->findAll() as $key => $value): ?>
                    <?php echo "<option value=\"$value->cli_id\">$value->cli_nome</option>" ?>
                <?php endforeach; ?>
            </select>

            <p>Data</p>
            <input type="date" name="data_aluguel" class="form_control">

        </div>
    </div>
    <button class="btn btn-outline-success" name="efetuar_alocacao">Efetuar</button>
    <button class="btn btn-outline-primary" formaction="index.php"> Voltar</button>
    <br>
</form>

    <table class="table table-sm table-hover">
        <thead>
            <tr>
                <th>OS</th>
                <th>Nome</th>
                <th>Filme</th>
                <th>Data</th>
                <th>Acoes</th>
            </tr>
        </thead>

        <?php foreach($alocar->selectOS() as $keyAlugados => $valorAlugados): ?>
            <tbody>
                <tr>
                    <td><?php echo $valorAlugados->caf_ordem_servico; ?></td>
                    <td><?php echo $valorAlugados->cli_nome; ?></td>
                    <td><?php echo $valorAlugados->fil_nome; ?></td>
                    <td><?php echo $valorAlugados->Data; ?></td>

                    <td><?php echo "<a href='alocarfilme.php?acao=deletar&id=".$valorAlugados->caf_ordem_servico. "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>";?> </td>
                </tr>
            </tbody>
        <?php endforeach ?>
    </table>
</body>
</html>