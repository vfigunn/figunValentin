<?php
    require '../DB/database.php';

    class User {
        private $pdo;

        public function __construct(){
            $db = new Database();
            $this->pdo = $db->connect();
        }

        public function findByEmail($email) {
            $query = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':email' => $email]);
            return $stmt->fetch();
        }
        public function verifyPassword($inputPassword, $hashedPassword) {
            return password_verify($inputPassword, $hashedPassword);
        }

        public function login($email, $password){
            $user = $this->findByEmail($email);

            if ($user && $this->verifyPassword($password, $user->password)) {

                session_start();
                $_SESSION['user_id'] = $user->id_usuario;
                $_SESSION['user_email'] = $user->email;
                $_SESSION['rol'] = $user->rol;

                return true;
            }else{
                return false;
            }
        }

        public function createUser($email, $password,$pass_check){
            $email_check = $this->findByEmail($email);

            if(!$email_check){
                if($password === $pass_check){
                    $rol = 'usuario';
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $query = "INSERT INTO usuarios (email, password, rol) VALUES (:email, :pass, :rol)";
                    $stmt = $this->pdo->prepare($query);
                    $stmt->execute([
                        ':email' => $email,
                        ':pass' => $hash,
                        ':rol'=> $rol
                    ]);
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function getUsers() {
                $query = "
                            SELECT 
                                u.id_usuario,
                                u.email,
                                u.rol,
                                d.nombre,
                                d.apellido,
                                d.genero,
                                d.fecha_nac,
                                d.peso,
                                d.altura
                            FROM usuarios u
                            INNER JOIN data_usuarios d ON u.id_usuario = d.id_usuario
                            ORDER BY d.nombre, d.apellido
                        ";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll();
            
        }
        public function getUserById($id) {

                $query = "
        SELECT 
            u.email,
            u.rol,
            d.nombre,
            d.apellido,
            d.genero,
            d.fecha_nac,
            d.peso,
            d.altura
        FROM usuarios u
        INNER JOIN data_usuarios d ON u.id_usuario = d.id_usuario
        WHERE u.id_usuario = :id
    ";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([':id' => $id]);
                return $stmt->fetch();
            }
        

    public function updateUser($id, $email, $rol) {

        $query = "UPDATE usuarios SET email = :email, rol = :rol WHERE id_usuario = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':email' => $email,
            ':rol' => $rol,
            ':id' => $id
        ]);

        return true;
    }
    public function deleteUser($id) {
        $query = "DELETE FROM usuarios WHERE id_usuario = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function createRutine($dia, $series, $repeticiones, $rir, $id_ejercicio, $user_id){
        $query = ("INSERT INTO rutina_usuario (dia, series, repeticiones, rir, id_ejercicio, id_usuario)
        VALUES (:dia, :series, :repeticiones, :rir, :id_ejercicio, :user_id)");
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([':dia' => $dia, ':series' => $series, ':repeticiones' => $repeticiones, ':rir' => $rir, ':id_ejercicio' => $id_ejercicio, ':user_id' => $user_id]);
    }

    public function getRutinesByUserId($user_id) {
        $query = "
        SELECT 
            r.id_rutina,r.dia, r.series, r.repeticiones, r.rir,
            e.nombre AS ejercicio, e.grupo_muscular
        FROM rutina_usuario r
        JOIN ejercicios e ON r.id_ejercicio = e.id_ejercicio
        WHERE r.id_usuario = :user_id
        ORDER BY r.dia, e.grupo_muscular;
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll();
}
    public function getAllExercises() {
        $query = "SELECT id_ejercicio, nombre, grupo_muscular FROM ejercicios ORDER BY grupo_muscular, nombre";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }

    public function deleteRutine($id_rutina){
    $query = "DELETE FROM rutina_usuario WHERE id_rutina = :id";
    $stmt = $this->pdo->prepare($query);
    return $stmt->execute([':id' => $id_rutina]);
        }
    public function updateRutine($id_rutina, $dia, $series, $repeticiones, $rir, $id_ejercicio){
    $query = "UPDATE rutina_usuario 
              SET dia = :dia, series = :series, repeticiones = :repeticiones, rir = :rir, id_ejercicio = :id_ejercicio
              WHERE id_rutina = :id_rutina";
    $stmt = $this->pdo->prepare($query);
    return $stmt->execute([
        ':dia' => $dia,
        ':series' => $series,
        ':repeticiones' => $repeticiones,
        ':rir' => $rir,
        ':id_ejercicio' => $id_ejercicio,
        ':id_rutina' => $id_rutina
    ]);
}
    public function updateUserData($id_usuario, $nombre, $apellido, $genero, $fecha_nac, $peso, $altura) {
    $query = "UPDATE data_usuarios SET 
        nombre = :nombre, apellido = :apellido, genero = :genero, fecha_nac = :fecha_nac, peso = :peso, altura = :altura
        WHERE id_usuario = :id_usuario";
    $stmt = $this->pdo->prepare($query);
    return $stmt->execute([
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':genero' => $genero,
        ':fecha_nac' => $fecha_nac,
        ':peso' => $peso,
        ':altura' => $altura,
        ':id_usuario' => $id_usuario
    ]);
}
    public function createUserData($id_usuario, $nombre, $apellido, $genero, $fecha_nac, $peso, $altura) {
    $query = "INSERT INTO data_usuarios 
        (id_usuario, nombre, apellido, genero, fecha_nac, peso, altura)
        VALUES (:id_usuario, :nombre, :apellido, :genero, :fecha_nac, :peso, :altura)";
    $stmt = $this->pdo->prepare($query);
    return $stmt->execute([
        ':id_usuario' => $id_usuario,
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':genero' => $genero,
        ':fecha_nac' => $fecha_nac,
        ':peso' => $peso,
        ':altura' => $altura
    ]);
}

}