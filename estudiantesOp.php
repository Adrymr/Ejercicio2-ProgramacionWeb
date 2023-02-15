<?php

include "estudiantes.php";

session_start();

if(!isset($_SESSION['estudiantes'])){
    $_SESSION['estudiantes'] = [];
}

if (isset($_POST['btn'])){
    if(isset($_POST['txtNombre']) && !empty($_POST['txtNombre']) && isset($_POST['txtCedula']) && !empty($_POST['txtCedula']) && isset($_POST['txtNotaMatematica']) && !empty($_POST['txtNotaMatematica']) && isset($_POST['txtNotaFisica']) && !empty($_POST['txtNotaFisica']) && isset($_POST['txtNotaProgramacion']) && !empty($_POST['txtNotaProgramacion'])){

        $registroEstudiante = new estudiante();
        $registroEstudiante->setNombreEstudiante($_POST['txtNombre']);
        $registroEstudiante->setCedulaEstudiante($_POST['txtCedula']);
        $registroEstudiante->setNotaMatematica($_POST['txtNotaMatematica']);
        $registroEstudiante->setNotaFisica($_POST['txtNotaFisica']);
        $registroEstudiante->setNotaProgramacion($_POST['txtNotaProgramacion']);

        array_push($_SESSION['estudiantes'], $registroEstudiante);

        calcularEstadisticas();

    }else {
        echo "No sirvio un carajo :(";
    }
}

function calcularEstadisticas(){
    //variables 

    $totalNotasMatematica = 0;
    $totalEstudiantesMatematica = 0;
    $promedioMatematica = 0;

    $totalNotasFisica = 0;
    $totalEstudiantesFisica = 0;
    $promedioFisica = 0;

    $totalNotasProgramacion = 0;
    $totalEstudiantesProgramacion = 0;
    $promedioProgramacion = 0;

    $estudiantesAprobadosMatematica = 0;
    $estudiantesAprobadosFisica = 0;
    $estudiantesAprobadosProgramacion = 0;

    $estudiantesAplazadosMatematica = 0;
    $estudiantesAplazadosFisica = 0;
    $estudiantesAplazadosProgramacion = 0;

    $estudiantesAprobados1 = 0;
    $estudiantesAprobados2 = 0;
    $estudiantesAprobados3 = 0;

    $notaMaximaMatematica = 0;
    $notaMaximaFisica = 0;
    $notaMaximaProgramacion = 0;

    $rows = count($_SESSION['estudiantes']); 

    if(isset($_SESSION['estudiantes'])){
        

        for($i=0; $i<$rows; $i++){

            // calculo del promedio de cada materia

            $totalNotasMatematica += $_SESSION['estudiantes'][$i]->getNotaMatematica();
            $totalEstudiantesMatematica++;

            $totalNotasFisica += $_SESSION['estudiantes'][$i]->getNotaFisica();
            $totalEstudiantesFisica++;

            $totalNotasProgramacion += $_SESSION['estudiantes'][$i]->getNotaProgramacion();
            $totalEstudiantesProgramacion++;

            //calculo de estudiantes aprobados y aplazados de cada materia

            if ($_SESSION['estudiantes'][$i]->getNotaMatematica() >=10){
                $estudiantesAprobadosMatematica++;

            }elseif($_SESSION['estudiantes'][$i]->getNotaMatematica() < 10){
                $estudiantesAplazadosMatematica++;
            }   

            if ($_SESSION['estudiantes'][$i]->getNotaFisica() >=10){
                $estudiantesAprobadosFisica++;

            }elseif($_SESSION['estudiantes'][$i]->getNotaFisica() < 10){
                $estudiantesAplazadosFisica++;
            }   

            if ($_SESSION['estudiantes'][$i]->getNotaFisica() >=10){
                $estudiantesAprobadosProgramacion++;

            }elseif($_SESSION['estudiantes'][$i]->getNotaFisica() < 10){
                $estudiantesAplazadosProgramacion++;
            }  

            //calculo de estudiantes que aprobaron 3, 2 0 1 materia

            if ($_SESSION['estudiantes'][$i]->getNotaMatematica() >=10 && $_SESSION['estudiantes'][$i]->getNotaFisica() >=10 && $_SESSION['estudiantes'][$i]->getNotaProgramacion() >=10){
                $estudiantesAprobados3++;

            }elseif($_SESSION['estudiantes'][$i]->getNotaMatematica() >=10 && $_SESSION['estudiantes'][$i]->getNotaFisica() >=10 && $_SESSION['estudiantes'][$i]->getNotaProgramacion() < 10 || $_SESSION['estudiantes'][$i]->getNotaMatematica() >=10 && $_SESSION['estudiantes'][$i]->getNotaProgramacion() >=10 && $_SESSION['estudiantes'][$i]->getNotaFisica() < 10 || $_SESSION['estudiantes'][$i]->getNotaFisica() >=10 && $_SESSION['estudiantes'][$i]->getNotaProgramacion() >=10 && $_SESSION['estudiantes'][$i]->getNotaMatematica() < 10 ) {
                $estudiantesAprobados2++;

            }elseif ($_SESSION['estudiantes'][$i]->getNotaMatematica() >=10 && $_SESSION['estudiantes'][$i]->getNotaFisica() < 10 && $_SESSION['estudiantes'][$i]->getNotaProgramacion() < 10 ||  $_SESSION['estudiantes'][$i]->getNotaFisica() >=10 && $_SESSION['estudiantes'][$i]->getNotaProgramacion() < 10 && $_SESSION['estudiantes'][$i]->getNotaMatematica() < 10 || $_SESSION['estudiantes'][$i]->getNotaProgramacion() >= 10 && $_SESSION['estudiantes'][$i]->getNotaMatematica() < 10 && $_SESSION['estudiantes'][$i]->getNotaFisica() < 10 ) {
                $estudiantesAprobados1++;
            }
        
            //calculo de la nota maxima de cada materia 

            if($_SESSION['estudiantes'][$i]->getNotaMatematica() > $notaMaximaMatematica) {
                $notaMaximaMatematica = $_SESSION['estudiantes'][$i]->getNotaMatematica();
            }

            if($_SESSION['estudiantes'][$i]->getNotaFisica() > $notaMaximaFisica) {
                $notaMaximaFisica= $_SESSION['estudiantes'][$i]->getNotaFisica();
            }

            if($_SESSION['estudiantes'][$i]->getNotaProgramacion() > $notaMaximaProgramacion) {
                $notaMaximaProgramacion = $_SESSION['estudiantes'][$i]->getNotaProgramacion();
            }

        } // cierra ciclo for 

        $promedioMatematica = $totalNotasMatematica / $totalEstudiantesMatematica;
        $promedioFisica = $totalNotasFisica / $totalEstudiantesFisica;
        $promedioProgramacion = $totalNotasProgramacion / $totalEstudiantesProgramacion;

    }// cierra if 

    echo "<h2> Registro de Estudiantes</h2>";

    echo "<div class='div-table'> 
            <table border=1>
                <tr>
                    <th>Nombre</th>
                    <th>Cedula</th>
                    <th>Nota Matematica</th>
                    <th>Nota Fisica</th>
                    <th>Nota Programación</th>
                </tr>";

    for($j=0; $j<$rows; $j++){
        echo "<tr>";
        echo "<td>" . $_SESSION['estudiantes'][$j]->getNombreEstudiante() . "</td>";
        echo "<td>" . $_SESSION['estudiantes'][$j]->getCedulaEstudiante() . "</td>";
        echo "<td>" . $_SESSION['estudiantes'][$j]->getNotaMatematica() . "</td>";
        echo "<td>" . $_SESSION['estudiantes'][$j]->getNotaFisica() . "</td>";
        echo "<td>" . $_SESSION['estudiantes'][$j]->getNotaProgramacion() . "</td>";
        echo "</tr>";
    }

    echo "</table></div>";

    echo "<br><h2>Estadisticas</h2>";

    echo "<h3>Promedio de Materias </h3>";
    echo "<p>Matemática: " . round($promedioMatematica, 2) . "</p>";
    echo "<p>Física: " . round($promedioFisica, 2) . "</p>";
    echo "<p>Programación: " . round($promedioProgramacion, 2) . "</p>";

    echo "<h3>Estudiantes Aprobados y Aplazados</h3>";
    echo "<p>Aprobados Matemática: " . $estudiantesAprobadosMatematica . "</p>";
    echo "<p>Aprobados Física: " . $estudiantesAprobadosFisica . "</p>";
    echo "<p>Aprobados Programación: " . $estudiantesAprobadosProgramacion . "</p>";
    echo "<p>Aplazados Matemática: " . $estudiantesAplazadosMatematica . "</p>";
    echo "<p>Aplazados Física: " . $estudiantesAplazadosFisica . "</p>";
    echo "<p>Aplazados Programación: " . $estudiantesAplazadosProgramacion . "</p>";

    echo "<p>Estudiantes que aprobaron 1 materia: " . $estudiantesAprobados1 . "</p>";
    echo "<p>Estudiantes que aprobaron 2 materias: " . $estudiantesAprobados2 . "</p>";
    echo "<p>Estudiantes que aprobaron 3 materias: " . $estudiantesAprobados3 . "</p>";

    echo "<h3>Nota máxima de Materias</h3>";
    echo "<p>Matematica: " . $notaMaximaMatematica . "</p>";
    echo "<p>Física: ". $notaMaximaFisica . "</p>";
    echo "<p>Programación: ". $notaMaximaProgramacion . "</p>";

    echo "<br><div class= btn-cont><a href='index.html' class='anchor'>Registrar nuevo Estudiante</a></div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros y Estadisticas | Estudiantes</title>
    <link rel="stylesheet" href="http://localhost/ejercicio2/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
</html>