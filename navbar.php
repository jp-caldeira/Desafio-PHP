

<nav class="navbar navbar-expand-lg bg-dark">
  <ul class="nav btn-group mx-auto p-3">
        <li class="nav-item p-2"><a type="button" class="btn btn-secondary" href="indexProdutos.php">Lista de Produtos</a></li>
        <li class="nav-item p-2"><a type="button" class="btn btn-secondary" href="indexUsuarios.php">Lista de Usuários</a></li>
        <li class="nav-item p-2"><a type="button" class="btn btn-secondary" href="createProduto.php">Cadastrar produto</a></li>
        <li class="nav-item p-2"><a type="button" class="btn btn-secondary" href="createUsuario.php">Cadastrar usuário</a></li>
        <?php if(isset($_SESSION['usuariologado'])): ?>
        <form class="" action="login.php" method="post">
        <li class="nav-item p-2 ml-5"><button type="submit" name="logoff" class="btn btn-danger">Sair do sistema</button></li>
        </form>
        <?php endif; ?>
    </ul>
</nav>
