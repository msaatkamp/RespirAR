<?php

require_once "template/common-header.php";
require_once "template/navbar.php";

?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Usuários Cadastrados</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive col-lg-12">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $result = $link->query("SELECT * FROM users");
                        foreach ($result as $row) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['username'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>';
                            // echo '<a class="btn btn-danger" href="delete_user.php?id=' . $row['id'] . '">Excluir</a>';
                            ?>
                            
                            <a class="btn btn-danger" href="#" onclick="shouldDelete('user', <?=$row['id']?>);">Excluir</a>;
                            <?php
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- <?= "$result->num_rows registros encontrados."?> -->
<p class="text-center">
    <a href="register_user.php" class="btn btn-success">Novo Usuário</a>
</p>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php

require_once "template/common-footer.php"

?> 