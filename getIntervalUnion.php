<?php
  // La fonction ci-dessous fait une union des intervalles passés en paramètre
  
function foo($intervalles) {
  // Vérifier si le paramètre est un tableau
  if (!is_array($intervalles)) {
    throw new InvalidArgumentException("Le paramètre doit être un tableau d'intervalles");
  }

  // Trier les intervalles par leur début
  usort($intervalles, function($a, $b) {
    return $a[0] <=> $b[0]; 
  });

  // Fusionner les intervalles adjacents
  $resultat = [];
  $intervalle_courant = $intervalles[0];
  foreach ($intervalles as $intervalle) {
    if ($intervalle[0] <= $intervalle_courant[1]) {
      // Intervalles adjacents, fusionner
      $intervalle_courant[1] = max($intervalle_courant[1], $intervalle[1]);
    } else {
      // Nouvel intervalle
      $resultat[] = $intervalle_courant;
      $intervalle_courant = $intervalle;
    }
  }

  // Ajouter le dernier intervalle
  $resultat[] = $intervalle_courant;

  return $resultat;
}

// Exemples d'utilisation
$intervalles1 = [[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]];
$resultat1 = foo($intervalles1);

$intervalles2 = [[0, 5], [3, 10]];
$resultat2 = foo($intervalles2);

var_dump($resultat1);
var_dump($resultat2);

?>
