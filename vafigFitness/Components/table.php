
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
                <?php
                $users = $user->getUsers();
                
                foreach ($users as $u) {
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($u->nombre ?? 'Vacío'); ?></td>
                        <td><?php echo htmlspecialchars($u->apellido ?? 'Vacío'); ?></td>
                        <td><?php echo htmlspecialchars($u->email); ?></td>
                        <td><?php echo htmlspecialchars($u->rol); ?></td>
                        <td>
                            <a href="../Public/edit_user.php?id=<?php echo $u->id_usuario; ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="../Public/delete_user.php?id=<?php echo $u->id_usuario; ?>" 
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


