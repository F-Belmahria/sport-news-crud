<?php
// Cette fonction coupe un texte long pour l'affichage dans les cards
function truncateString($text, $limit = 100)
{
   
    // trim() enlève les espaces au début et à la fin
    // strip_tags() enlève les balises HTML
    $text = trim(strip_tags($text));

    // Je vérifie si le texte est déjà plus petit que la limite
    if (strlen($text) <= $limit) {

        // Si le texte est court, je le retourne sans le couper
        return $text;
    }

    // Si le texte est trop long, je le coupe avec substr()
    // Les trois points montrent que le texte continue
    return substr($text, 0, $limit) . '...';
}
?>