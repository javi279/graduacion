<?php
// models/EmpleadoModel.php

class EmpleadoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los empleados
    public function obtenerEmpleados() {
        $stmt = $this->pdo->query('SELECT * FROM empleados');
        return $stmt->fetchAll();
    }

    // Obtener un empleado por ID
    public function obtenerEmpleadoPorId($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM empleados WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Crear un nuevo empleado
    public function crearEmpleado($nombre, $apellido, $email, $password, $rol) {
        $sql = "INSERT INTO empleados (nombre, apellido, email, password, rol) 
                VALUES (:nombre, :apellido, :email, :password, :rol)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'password' => $password,
            'rol' => $rol
        ]);
    }

    // Actualizar empleado
    public function actualizarEmpleado($id, $nombre, $apellido, $email, $rol) {
        $sql = "UPDATE empleados 
                SET nombre = :nombre, apellido = :apellido, email = :email, rol = :rol 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'rol' => $rol
        ]);
    }

    // Eliminar empleado
    public function eliminarEmpleado($id) {
        $stmt = $this->pdo->prepare('DELETE FROM empleados WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    // Obtener todos los empleados con nombre, apellido, correo y rol
    public function obtenerEmpleadosConDetalles() {
        $sql = "SELECT id, nombre, apellido, email, rol FROM empleados";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
