<?php
session_start();
$petition = $_SESSION['current_petition'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Modifier la Pétition</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 to-purple-900 text-white">
  <div class="max-w-2xl mx-auto px-4 py-10">
   
    <h1 class="text-4xl font-extrabold mb-8 text-center drop-shadow-lg">
      Modifier la Pétition
    </h1>

   
    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-xl ring-1 ring-white/20">
      <form action="../Traitement/petitionTraitement.php" method="POST" class="space-y-6">
        <input type="hidden" name="action" value="updatePetition">
        <input type="hidden" name="IDP" value="<?= $petition['IDP'] ?>">

     
        <div>
          <label for="titre" class="block text-sm font-medium mb-1">Titre :</label>
          <input type="text" name="titre" id="titre" required
                 value="<?= htmlspecialchars($petition['Titre']) ?>"
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

        
        <div>
          <label for="description" class="block text-sm font-medium mb-1">Description :</label>
          <textarea name="description" id="description" rows="4" required
                    class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400"><?= htmlspecialchars($petition['Description']) ?></textarea>
        </div>

       
        <div>
          <label for="datePublic" class="block text-sm font-medium mb-1">Date de Publication :</label>
          <input type="date" name="datePublic" id="datePublic" required
                 value="<?= htmlspecialchars($petition['DatePublic']) ?>"
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

       
        <div>
          <label for="dateFinP" class="block text-sm font-medium mb-1">Date de Fin :</label>
          <input type="date" name="dateFinP" id="dateFinP" required
                 value="<?= htmlspecialchars($petition['DateFinP']) ?>"
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

       
        <div>
          <label for="porteurP" class="block text-sm font-medium mb-1">Porteur de la Pétition :</label>
          <input type="text" name="porteurP" id="porteurP" required
                 value="<?= htmlspecialchars($petition['PorteurP']) ?>"
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

        
        <div>
          <label for="email" class="block text-sm font-medium mb-1">Email du Porteur :</label>
          <input type="email" name="email" id="email" required
                 value="<?= htmlspecialchars($petition['Email']) ?>"
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

    
    <p class="text-center mt-6">
      <a href="../Traitement/petitionTraitement.php"
         class="inline-block text-sm font-medium text-purple-300 hover:text-purple-200 hover:underline transition-colors duration-150">
        ← Retour à la liste des pétitions
      </a>
    </p>
  </div>
</body>
</html>
