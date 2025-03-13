<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Nouvelle Pétition</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 to-purple-900 text-white">
  <div class="max-w-2xl mx-auto px-4 py-10">
   
    <h1 class="text-4xl font-extrabold mb-8 text-center drop-shadow-lg">Créer une nouvelle pétition</h1>

    
    <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-xl p-6 ring-1 ring-white/20">
      <form action="../Traitement/petitionTraitement.php" method="POST" class="space-y-6">
        <input type="hidden" name="action" value="addPetition">

       
        <div>
          <label for="titre" class="block text-sm font-medium mb-1">Titre :</label>
          <input type="text" name="titre" id="titre" required
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400">
        </div>

       
        <div>
          <label for="description" class="block text-sm font-medium mb-1">Description :</label>
          <textarea name="description" id="description" required rows="4"
                    class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400"></textarea>
        </div>

       
        <div>
          <label for="datePublic" class="block text-sm font-medium mb-1">Date de publication :</label>
          <input type="date" name="datePublic" id="datePublic" required
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400">
        </div>

        
        <div>
          <label for="dateFinP" class="block text-sm font-medium mb-1">Date de fin :</label>
          <input type="date" name="dateFinP" id="dateFinP" required
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400">
        </div>

       
        <div>
          <label for="porteurP" class="block text-sm font-medium mb-1">Porteur :</label>
          <input type="text" name="porteurP" id="porteurP" required
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400">
        </div>

        
        <div>
          <label for="email" class="block text-sm font-medium mb-1">Email :</label>
          <input type="email" name="email" id="email" required
                 class="w-full p-3 rounded-md bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-400">
        </div>

        
        <div class="text-center">
          <button type="submit"
                  class="bg-gradient-to-r from-purple-700 to-purple-500 hover:from-pink-600 hover:to-purple-600 transition-all duration-200 px-6 py-3 rounded-full font-semibold shadow-lg transform hover:-translate-y-1 hover:scale-105 focus:ring-2 focus:ring-purple-400">
            Créer
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
