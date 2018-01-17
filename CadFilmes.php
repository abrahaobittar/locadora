<?php
require_once 'Filmes.php';
?>

<!DOCTYPE HTML>
<html>
    <head>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

        <title>Cadastro de Filmes</title>

        <script type="text/javascript">
            function removeMensagem() {
                setTimeout(function () {
                    var msg = document.getElementById("msg_sucesso");
                    msg.parentNode.removeChild(msg);
                }, 2000);
            }

            document.onreadystatechange = () => {
                if (document.readyState === 'complete') {
                    // toda vez que a página carregar, vai limpar a mensagem (se houver) 
                    // após 5 segundos
                    removeMensagem();
                }
            };
        </script>
    </head>

    <body onload=document.form_filme.reset();>

        <?php
        $filmes = new Filmes();

        if (isset($_POST['cadastrar_filme'])):
            $nome = $_POST['nome_filme'];
            $quantidade = $_POST['quantidade'];
            $tipo_media = $_POST['tipo_media'];

            $filmes->setNome($nome);
            $filmes->setQuantidade($quantidade);
            $filmes->setTipo_media($tipo_media);

            if ($filmes->insert()) {
                echo '<p id="msg_sucesso">filme cadastrado com sucesso!</p>';
            } else {
                echo'<p id="msg_erro">Algo deu errado :( </p>';
            }
        endif;
        ?>

        <form name="form_filme" method="post">
            <div class="row">
                <div class="form-group col-md-4">
                    <p>filme</p>
                    <input  class="form-control" type="text" name="nome_filme" />

                    <p>Quantidade</p>
                    <input class="form-control" type="number" min="0" max="5" name="quantidade"/>

                    <p>Tipo de midia</p>
                    <select class="custom-select" name="tipo_media">
                        <option value="DVD">DVD</option>
                        <option value="Blu-ray">Blu-ray</option>
                    </select>
                </div>
            </div>

            <Button class="btn btn-outline-success" name="cadastrar_filme">Cadastrar</Button>
            <button class="btn btn-outline-primary" formaction="index.php">voltar</button>
        </form>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Media</th>
                </tr>
            </thead>

            <?php foreach ($filmes->findAll() as $key => $value): ?>
                <tbody>
                    <tr>
                        <td><?php echo $value->fil_id; ?></td>
                        <td><?php echo $value->fil_nome; ?></td>
                        <td><?php echo $value->fil_quantidade; ?></td>
                        <td><?php echo $value->fil_tipo_media; ?></td>  
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </body>
</html>