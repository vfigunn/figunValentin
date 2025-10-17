<?php
$pageTitle = "Editar Usuario";

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../Classes/User.php';
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario = $user->getUserById($id); 

    if (!$usuario) {
        header("Location: 404.php");
        exit();
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['user_id']) && !empty($_POST['rol'])) {
        $email = $_POST['email'];
        $id = $_POST['user_id'];
        $rol = $_POST['rol'];

        if ($user->updateUser($id, $email, $rol)) {
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: 404.php");
            exit();
        }
    }
}


?>
<?php require_once '../Components/header.php'?>

<body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand py-1 d-flex justify-content-center" href="dashboard.php" id="logo"><img src="../Assets/images/logo.png" alt="Logo" class="d-inline-block align-top rounded" width="50%" height="50" ></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Bienvenido/a <?php echo htmlspecialchars($_SESSION['user_email']); ?><i class="fas fa-user fa-fw ms-3"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
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
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
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
                <?php if($_SESSION['rol']==='admin'){?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="m-4">Editar Usuario</h1>
                    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-user-edit me-1"></i>
                                Editar Usuario
                            </div>
                            <div class="card-body">
                                <form action="edit_user.php" method="POST">
                                    <div class="mb-3">
                                        <label hidden for="user_id" class="form-label">ID de Usuario</label>
                                        <input hidden type="text" class="form-control" id="user_id" name="user_id" value="<?php echo htmlspecialchars($_GET['id']); ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario->email ?? ''); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="rol" class="form-label">Rol</label>
                                        <select class="form-select" id="rol" name="rol" required>
                                            <option value="usuario" <?php echo (isset($usuario) && $usuario->rol === 'usuario') ? 'selected' : ''; ?>>Usuario</option>
                                            <option value="admin" <?php echo (isset($usuario) && $usuario->rol === 'admin') ? 'selected' : ''; ?>>Admin</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                                </form>
                            </div>

                    
                    </div>
                </main>
                <?php }else{?>
                    <main>
                        <div class="container-fluid px-4">
                            <h1 class="m-4">Acceso Denegado</h1>
                            <div class="alert alert-danger" role="alert">
                                No tienes permisos para acceder a esta página.
                            </div>
                        </div>
                    </main>
                <?php }?>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


<?php require_once '../Components/footer.php'?>