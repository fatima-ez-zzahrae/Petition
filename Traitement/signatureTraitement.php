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
    case "showSignatureForm":
        showSignatureForm();
        break;

    case "ajouterSignature":
        ajouterSignature();
        break;

    case "showEditSignatureForm":
        showEditSignatureForm();
        break;
        
    case "updateSignature":
        updateSignature();
        break;
        
    case "deleteSignature":
        deleteSignature();
        break;
        
    case "getLastSignatures":
        getLastSignatures();
        break;

    default:
       
        header("Location: petitionTraitement.php");
        exit;
}


function showSignatureForm()
{
    $IDP = $_GET['IDP'];
    $petition = PetitionDB::getPetitionById($IDP);

    if (!$petition) {
        echo "Pétition introuvable.";
        exit;
    }
    $_SESSION['current_petition'] = $petition;

    header("Location: ../IHM/signature.php");
    exit;
}


function ajouterSignature()
{
    $IDP    = $_POST['IDP'];
    $nom    = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email  = $_POST['email'];
    $pays   = $_POST['pays'];

    
    $date  = date("Y-m-d");
    $heure = date("H:i:s");

    PetitionDB::addSignature($IDP, $nom, $prenom, $pays, $date, $heure, $email);

   
    header("Location: petitionTraitement.php");
    exit;
}


function showEditSignatureForm()
{
    $IDS = $_GET['IDS'];
    $signature = PetitionDB::getSignatureById($IDS);

    if (!$signature) {
        echo "Signature introuvable.";
        exit;
    }

    $_SESSION['current_signature'] = $signature;
    header("Location: ../IHM/editSignature.php");
    exit;
}


function updateSignature()
{
    $IDS    = $_POST['IDS'];
    $nom    = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email  = $_POST['email'];
    $pays   = $_POST['pays'];

    $date  = date("Y-m-d");
    $heure = date("H:i:s");

    PetitionDB::updateSignature($IDS, $nom, $prenom, $pays, $date, $heure, $email);

    header("Location: petitionTraitement.php");
    exit;
}


function deleteSignature()
{
    $IDS = $_GET['IDS'];
    PetitionDB::deleteSignature($IDS);

    header("Location: petitionTraitement.php");
    exit;
}




function getLastSignatures()
{
    $IDP = $_GET['IDP'];
    $signatures = PetitionDB::getLastSignatures($IDP, 5);

    $output = "";
    foreach ($signatures as $sig) {
        $output .= $sig['Nom']." ".$sig['Prenom']." (".$sig['Date']." ".$sig['Heure'].")\n";
    }

    echo $output;
    exit;
}
