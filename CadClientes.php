<?php
require_once 'Clientes.php';
?>

<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

        <title>Cadastro de Clientes</title>

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

    <body onload=document.form_clientes.reset();>

        <?php
        $clientes = new Clientes();

        if (isset($_POST['cadastrar_cliente'])):
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $endereco = $_POST['endereco'];

            $clientes->setNome($nome);
            $clientes->setCpf($cpf);
            $clientes->setEmail($email);
            $clientes->setTelefone($telefone);
            $clientes->setEndereco($endereco);

            if ($clientes->insert()) {
                echo '<p id="msg_sucesso">inserido com sucesso</p>';
            } else {
                echo'<p id="msg_erro">Algo deu errado :( </p>';
            }
        endif;
        ?>

        <?php
		    if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):
			    $id = (int)$_GET['id'];
    			if($clientes->delete($id,'cli_id')){
	    			echo '<p id="msg_sucesso">Deletado com sucesso!</p>';
			    }
		    endif;
		?>
    
        <?php 
            if(isset($_GET['acao']) && $_GET['acao'] == 'editar') {
                $id = (int)$_GET['id'];
                $resultado = $clientes->find($id,'cli_id');

                if(isset($_POST['alterar_cliente'])):
                    $clientes->setId($_GET['id']);
                    $clientes->setNome($_POST['enome']);
                    $clientes->setCpf($_POST['ecpf']);
                    $clientes->setEmail($_POST['eemail']);
                    $clientes->setTelefone($_POST['etelefone']);
                    $clientes->setEndereco($_POST['eendereco']);
                    $clientes->updateCliente($filmes->getId(), $filmes->getNome(), $filmes->getCpf(), $filmes->getEmail(), $filmes->getTelefone(), $filmes->getEndereco());
               endif;
        ?>

        <form name="form_editar"method="post">
            <div class="row">
                <div class="form-group col-md-4">
                    <p>Nome</p>
                    <input type="text" class="form-control" name="enome" />

                    <p>CPF</p>
                    <input type="text" class="form-control" name="ecpf" />

                    <p>Email</p>
                    <input type="text" class="form-control" name="eemail" />

                    <p>Telefone</p>
                    <input type="text" class="form-control" id="telefone" name="etelefone"/>

                    <p>Endereco</p>
                    <input type="text" class="form-control" name="eendereco" />
                </div>
            </div>

            <Button class="btn btn-outline-success" name="alterar_cliente">Cadastrar</Button>
            <button class="btn btn-outline-primary" formaction="index.php">voltar</button>
        </form>

        <?php } else { ?>

        <form name="form_clientes"method="post">
            <div class="row">
                <div class="form-group col-md-4">
                    <p>Nome</p>
                    <input type="text" class="form-control" name="nome" />

                    <p>CPF</p>
                    <input type="text" class="form-control" name="cpf" />

                    <p>Email</p>
                    <input type="text" class="form-control" name="email" />

                    <p>Telefone</p>
                    <input type="text" class="form-control" id="telefone" name="telefone"/>

                    <p>Endereco</p>
                    <input type="text" class="form-control" name="endereco" />
                </div>
            </div>
                <Button class="btn btn-outline-success" name="cadastrar_cliente">Cadastrar</Button>
                <button class="btn btn-outline-primary" formaction="index.php">voltar</button>
        </form>

        <?php } ?>

        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Endereco</th>
                </tr>
            </thead>

            <?php foreach ($clientes->findAll() as $key => $value): ?>
                <tbody>
                    <tr>
                        <td><?php echo $value->cli_id; ?></td>
                        <td><?php echo $value->cli_nome; ?></td>
                        <td><?php echo $value->cli_cpf; ?></td>
                        <td><?php echo $value->cli_email; ?></td>
                        <td><?php echo $value->cli_telefone; ?></td> 
                        <td><?php echo $value->cli_endereco; ?></td> 
                        <td>
                            <?php echo "<a class\"nav-link\" href='cadclientes.php?acao=editar&id=" . $value->cli_id . "'>Editar</a>"; ?>
                            <?php echo "<a class\"nav-link\" href='cadclientes.php?acao=deletar&id=" . $value->cli_id . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </body>
</html>