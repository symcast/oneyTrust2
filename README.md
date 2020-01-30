# oneyTrust2


Bonjour,

Afin de mettre en place cette application, il faut

1. Faire un clone du projet 
2. Lancer la commande **docker-compose build**
3. Lancer la commande **docker-compose up -d**

On aura 2 conteneurs dont chacun represente l'environnement d'execution d'une application.

1. **api_container** : un conteneur contenant une api contenant les fonctions developpées pour le calcul de la distance en KM
2. **front_container** : un conteneur danslequel s'execute une application representant le point d'interraction avec l'utilisateur : recuperation des parameteres requis (adresse postale & adresse IP) et consommation de des focntions exposées par un API execute sur un autre conteneur pour afficher le resultat en KM.

Apres le clonage du projet, il faut lancer les commandes suivante :

**[front_container]**
1. **docker exec -it front_container bash** 
2. **cd html/frontSf**
3. **composer install** :  téléchargement des dépendances

**[api_container]**
1. **docker exec -it api_container bash** 
2. **cd html/apisf**
3. **composer install** : téléchargement des dépendances

Enfin, il faut saisir l'URL : **http://localhost:8000/default** dans le navigateur pour executer l'application 

Enjoyyy ........ 
