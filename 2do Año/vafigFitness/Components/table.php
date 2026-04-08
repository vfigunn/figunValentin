
<?php
if (!isset($user)) {
    require_once __DIR__ . '/../Classes/User.php';
    $user = new User();
}

$users = $user->getUsers() ?? [];
$selected = isset($_GET['selected_user']) ? (int)$_GET['selected_user'] : 0;
$routines = [];
if ($selected) {
    $routines = $user->getRutinesByUserId($selected) ?? [];
}
?>


<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Usuarios Registrados
    </div>
    <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>EMAIL</th>
                        <th>ROL</th>
                        <th>ACCIÓN</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>EMAIL</th>
                        <th>ROL</th>
                        <th>ACCIÓN</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($users as $u) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($u->nombre ?? 'Vacío'); ?></td>
                            <td><?php echo htmlspecialchars($u->apellido ?? 'Vacío'); ?></td>
                            <td><?php echo htmlspecialchars($u->email ?? 'Vacío'); ?></td>
                            <td><?php echo htmlspecialchars($u->rol ?? 'Vacío'); ?></td>
                            <td>
                                <a href="../Public/edit_user.php?id=<?php echo (int)$u->id_usuario; ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="../Public/delete_user.php?id=<?php echo (int)$u->id_usuario; ?>" 
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Estás seguro de eliminar este usuario?');">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</div>
<div class="container mb-4">
        <form method="get" class="row g-2 mb-4">
            <div class="col-auto">
                <label for="userSelect" class="col-form-label">Seleccionar usuario</label>
            </div>
            <div class="col-auto">
                <select id="userSelect" name="selected_user" class="form-select">
                    <option value="">-- Selecciona un usuario --</option>
                    <?php foreach ($users as $u): 
                        $label = trim((($u->nombre ?? '') . ' ' . ($u->apellido ?? '')));
                        if ($label === '') $label = ($u->email ?? 'Usuario');
                    ?>
                        <option value="<?php echo (int)$u->id_usuario; ?>" <?php echo ($selected === (int)$u->id_usuario) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($label . ' (' . ($u->email ?? '') . ')'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Ver rutinas</button>
            </div>
            <?php if ($selected): ?>
                <div class="col-12 mt-3">
                    <a href="<?php echo strtok($_SERVER["REQUEST_URI"], '?'); ?>" class="btn btn-link">Limpiar selección</a>
                </div>
            <?php endif; ?>
        </form>

        <?php if ($selected): ?>
            <h6 class="mb-3">Rutinas del usuario seleccionado</h6>
            <?php if (!empty($routines)):
                $dias = [];
                foreach ($routines as $r) {
                    if (is_object($r)) $r = (array)$r;
                    $dia = $r['dia'];
                    $dias[$dia][] = $r;
                }
                foreach ($dias as $dia => $ejerciciosDia): ?>
                    <h5 class="mt-4">Día <?php echo htmlspecialchars($dia); ?></h5>
                    <div class="table-responsive mb-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Grupo Muscular</th>
                                    <th>Ejercicio</th>
                                    <th>Series</th>
                                    <th>Repeticiones</th>
                                    <th>RIR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ejerciciosDia as $r):
                                    $gm = htmlspecialchars($r['grupo_muscular'] ?? $r['grupo'] ?? '');
                                    $ej = htmlspecialchars($r['ejercicio'] ?? $r['nombre'] ?? $r['id_ejercicio'] ?? '');
                                    $series = htmlspecialchars($r['series'] ?? '');
                                    $reps = htmlspecialchars($r['repeticiones'] ?? '');
                                    $rir = htmlspecialchars($r['rir'] ?? '');
                                ?>
                                    <tr>
                                        <td><?php echo $gm; ?></td>
                                        <td><?php echo $ej; ?></td>
                                        <td><?php echo $series; ?></td>
                                        <td><?php echo $reps; ?></td>
                                        <td><?php echo $rir; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info">Este usuario no tiene rutinas.</div>
            <?php endif; ?>
        <?php endif; ?>
</div>