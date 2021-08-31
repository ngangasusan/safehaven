<?php
    session_start();
    require_once "./classloader.inc.php";

    if (isset($_POST['approvedId'])) {
        $dbmanager = new DbManager();
        $table="appointment";
        $columns_string= "approvalStatus=?";
        $condition_string="appointmentId=?";
        $values= ['accepted'];
        $condition_values= array($_POST['approvedId'],);
        return $dbmanager->update($table, $columns_string, $values, $condition_string, $condition_values);
         
    }

    if (isset($_POST['declinedId'])) {
        $dbmanager = new DbManager();
        $table="appointment";
        $columns_string= "approvalStatus=?";
        $condition_string="appointmentId=?";
        $values= ['declined'];
        $condition_values= array($_POST['declinedId'],);
        return $dbmanager->update($table, $columns_string, $values, $condition_string, $condition_values);
    }
    

?>