<?php 
session_start();
$signature = $_SESSION['current_signature'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Modifier la Signature</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 to-purple-900 text-white">
  <div class="max-w-lg mx-auto px-4 py-10">

    <h1 class="text-4xl font-extrabold mb-8 text-center drop-shadow-lg">
      Modifier la Signature
    </h1>

    
    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-xl ring-1 ring-white/20">
      <form action="../Traitement/signatureTraitement.php" method="POST" class="space-y-6">
        <input type="hidden" name="action" value="updateSignature">
        <input type="hidden" name="IDS" value="<?= $signature['IDS'] ?>">

       
        <div>
          <label for="nom" class="block text-sm font-medium mb-1">Nom :</label>
          <input type="text" name="nom" id="nom" required
                 value="<?= htmlspecialchars($signature['Nom']) ?>"
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

       
        <div>
          <label for="prenom" class="block text-sm font-medium mb-1">Prénom :</label>
          <input type="text" name="prenom" id="prenom" required
                 value="<?= htmlspecialchars($signature['Prenom']) ?>"
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

        
        <div>
          <label for="email" class="block text-sm font-medium mb-1">Email :</label>
          <input type="email" name="email" id="email" required
                 value="<?= htmlspecialchars($signature['Email']) ?>"
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

       
        <div class="text-center pt-4">
          <button type="submit"
                  class="bg-gradient-to-r from-purple-700 to-purple-500 hover:from-pink-600 hover:to-purple-600 transition-all duration-200 px-6 py-3 rounded-full font-semibold shadow-lg transform hover:-translate-y-1 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-400">
            Modifier
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
