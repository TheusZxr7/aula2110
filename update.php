<?php

require 'banco.php';

$rm = null;
if (!empty($_GET['rm'])) {
    $rm = $_REQUEST['rm'];
}

if (null == $rm) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $nomeErro = null;
    $enderecoErro = null;
    $foneErro = null;
    $emailErro = null;
    $idadeErro = null;
    $nomeconjugeErro = null;

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];
    $nomeconjuge = $_POST['nomeconjuge'];

    //Validação
    $validacao = true;
    if (empty($nome)) {
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }

    if (empty($email)) {
        $emailErro = 'Por favor digite o email!';
        $validacao = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErro = 'Por favor digite um email válido!';
        $validacao = false;
    }

    if (empty($endereco)) {
        $enderecoErro = 'Por favor digite o endereço!';
        $validacao = false;
    }

    if (empty($fone)) {
        $foneErro = 'Por favor digite o telefone!';
        $validacao = false;
    }

    if (empty($idade)) {
        $idadeErro = 'Por favor preenche o campo!';
        $validacao = false;
    }

    if (empty($nomeconjuge)) {
        $nomeconjugeErro = 'Por favor preenche o campo!';
        $validacao = false;
    }

    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tb_alunos  set nome = ?, endereco = ?, fone = ?, email = ?, idade = ?, nomeconjuge = ? WHERE rm = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $fone, $email, $idade, $comeconjuge, $rm));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM tb_alunos where rm = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($rm));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $endereco = $data['endereco'];
    $fone = $data['fone'];
    $email = $data['email'];
    $idade = $data['idade'];
    $nomeconjuge = $data['nomeconjuge'];
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- using new bootstrap -->
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.mi
n.css"
        integrity="sha384-
MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <title>Atualizar Contato</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="card">
                <div class="card-header">
                    <h3 class="well"> Atualizar Contato </h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal"

                        action="update.php?codigo=<?php echo $codigo ?>" method="post">
                        <div class="control-group <?php echo

                                                    !empty($nomeErro) ? 'error' : ''; ?>">

                            <label class="control-label">Nome</label>
                            <div class="controls">
                                <input name="nome" class="form-control"

                                    size="50" type="text" placeholder="Nome"

                                    value="<?php echo !empty($nome) ?

                                                $nome : ''; ?>">

                                <?php if (!empty($nomeErro)): ?>
                                    <span class="text-danger"><?php echo

                                                                $nomeErro; ?></span>

                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group <?php echo

                                                    !empty($enderecoErro) ? 'error' : ''; ?>">

                            <label class="control-label">Endereço</label>
                            <div class="controls">

                                <input name="endereco" class="form-
control" size="80" type="text" placeholder="Endereço"

                                    value="<?php echo !empty($endereco) ?

                                                $endereco : ''; ?>">

                                <?php if (!empty($enderecoErro)): ?>

                                    <span class="text-danger"><?php echo

                                                                $enderecoErro; ?></span>

                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group <?php echo

                                                    !empty($foneErro) ? 'error' : ''; ?>">

                            <label class="control-label">Telefone</label>
                            <div class="controls">

                                <input name="telefone" class="form-
control" size="30" type="text" placeholder="Telefone"

                                    value="<?php echo !empty($fone) ?

                                                $fone : ''; ?>">

                                <?php if (!empty($foneErro)): ?>
                                    <span class="text-danger"><?php echo

                                                                $foneErro; ?></span>

                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group <?php echo

                                                    !empty($emailErro) ? 'error' : ''; ?>">

                            <label class="control-label">Email</label>
                            <div class="controls">
                                <input name="email" class="form-control"

                                    size="40" type="text" placeholder="Email"

                                    value="<?php echo !empty($email) ?

                                                $email : ''; ?>">

                                <?php if (!empty($emailErro)): ?>
                                    <span class="text-danger"><?php echo

                                                                $emailErro; ?></span>

                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="control-group <?php echo

                                                    !empty($idadeErro) ? 'error' : ''; ?>">

                            <label class="control-label">Idade</label>
                            <div class="controls">
                                <input name="idade" class="form-control"

                                    size="80" type="text" placeholder="Idade"

                                    value="<?php echo !empty($idade) ?

                                                $idade : ''; ?>">

                                <?php if (!empty($idadeErro)): ?>
                                    <span class="text-danger"><?php echo

                                                                $idadeErro; ?></span>

                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="control-group <?php echo

                                                    !empty($nomeconjugeErro) ? 'error' : ''; ?>">

                            <label class="control-label">NomeConjuge</label>
                            <div class="controls">
                                <input name="nomeconjuge" class="form-control"

                                    size="50" type="text" placeholder="NomeConjuge"

                                    value="<?php echo !empty($nomeconjuge) ?

                                                $nomeconjuge : ''; ?>">

                                <?php if (!empty($nomeconjugeErro)): ?>
                                    <span class="text-danger"><?php echo

                                                                $nomeconjugeErro; ?></span>

                                <?php endif; ?>
                            </div>
                        </div>
                        <br />
                        <div class="form-actions">

                            <button type="submit" class="btn btn-
warning">Atualizar</button>

                            <a href="index.php" type="btn" class="btn

btn-default">Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.m
in.js"
        integrity="sha384-
ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>