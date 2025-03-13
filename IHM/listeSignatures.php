<?php 
session_start();
$signatures = isset($_SESSION['signatures']) ? $_SESSION['signatures'] : [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Liste des Signatures</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 to-purple-900 text-white">
  <div class="max-w-7xl mx-auto px-4 py-10">
   
    <h1 class="text-4xl font-extrabold mb-8 text-center drop-shadow-lg">
      Liste des Signatures
    </h1>

    
    <p class="text-center mb-8">
      <a href="../Traitement/petitionTraitement.php"
         class="inline-block text-sm font-medium text-purple-300 hover:text-purple-200 hover:underline transition-colors duration-150">
        ← Retour aux pétitions
      </a>
    </p>

    <?php if (empty($signatures)) : ?>
      <p class="text-center text-gray-300">Aucune signature trouvée pour cette pétition.</p>
    <?php else : ?>
    
      <div class="overflow-x-auto bg-white/10 backdrop-blur-md rounded-2xl shadow-xl ring-1 ring-white/20">
        <table class="w-full table-auto border-collapse">
          <thead>
            <tr class="bg-purple-800/60 text-left">
              <th class="px-4 py-3 font-semibold">ID</th>
              <th class="px-4 py-3 font-semibold">Nom</th>
              <th class="px-4 py-3 font-semibold">Prénom</th>
              <th class="px-4 py-3 font-semibold">Email</th>
              <th class="px-4 py-3 font-semibold">Pays</th>
              <th class="px-4 py-3 font-semibold">Date</th>
              <th class="px-4 py-3 font-semibold">Heure</th>
              <th class="px-4 py-3 font-semibold">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($signatures as $signature) : ?>
              <tr class="border-b border-white/10 hover:bg-white/5 transition-colors">
                <td class="px-4 py-3">
                  <?= htmlspecialchars($signature['IDS']) ?>
                </td>
                <td class="px-4 py-3">
                  <?= htmlspecialchars($signature['Nom']) ?>
                </td>
                <td class="px-4 py-3">
                  <?= htmlspecialchars($signature['Prenom']) ?>
                </td>
                <td class="px-4 py-3">
                  <?= htmlspecialchars($signature['Email']) ?>
                </td>
                <td class="px-4 py-3">
                  <?= htmlspecialchars($signature['Pays']) ?>
                </td>
                <td class="px-4 py-3">
                  <?= htmlspecialchars($signature['Date']) ?>
                </td>
                <td class="px-4 py-3">
                  <?= htmlspecialchars($signature['Heure']) ?>
                </td>
                <td class="px-4 py-3 space-x-2">
                  <a href="../Traitement/signatureTraitement.php?action=showEditSignatureForm&IDS=<?= $signature['IDS'] ?>"
                     class="text-yellow-400 hover:underline">
                    Modifier
                  </a>
                  <span class="text-gray-500">|</span>
                  <a href="../Traitement/signatureTraitement.php?action=deleteSignature&IDS=<?= $signature['IDS'] ?>"
                     onclick="return confirm('Confirmer la suppression de cette signature ?')"
                     class="text-red-500 hover:underline">
                    Supprimer
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
