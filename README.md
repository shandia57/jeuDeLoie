#############################################################################################
####           PROJET TUTORE: Une version revisitée du fameux jeu de l'oie!              ####
#############################################################################################

Chaque joueur doit répondre à des questions dont le niveau de difficulté choisi au préalable lui permet de progresser plus vite sur la grille de jeu en cas de bonne réponse.
Mais attention, c'est à double tranchant car une réponse erronée fera reculer le joueur sur la grille proportionnellement !
Le gagnant sera le premier arrivé sur la 48ème case avant les autres. 


But du projet:

Réaliser un jeu de société multijoueurs en utilisant les technologies:
php, javascript, node.js et socket io.

Participants : 
- Eric HOFFMANN
- Alexandre SCHMITT

lien github : https://github.com/shandia57/jeuDeLoieV2.git

Executer la commande suivante : "composer install" dans le dossier du projet /jeuDeLoieV2/framework/ après avoir cloné le projet.

fichier nécessaire à ne pas oublier dnas le dossier /jeuDeLoieV2/framework/config
- app.conf.php dont voici le code:

<?php

return [
    'database' => [
        'connection' => 'mysql:dbname=jeudeloie;host=localhost',
        'username' => 'mettreLeUserName',
        'password' => 'mettreLeMDP',
        'charset'  => 'UTF-8'
    ]
];


Ensuite, le script SQL se trouve dans le chemin suivant : /jeuDeloieV2/fichiers_utiles/bdd/SQL/


pour se connecter au jeu : 
- en tant qu'ADMIN :
	-> username : admin
	-> MDP : test

- en tant que user: 
	-> username : shandia
	-> MDP: test

/////////////// ATTENTION: un système de cookie est mis en place si l'utilisateur souhaite rester connecté ////////

/////////////////////////////Pour la partie serveur node /////////////////////////////////////////////////////
dans le dossier "/jeuDeLoieV2/framework/public" du projet, faire:

npm install

Pour jouer il faut ouvrir deux terminaux, l'ordre n'a pas d'importance :

un pour le serveur node en tapant node server.js
un pour le framework php avec php -S 127.0.0.1:8000

C'est le game master qui lance la partie sur la homepage en inscrivant les utilisateurs avec leur couleur associée.
Il suffit de cliquer sur le bouton "lancer la partie".

Une page va s'ouvrir :http://framework.local/game?player=GameMaster

Pour créer les sessions des joueurs, il suffit de remplacer "GameMaster" dans l'url par le username du joueur.
Les usernames sont visibles dans le terminal dans l'array: players allowed [ 'shandia', 'testCo', 'jksdfjkfsdh' ] par exemple.

Une fois tous les joueurs inscrits ayant leur session, le jeu commence, le maitre du jeu est en stand by pendant ce temps ainsi que les autres participants.

Quelques remarques:

la ligne 219 du fichier game.js (public/assets/script/modules/game) on peut modifier la variable pour ajouter des points plus rapidement pour tester, cette ligne est commentée.
ligne 474,  on peut acceder à la variable permettant d'accèder à la question unique (en unique exemplaire dans le projet et pour voir la bonne réponse, il faut se rendre sur l'onglet gameMaster, la bonne réponse sera écrite en vert.



si toutefois vous avez des questions, nous sommes disponibles sur discord (shandia-sama#0281) et Eric.H#6646
Sinon par mail : alexandre57450@hotmail.fr/ec.ho@orange.fr
