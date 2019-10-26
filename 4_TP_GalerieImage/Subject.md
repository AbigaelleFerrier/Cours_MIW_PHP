================== SUJET ================

# Galerie d'image
Due 11/03, 10:59:00 PM

## TP noté :
Reprendre la base de donnée des pays vue précédemment.
Ajouter une table "gallery" avec : un id (int, primary key, auto increment), 
countrycode (clé étrangère vers la table country), name (varchar 255) et description (text).
Créer un formulaire sur la page d'un pays pour ajouter des photos à sa galerie, le nom du fichier
 uploadé devra correspondre à l'id de gallery en base (exemple : 1.jpg). Les images sources 
 devront être enregistrées dans le dossier upload/src/.

 - Une miniature de 150x150px devra être créée à chaque upload et enregistrée dans le 
dossier upload/thumb/.

 - Sur la page du pays, lister toutes les images uploadées (leur miniature) avec le nom, 
la description et un lien vers l'image source.

 - Utilisez des fonctions pour l'application métier (manipulation d'image, enregistrement en 
base, etc.), ce sera plus simple à débuguer pour vous. Si votre fonction fait plus de
100 lignes, essayer de la réduire ou d'en faire deux.

 - Faites attentions à utiliser des chemins relatifs de non pas absolus dans l'inclusion de fichiers
(include, require), l'enregistrement d'images et leur affichage.
