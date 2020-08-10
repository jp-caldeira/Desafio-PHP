

<nav class="navbar navbar-expand-lg bg-dark align-center">
  <ul class="nav btn-group ml-0 mr-auto">
        <li class="nav-item p-2"><a type="button" class="btn btn-secondary" href="indexProdutos.php">Lista de Produtos</a></li>
        <li class="nav-item p-2"><a type="button" class="btn btn-secondary" href="indexUsuarios.php">Lista de Usuários</a></li>
        <li class="nav-item p-2"><a type="button" class="btn btn-secondary" href="createProduto.php">Cadastrar produto</a></li>
        <li class="nav-item p-2"><a type="button" class="btn btn-secondary" href="createUsuario.php">Cadastrar usuário</a></li>
        </ul>
        <?php if(isset($_SESSION['usuariologado'])): ?>
        <form class="" action="login.php" method="post">
        <a class="nav-item p-2"><button type="submit" name="logoff" class="btn btn-danger">Sair do sistema</button></a>
        </form>
        <?php endif; ?>

</nav>
