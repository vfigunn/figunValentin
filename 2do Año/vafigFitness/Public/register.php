<?php
$pageTitle = "Registrarse";

require_once '../Classes/User.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = new User();

    if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_check']) ){

        $email = $_POST['email'];
        $password = $_POST['password'];
        $pass_check = $_POST['password_check'];

        if($user->createUser($email, $password, $pass_check)){
            header("Location: login.php");
            exit();
        }else{
            header("Location: 404.php");
            exit();
        }


    }else{
        header("Location: /login.php");
            exit();
        }
}



?>

<?php
include_once '../Components/header.php';
?>

<body id="registerBody" class=" vh-100 justify-content-center align-items-center d-flex">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body py-4">
                        <img src="../Assets/images/logo.png" alt="VAFIG Fitness Logo" class="pb-4 img-fluid w-100% rounded">
                    <form action="register.php" method="POST">

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <span class="input-group-text"> 
                                    <i class="bi bi-eye-fill" id="togglePasswordIcon"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_check" class="form-label">Confirmar Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_check" name="password_check" required>
                                <span class="input-group-text"> 
                                    <i class="bi bi-eye-fill" id="togglePasswordCheckIcon"></i>
                                </span>
                            </div>
                        </div>



                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">Registrarme</button>
                        </div>
                    </form>
                </div>    
                <div class="card-footer text-center">
                    <small>¿Ya tienes una cuenta? <a href="login.php" class="text-decoration-none">Inicia sesión aquí</a></small>
                </div>
            </div>
        </div>
</div>

<?php
include_once '../Components/footer.php';
?>