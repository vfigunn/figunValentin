<?php
$pageTitle = "Settings";

require_once '../Classes/User.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user = new User();

$dataUsuario = $user->getUserById($user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $genero = $_POST['genero'];
    $fecha_nac = $_POST['fecha_nac'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];

    if ($dataUsuario) {
        $user->updateUserData($user_id, $nombre, $apellido, $genero, $fecha_nac, $peso, $altura);
    } else {
        $user->createUserData($user_id, $nombre, $apellido, $genero, $fecha_nac, $peso, $altura);
    }

    header("Location: settings.php?success=1");
    exit();
}

require_once '../Components/header.php';
?>

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
                        <?php if ($_SESSION['rol'] === 'admin') { ?>
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                        <?php } ?>

                        <?php if ($_SESSION['rol'] === 'usuario') { ?>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                            aria-expanded="false" aria-controls="collapseLayouts">
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
                    <?= $_SESSION['rol'] === 'admin' ? 'Admin' : 'Usuario'; ?>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Configuración del Perfil</h1>
                    <p class="text-muted">Actualizá tus datos personales</p>

                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success">Datos actualizados correctamente.</div>
                    <?php endif; ?>

                    <form method="POST" class="p-4 bg-light rounded shadow-sm">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required
                                    value="<?= htmlspecialchars($dataUsuario->nombre ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Apellido</label>
                                <input type="text" name="apellido" class="form-control" required
                                    value="<?= htmlspecialchars($dataUsuario->apellido ?? '') ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Género</label>
                                <select name="genero" class="form-select" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Masculino" <?= ($dataUsuario->genero ?? '') === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                                    <option value="Femenino" <?= ($dataUsuario->genero ?? '') === 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                                    <option value="Otro" <?= ($dataUsuario->genero ?? '') === 'Otro' ? 'selected' : '' ?>>Otro</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nac" class="form-control" required
                                    value="<?= htmlspecialchars($dataUsuario->fecha_nac ?? '') ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Peso (kg)</label>
                                <input type="number" step="0.01" name="peso" class="form-control"
                                    value="<?= htmlspecialchars($dataUsuario->peso ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Altura (m)</label>
                                <input type="number" step="0.01" name="altura" class="form-control"
                                    value="<?= htmlspecialchars($dataUsuario->altura ?? '') ?>">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php require_once '../Components/footer.php' ?>
</body>
</html>
