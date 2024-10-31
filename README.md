Dans ce README, vous trouverez les différentes étapes pour lancer l'application ainsi que les problèmes que j'ai rencontrés.

Étape 1 : Lancer Docker
Ouvrez un terminal dans VS Code.
Exécutez la commande suivante :

docker-compose up --build

Étape 2 : Créer le schema de base uniquement que la base de donnée est OK

php bin/console doctrine:schema:update

Etape 3 : Charger des films 

php bin/console doctrine:fixtures:load

Etape 4: accèder à l'API

http://localhost:8080/api

Une fois cela effectué, les films seront récupérés et enregistrés dans la base de données.

Étape 4 : Manipuler avec Postman
Pour effectuer des opérations CRUD, utilisez Postman :

Cliquez sur NEW et sélectionnez HTTP.

Choisissez la commande que vous souhaitez effectuer :
FIND : http://localhost:8080/api/movies
POST : http://localhost:8002/api/films
GET : http://localhost:8002/api/films/{id}
PUT : http://localhost:8002/api/films/{id}
DELETE : http://localhost:8002/api/films/{id}
Normalement, Symfony devrait être lancé sur le port 8002. Si vous rencontrez des problèmes, vérifiez le port de Symfony et modifiez l'URL en conséquence.
        ----------------------------------------------------------------------------------------------------------------------------------------------

        
Problèmes rencontrés
La première difficulté que j'ai rencontrée lors de la création de ce projet a été d'interagir avec la base de données pour créer une table. À chaque tentative, on me disait que je n'avais pas les droits nécessaires. Après plusieurs recherches sur Google, j'ai compris que j'avais fait une erreur lors de la création de la base de données. J'ai donc décidé de supprimer le projet et de recommencer à zéro.

En commençant le deuxième projet, j'ai à nouveau rencontré un problème avec la base de données. L'URL n'était pas correcte. Après quelques recherches, j'ai modifié l'URL de "db" à "127.0.0.1", et cela a fonctionné. J'ai avancé dans le projet jusqu'à ce que je rencontre un problème avec Postman : la méthode GET fonctionnait, mais le POST n'acceptait pas le format JSON, mais plutôt le format JSON-LD. Après avoir effectué des recherches, j'ai trouvé des conseils sur la manière de corriger cela. J'ai modifié plusieurs fichiers, mais à la fin, rien ne fonctionnait. J'ai passé toute la soirée à essayer de résoudre le problème, sans succès. J'ai donc décidé de dormir et de revenir avec un esprit frais. Malheureusement, en revenant, même Docker ne se lançait plus, ce qui m'a poussé à recommencer le projet depuis le début, car je savais que je perdrais trop de temps.

Lors de ma troisième tentative, j'ai rapidement pris de bonnes habitudes. J'ai créé le projet, tout préparé correctement, et en même temps, j'ai cherché sur Google la solution pour effectuer mes POST en JSON. J'ai finalement trouvé un article indiquant qu'il fallait modifier le fichier api_platform.yaml. Après avoir effectué cette modification et relancé le code, tout a commencé à fonctionner correctement.

C'était un projet très enrichissant. Il m'a permis d'améliorer mes compétences en Docker, que je n'avais pas vraiment utilisées lors de mes expériences précédentes, et d'approfondir mes connaissances en termes d'API et de Symfony.

