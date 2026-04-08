<?php
$pageTitle = "Rutinas";

require_once '../Classes/User.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['rol'] === 'admin') {
    header("Location: dashboard.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_rutina'])) {
    $dia = $_POST['dia'];
    $series = $_POST['series'];
    $repeticiones = $_POST['repeticiones'];
    $rir = $_POST['rir'];
    $id_ejercicio = $_POST['id_ejercicio'];

    $user = new User();
    $user->createRutine($dia, $series, $repeticiones, $rir, $id_ejercicio, $user_id);
}

$user = new User();
$dataUsuario = $user->getUserById($user_id);
$rutinas = $user->getRutinesByUserId($user_id);
$ejercicios = $user->getAllExercises();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_rutina'])) {
    $id_rutina = $_POST['eliminar_rutina'];
    $user = new User();
    $user->deleteRutine($id_rutina);
    header("Location: rutinas.php"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_rutina'])) {
    $id_rutina = $_POST['id_rutina'];
    $dia = $_POST['dia'];
    $series = $_POST['series'];
    $repeticiones = $_POST['repeticiones'];
    $rir = $_POST['rir'];
    $id_ejercicio = $_POST['id_ejercicio'];

    $user = new User();
    $user->updateRutine($id_rutina, $dia, $series, $repeticiones, $rir, $id_ejercicio);
    header("Location: rutinas.php");
    exit();
}





?>
<?php require_once '../Components/header.php' ?>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand py-1 d-flex justify-content-center" href="dashboard.php" id="logo"><img src="../Assets/images/logo.png" alt="Logo" class="d-inline-block align-top rounded" width="50%" height="50"></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
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
    
        <div id="layoutSidenav" class="container">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">

                            <?php if ($_SESSION['rol'] === 'usuario') { ?>
                                <div class="sb-sidenav-menu-heading">Interface</div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Layouts
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" data-bs-parent="#sidenavAccordion">
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
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="m-4">Rutinas</h1>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarModal">Agregar</button>
                        </div>

                        <?php
                        if (empty($rutinas)) {
                            echo "<p class='text-muted'>Aún no tenés rutinas cargadas.</p>";
                        } else {
                            $dias = [];

                            foreach ($rutinas as $r) {
                                $dias[$r->dia][] = $r;
                            }

                            foreach ($dias as $dia => $ejerciciosDia) {
                                echo "<h2>Día $dia</h2>";
                                echo '<div class="container mb-4"><table class="table table-striped">';
                                echo '<thead><tr><th>Grupo Muscular</th><th>Ejercicio</th><th>Series</th><th>Repeticiones</th><th>RIR</th></tr></thead><tbody>';
                                foreach ($ejerciciosDia as $r) {
                                    echo "<tr>
                                        <td>{$r->grupo_muscular}</td>
                                        <td>{$r->ejercicio}</td>
                                        <td>{$r->series}</td>
                                        <td>{$r->repeticiones}</td>
                                        <td>{$r->rir}</td>
                                        <td>
                                            <button class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#editarModal{$r->id_rutina}'><i class='bi bi-pencil-square'></i></button>
                                            <form method='POST' class='d-inline'>
                                                <input type='hidden' name='eliminar_rutina' value='{$r->id_rutina}'>
                                                <button type='submit' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Eliminar rutina?\")'><i class='bi bi-trash3-fill'></i></button>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                                echo '</tbody></table></div>';
                            }
                        }
                        ?>
                        <?php foreach ($rutinas as $r): ?>
                            <div class="modal fade" id="editarModal<?= $r->id_rutina ?>" tabindex="-1" aria-labelledby="editarModalLabel<?= $r->id_rutina ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editarModalLabel<?= $r->id_rutina ?>">Editar Rutina</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Día</label>
                                                <input type="number" name="dia" class="form-control" min="1" max="7" value="<?= $r->dia ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Ejercicio</label>
                                                <select name="id_ejercicio" class="form-select" required>
                                                    <?php foreach ($ejercicios as $e): ?>
                                                        <option value="<?= $e->id_ejercicio ?>" <?= $e->id_ejercicio == $r->id_ejercicio ? 'selected' : '' ?>>
                                                            <?= htmlspecialchars($e->grupo_muscular . ' - ' . $e->nombre) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>Series</label>
                                                <input type="number" name="series" class="form-control" value="<?= $r->series ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Repeticiones</label>
                                                <input type="number" name="repeticiones" class="form-control" value="<?= $r->repeticiones ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>RIR</label>
                                                <input type="number" name="rir" class="form-control" min="0" max="8" value="<?= $r->rir ?>">
                                            </div>
                                            <input type="hidden" name="id_rutina" value="<?= $r->id_rutina ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="editar_rutina" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </main>

                <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Agregar Rutina</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Día</label>
                                    <input type="number" name="dia" class="form-control" min="1" max="7" required>
                                </div>
                                <div class="mb-3">
                                    <label>Ejercicio</label>
                                    <select name="id_ejercicio" class="form-select" required>
                                        <option value="">Seleccionar...</option>
                                        <?php foreach ($ejercicios as $e): ?>
                                            <option value="<?= $e->id_ejercicio ?>">
                                                <?= htmlspecialchars($e->grupo_muscular . ' - ' . $e->nombre) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Series</label>
                                    <input type="number" name="series" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Repeticiones</label>
                                    <input type="number" name="repeticiones" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>RIR</label>
                                    <input type="number" name="rir" class="form-control" min="0" max="5">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="agregar_rutina" class="btn btn-success">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>


        <?php require_once '../Components/footer.php' ?>