<?php
$pageTitle = "Iniciar Sesión";

require_once __DIR__ . '/../Classes/User.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = new User();

    if(!empty($_POST['email']) && !empty($_POST['password'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        if($user->login($email, $password)){
            header("Location: ./dashboard.php");
            exit();
        }else{
            header("Location: ./login.php");
            exit();
        }


    }else{
        header("Location: ./login.php");
            exit();
        }
}



?>

<?php
require_once __DIR__ . '/../Components/header.php';
?>
<body id="loginBody" class="vh-100 justify-content-center align-items-center d-flex">
    
<div class="container vh-100 justify-content-center align-items-center d-flex">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body py-4">
                    <img src="/vafigFitness/Assets/images/logo.png" alt="VAFIG Fitness Logo" class="pb-4 img-fluid w-100%">
                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>


                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <span class="input-group-text"> 
                                    <i class="bi bi-eye-fill"
                                    id="togglePasswordIcon"></i>
                                </span>
                            </div>
                        </div>

                        
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>¿No tienes una cuenta? <a href="register.php" class="text-decoration-none">Regístrate aquí</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../Components/footer.php';
?>