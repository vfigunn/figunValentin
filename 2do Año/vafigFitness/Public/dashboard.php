<?php
$pageTitle = "Dashboard";

require_once '../Classes/User.php';


session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if($_SESSION['rol'] !== 'admin' ){
    header("Location: rutinas.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user = new User();
$dataUsuario = $user->getUserById($user_id);


?>
<?php require_once '../Components/header.php'?>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand py-1 d-flex justify-content-center" href="dashboard.php" id="logo"><img src="../Assets/images/logo.png" alt="Logo" class="d-inline-block align-top rounded" width="50%" height="50"></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php $nombreMostrar = !empty($dataUsuario->nombre)? $dataUsuario->nombre: $_SESSION['user_email']; ?>
                    Bienvenido/a <?= htmlspecialchars($nombreMostrar) ?><i class="fas fa-user fa-fw ms-3"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <?php if($_SESSION['rol'] === 'admin') {?>
                            
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <?php } ?>
                            <?php if($_SESSION['rol'] === 'usuario') {?>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="rutinas.php">Rutinas</a>
                                </nav>
                            </div>
                            <?php } ?>


                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Accediste como:</div>
                        <?php 
                            
                                if ($_SESSION['rol'] === 'admin') {
                                    echo 'Admin';
                                } else {
                                    echo 'Usuario';
                                }
                            ?>
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="m-4">Dashboard</h1>

                        <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $_GET['success'] === 'edit' ? 'Usuario actualizado correctamente.' : 'Usuario eliminado correctamente.'; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Ocurrió un error al procesar la solicitud.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>



                    
                    
                        <?php if ($_SESSION['rol'] === 'admin'){require_once '../Components/table.php';}?>
                    
                    </div>
                </main>

            </div>
        </div>


<?php require_once '../Components/footer.php'?>