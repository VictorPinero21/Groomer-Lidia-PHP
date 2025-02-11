<?php

class Empleados {

    private $emp_no;
    private $apellido;
    private $oficio;
    private $dir;
    private $fecha_alt;
    private $salario;
    private $comision;
    private $dept_no;
    
    function __construct($emp_no, $apellido, $oficio, $dir, $fecha_alt, $salario, $comision, $dept_no) {
        $this->emp_no = $emp_no;
        $this->apellido = $apellido;
        $this->oficio = $oficio;
        $this->dir = $dir;
        $this->fecha_alt = $fecha_alt;
        $this->salario = $salario;
        $this->comision = $comision;
        $this->dept_no = $dept_no;
    }

    function getEmp_no() {
        return $this->emp_no;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getOficio() {
        return $this->oficio;
    }

    function getDir() {
        return $this->dir;
    }

    function getFecha_alt() {
        return $this->fecha_alt;
    }

    function getSalario() {
        return $this->salario;
    }

    function getComision() {
        return $this->comision;
    }

    function getDept_no() {
        return $this->dept_no;
    }

    function setEmp_no($emp_no): void {
        $this->emp_no = $emp_no;
    }

    function setApellido($apellido): void {
        $this->apellido = $apellido;
    }

    function setOficio($oficio): void {
        $this->oficio = $oficio;
    }

    function setDir($dir): void {
        $this->dir = $dir;
    }

    function setFecha_alt($fecha_alt): void {
        $this->fecha_alt = $fecha_alt;
    }

    function setSalario($salario): void {
        $this->salario = $salario;
    }

    function setComision($comision): void {
        $this->comision = $comision;
    }

    function setDept_no($dept_no): void {
        $this->dept_no = $dept_no;
    }


}
