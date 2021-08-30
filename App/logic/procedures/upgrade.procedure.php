<?php
session_start();
require_once "./classloader.inc.php";
require_once "../classes/utility.class.php";

$dbmanager = new DbManager();

$hospital = "";
$specialty = "";
$status = "pending";

$hospital = $_POST['hospital'];
$specialty = $_POST['specialty'];
$status = $_POST['status'];

if (empty($specialty)) {
    exit(Response::make("SNE", "Specialty Name is required")); //SFE - Specialist Name Error
}
if (empty($hospital)) {
    exit(Response::make("HNE", "Hospital Name is required")); //HNE - Hospital Name Error
}
 
//Get info. of user who is currently logged in
$userInfo = $dbmanager->query(DbManager::USER_TABLE, ["*"], "userId = ?", [$_SESSION['userId']]);
$_SESSION['userId'] = $userId;

//insert their data to therapist table
$updateDetails = $dbmanager->insert(DbManager::THERAPIST_TABLE,["therapistId", "hospital","specialty","`status`"],[$userId, $hospital, $specialty, $status]);

if (!$updateDetails) {
    exit(Response::SQE());
}
exit(Response::make("OK", "Requested for an Upgrade"))
?>