<?php 
session_start();

$petition = isset($_SESSION['current_petition']) ? $_SESSION['current_petition'] : null;

if (!$petition) {
    echo "Aucune pétition sélectionnée.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Signer la pétition</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 to-purple-900 text-white">
  <div class="max-w-2xl mx-auto px-4 py-10">
   
    <h1 class="text-4xl font-extrabold mb-8 text-center drop-shadow-lg">
      Signer la pétition : <?= htmlspecialchars($petition['Titre']) ?>
    </h1>

   
    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-xl ring-1 ring-white/20">
      <form action="../Traitement/signatureTraitement.php" method="POST" class="space-y-6">
        <input type="hidden" name="action" value="ajouterSignature">
        <input type="hidden" name="IDP" value="<?= $petition['IDP'] ?>">

        
        <div>
          <label for="nom" class="block text-sm font-medium mb-1">Nom :</label>
          <input type="text" id="nom" name="nom" required
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

       
        <div>
          <label for="prenom" class="block text-sm font-medium mb-1">Prénom :</label>
          <input type="text" id="prenom" name="prenom" required
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

       
        <div>
          <label for="email" class="block text-sm font-medium mb-1">Email :</label>
          <input type="email" id="email" name="email" required
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

       
        <div>
          <label for="pays" class="block text-sm font-medium mb-1">Pays :</label>
          <input type="text" id="pays" name="pays" required
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

        
        <div>
          <label class="block text-sm font-medium mb-1">5 dernières signatures :</label>
          <textarea id="lastSignatures" cols="50" rows="5" readonly
                    class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none"></textarea>
        </div>

        
        <div class="text-center pt-4">
          <button type="submit"
                  class="bg-gradient-to-r from-purple-700 to-purple-500 hover:from-pink-600 hover:to-purple-600 transition-all duration-200 px-6 py-3 rounded-full font-semibold shadow-lg transform hover:-translate-y-1 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-400">
            Signer
          </button>
        </div>
      </form>
    </div>
  </div>

  
  <script>
    function loadLastSignatures() {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "../Traitement/signatureTraitement.php?action=getLastSignatures&IDP=<?= $petition['IDP'] ?>", true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          document.getElementById("lastSignatures").value = xhr.responseText;
        }
      };
      xhr.send();
    }
    
    window.onload = loadLastSignatures;
  </script>
</body>
</html>
