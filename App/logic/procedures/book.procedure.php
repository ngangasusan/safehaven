<?php

    session_start();
    require_once "./classloader.inc.php";

    $starts = $_POST["s"];
    $ends = $_POST["e"];
    $date = $_POST["d"];
    $therapist = $_POST["t"];


    $dbmanager = new DbManager();

    $appointMentId = $dbmanager->insert("appointment", ["userId", "therapistId", "startTime", "endTime", "date"], [$_SESSION["userId"], $therapist, $starts, $ends, $date]);

    if($appointMentId == -1){
        exit(Response::SQE());
    }

    exit(Response::make("OK", "Your booking has been saved successfully"));

?>