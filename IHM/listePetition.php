<?php
session_start();
$petitions = isset($_SESSION['petitions']) ? $_SESSION['petitions'] : [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Pétitions</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative min-h-screen bg-gradient-to-br from-gray-900 to-purple-900 text-white">
  <div class="max-w-7xl mx-auto px-4 py-8 space-y-10">
   
    <h1 class="text-4xl font-extrabold mb-2 tracking-wide text-center drop-shadow-lg">
      Liste des Pétitions
    </h1>
    <p class="text-center text-purple-300 text-sm italic mb-10">
      Découvrez et soutenez les pétitions en cours
    </p>

   
    <div class="flex justify-center">
      <a href="../Traitement/petitionTraitement.php?action=showFormAddPetition"
         class="inline-block bg-gradient-to-r from-purple-700 to-indigo-600 hover:from-pink-600 hover:to-purple-600 transition-all duration-200 px-6 py-3 rounded-full font-semibold shadow-2xl transform hover:-translate-y-1 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-400">
        Ajouter une nouvelle pétition
      </a>
    </div>

  
    <div class="mx-auto w-full max-w-3xl bg-white/10 backdrop-blur-sm rounded-2xl p-6 shadow-md ring-1 ring-white/20">
      <h2 class="text-2xl font-bold mb-3 text-pink-300 drop-shadow-md">
        Pétition la plus signée
      </h2>
    
      <div id ="topPetitionArea" class="text-lg text-white/90">
    
      </div>
    </div>

    
    <div id="notification" class="text-red-300 font-semibold text-center">
    
    </div>

    
    <div class="overflow-x-auto bg-white/10 backdrop-blur-md rounded-2xl shadow-xl ring-1 ring-white/20">
      <table class="w-full table-auto border-collapse">
        <thead>
          <tr class="bg-gradient-to-r from-purple-800 to-indigo-800 text-left">
            <th class="px-4 py-3 font-semibold">Titre</th>
            <th class="px-4 py-3 font-semibold">Description</th>
            <th class="px-4 py-3 font-semibold">Date de publication</th>
            <th class="px-4 py-3 font-semibold">Date de fin</th>
            <th class="px-4 py-3 font-semibold">Porteur</th>
            <th class="px-4 py-3 font-semibold">Email</th>
            <th class="px-4 py-3 font-semibold">Signatures</th>
            <th class="px-4 py-3 font-semibold">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($petitions as $petition): ?>
            <tr class="border-b border-white/10 hover:bg-white/5 transition-colors duration-150">
              <td class="px-4 py-3">
                <?= htmlspecialchars($petition['Titre']) ?>
              </td>
              <td class="px-4 py-3">
                <?= htmlspecialchars($petition['Description']) ?>
              </td>
              <td class="px-4 py-3">
                <?= htmlspecialchars($petition['DatePublic']) ?>
              </td>
              <td class="px-4 py-3">
                <?= htmlspecialchars($petition['DateFinP']) ?>
              </td>
              <td class="px-4 py-3">
                <?= htmlspecialchars($petition['PorteurP']) ?>
              </td>
              <td class="px-4 py-3">
                <?= htmlspecialchars($petition['Email']) ?>
              </td>
              <td class="px-4 py-3">
                <?= $petition['count_signatures'] ?? 0 ?>
              </td>
              <td class="px-4 py-3 flex flex-wrap gap-2 items-center">
                <a href="../Traitement/signatureTraitement.php?action=showSignatureForm&IDP=<?= $petition['IDP'] ?>"
                   class="inline-block text-sm font-semibold px-3 py-2 rounded-full ring-1 ring-white/20 bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-600 transform transition-all hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                  Signer
                </a>
                <a href="../Traitement/petitionTraitement.php?action=showEditPetitionForm&IDP=<?= $petition['IDP'] ?>"
                   class="inline-block text-sm font-semibold px-3 py-2 rounded-full ring-1 ring-white/20 bg-gradient-to-r from-yellow-500 to-yellow-300 hover:from-yellow-600 hover:to-yellow-400 transform transition-all hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                  Modifier
                </a>
                <a href="../Traitement/petitionTraitement.php?action=deletePetition&IDP=<?= $petition['IDP'] ?>"
                   onclick="return confirm('Confirmer la suppression de cette pétition ?')"
                   class="inline-block text-sm font-semibold px-3 py-2 rounded-full ring-1 ring-white/20 bg-gradient-to-r from-red-500 to-red-400 hover:from-red-600 hover:to-red-500 transform transition-all hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-400">
                  Supprimer
                </a>
                <a href="../Traitement/petitionTraitement.php?action=showSignatures&IDP=<?= $petition['IDP'] ?>"
                   class="inline-block text-sm font-semibold px-3 py-2 rounded-full ring-1 ring-white/20 bg-gradient-to-r from-green-500 to-green-400 hover:from-green-600 hover:to-green-500 transform transition-all hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                  Voir_Signatures
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    

<script>


var lastKnownPetitionID = 0;

setInterval(loadTopPetition, 5000);
setInterval(checkNewPetition, 5000);
 


function loadTopPetition() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../Traitement/petitionTraitement.php?action=getTopPetitionAjax", true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var data = JSON.parse(xhr.responseText);
      if (data) {
        
        document.getElementById('topPetitionArea').innerHTML = 
           "<b>" + data.Titre + "</b> (" + data.nb_signatures + " signatures)";
      }
    }
  };
  xhr.send();
}




function checkNewPetition() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../Traitement/petitionTraitement.php?action=checkNewPetition", true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var data = JSON.parse(xhr.responseText);
     
      if (data && data.IDP) {
        
        if (data.IDP > lastKnownPetitionID) {
          
          document.getElementById('notification').textContent = 
            "Une nouvelle pétition vient d'être ajoutée : " + data.Titre;
          lastKnownPetitionID = data.IDP;
        }
      }
    }
  };
  xhr.send();
}


function initCheckNewPetition() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../Traitement/petitionTraitement.php?action=checkNewPetition", true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var data = JSON.parse(xhr.responseText);
      if (data && data.IDP) {
        lastKnownPetitionID = data.IDP;
      }
    }
  };
  xhr.send();
}


window.onload = function() {
  initCheckNewPetition();
  loadTopPetition(); 
};



</script>
</body>
</html>


