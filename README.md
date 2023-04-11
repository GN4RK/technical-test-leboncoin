# technical-test-leboncoin
Test technique pour une offre d'emploi chez leboncoin.


# Test technique équipe Import
Pour le test, vous devrez créer un service API, les échanges entre le client et l’API se feront
en JSON avec la norme REST.
L’API donnera la possibilité de créer, modifier, supprimer et récupérer une petite annonce.
Les annonces doivent être liées à une catégorie précise : Emploi, Automobile ou
Immobilier.
- Une annonce doit posséder :
    - un titre
    - un contenu
- Ainsi que deux champs dédiés uniquement à la catégorie Automobile :
    - Marque du véhicule
    - Modèle du véhicule
Dans le cadre du test technique, les marques et les modèles de véhicules sont limités, tout
véhicule non trouvé parmi cette liste doit être refusé par l'API.
Pour l'automobile, les marques et modèles disponibles seront :
- Audi
    - Cabriolet, Q2, Q3, Q5, Q7, Q8, R8, Rs3, Rs4, Rs5, Rs7, S3, S4, S4 Avant, S4 Cabriolet, S5, S7, S8, SQ5, SQ7, Tt, Tts, V8
- BMW
    - M3, M4, M5, M535, M6, M635, Serie 1, Serie 2, Serie 3, Serie 4, Serie 5, Serie 6, Serie 7, Serie 8
- Citroen
    - C1, C15, C2, C25, C25D, C25E, C25TD, C3, C3 Aircross, C3 Picasso, C4, C4 Picasso, C5, C6, C8, Ds3, Ds4, Ds5

Le client devra envoyer uniquement le modèle de voiture. La valeur du modèle doit être libre
de saisie (ne peut pas être contraint par une liste prédéfinie par l'API)
Avec le modèle fourni par le client, il faut trouver le bon modèle parmi la liste même si le
modèle ne correspond pas à 100% à la liste ci-dessus. A vous d'implémenter l'algorithme de
votre choix pour déterminer le bon modèle.
Avec le modèle trouvé, vous associerez la marque du véhicule à l'annonce.
Par exemple, l'API reçoit :
- "rs4 avant", l'annonce devra afficher "Audi" et "Rs4"
- "Gran Turismo Série5", l'annonce devra afficher "BMW" et "Serie 5"
- "ds 3 crossback", l'annonce devra afficher "Citroen" et "Ds3"
- "CrossBack ds 3", l'annonce devra afficher "Citroen" et "Ds3"
Une attention particulière sera apportée sur l’algorithme qui sera implémenté.


# Réalisation technique demandée
- Selon vos connaissances, développer en PHP avec le framework Symfony 5 ou alors avec le langage Golang
- Ne pas utiliser API Platform (PHP)
- Créer un environnement Docker permettant de tester l'application
- Modéliser et créer la base de données (MySQL ou PostgreSQL)
- Créer l'API REST qui permette les opérations sur les annonces
- Créer des tests unitaires pour les principales fonctionnalités (la couverture à 100% n'est pas demandée), les routes, votre algorithme de matching sur le modèle de voiture.
- Rédiger un README.md comportant :
    - Comment lancer l'application
    - Une liste d'exemples de requêtes curl pour tester toutes les routes de l'API.
    - Ce qui vous semble intéressant à dire, à votre convenance.
- Le contenu du test technique devra être fourni via un lien d’un dépôt git (github, gitlab, bitbucket, etc.)


# Endpoints
## AdAuto
| Verb | Endpoint | Description |
| --- | --- | --- |
| POST | /autos | create a new ad for an auto |
| GET | /autos | read ad auto list |
| GET | /autos/{id} | read ad auto details |
| PUT | /autos/{id} | update an ad auto |
| DELETE | /autos/{id} | delete an ad auto |


# Installation

## Clone project
```
git clone https://github.com/GN4RK/technical-test-leboncoin
```

## Install dependencies
```
composer install
```

## Testing with Docker

### Build
```
docker-compose build
```

### Run
```
docker-compose up -d
```

### Database config
```
docker exec -it www_docker_symfony_api bash
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
```

### PHPUnit tests
```
.\vendor\bin\phpunit --coverage-html public/test-coverage
```