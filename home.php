<?php

require __DIR__ . '/connections/connections.php';
require __DIR__ . '/functions/session-check.php';

function tampilDataFirst($request)
{
    global $pdo;
    $query = $pdo->prepare($request);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_OBJ);

    return $row;
}

function getRole($role)
{
    $query = tampilDataFirst("SELECT * FROM tb_role WHERE id_role = '$role'");
    $query = $query->nama_role;
    return $query;
}

function getName($name)
{
    $query = tampilDataFirst("SELECT * FROM tb_user WHERE id_user = '$name'");
    $query = $query->nama_lengkap;
    return $query;
}
?>
<?php require __DIR__ . '/wp-layouts/resources.php'; ?>
<?php require __DIR__ . '/wp-layouts/header.php'; ?>
<?php require __DIR__ . '/wp-layouts/sidebar.php'; ?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Dashboard</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">

        </div>

    </div>
</div>

<?php require __DIR__ . '/wp-layouts/footer.php'; ?>