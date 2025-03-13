<?php
session_start();
require_once("../BD/PetitionDB.php");

$action = "";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} elseif (isset($_POST['action'])) {
    $action = $_POST['action'];
}

switch($action) {
    case "showFormAddPetition":
        header("Location: ../IHM/newPetition.php");
        exit;

    case "addPetition":
        addPetition();
        break;

    case "showEditPetitionForm":
        showEditPetitionForm();
        break;
        
    case "updatePetition":
        updatePetition();
        break;
        
    case "deletePetition":
        deletePetition();
         break;
    
    case "showSignatures":
        showSignatures();
        break;
    
    case "getTopPetitionAjax":
        getTopPetitionAjax();
        break;
    
    case "checkNewPetition":
        checkNewPetition();
        break;

    default:
        
        listPetitions();
        break;
}


function addPetition()
{
    $titre      = $_POST['titre'];
    $description= $_POST['description'];
    $datePublic = $_POST['datePublic'];
    $dateFinP   = $_POST['dateFinP'];
    $porteurP   = $_POST['porteurP'];
    $email      = $_POST['email'];

    PetitionDB::addPetition($titre, $description, $datePublic, $dateFinP, $porteurP, $email);

    
    listPetitions();
}


function listPetitions()
{
    $petitions = PetitionDB::getAllPetitions();
    $_SESSION['petitions'] = $petitions;
    header("Location: ../IHM/listePetition.php");
    exit;
}



function showEditPetitionForm()
{
    $IDP = $_GET['IDP'];
    $petition = PetitionDB::getPetitionById($IDP);

    if (!$petition) {
        echo "Pétition introuvable.";
        exit;
    }

    $_SESSION['current_petition'] = $petition;
    header("Location: ../IHM/editPetition.php");
    exit;
}


function updatePetition()
{
    $IDP        = $_POST['IDP'];
    $titre      = $_POST['titre'];
    $description= $_POST['description'];
    $datePublic = $_POST['datePublic'];
    $dateFinP   = $_POST['dateFinP'];
    $porteurP   = $_POST['porteurP'];
    $email      = $_POST['email'];

   
    PetitionDB::updatePetition($IDP, $titre, $description, $datePublic, $dateFinP, $porteurP, $email);

    
    listPetitions();
}



function deletePetition()
{
    $IDP = $_GET['IDP'];
    PetitionDB::deletePetition($IDP);

    listPetitions();
}


function showSignatures()
{
    $IDP = $_GET['IDP'];
    $signatures = PetitionDB::getSignaturesByPetition($IDP);
    $_SESSION['signatures'] = $signatures;
    header("Location: ../IHM/listeSignatures.php");
    exit;
}


function getTopPetitionAjax()
{
    $top = PetitionDB::getTopPetition();
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($top);
    exit;
}


function checkNewPetition()
{
    $last = PetitionDB::getLastPetitionInfo();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($last);
    exit;
}