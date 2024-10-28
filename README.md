## Tests 

Votre test est disponible sur : https://mirado.notion.site/Piou-Agr-gateur-de-flux-RSS-Atom-129198f2bd94801f98c8d9102e8c715c

## Techno

- Tabler / Bootstrap : https://tabler.io
- Laravel 10
- Laminas Feed : https://docs.laminas.dev/laminas-feed/intro/

## Installations

- Cloner le dépot
- Dans le depot, installez les dependences avec : `docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php82-composer:latest composer install --ignore-platform-reqs`
- Créez un fichier `.env` à partir de `.env.example`
- Démarrez les conteneurs avec `./vendor/bin/sail up -d`
- Générez une clé d'application avec `./vendor/bin/sail artisan key:generate`
- Migrez la base de données avec `./vendor/bin/sail migrate`


Vous pouvez continuer à coder ou à tester localement . 

## Développements

En mode développement, n'oubliez pas de suivre les instructions ci-dessous :

- Avant le début de toutes interventions, faites toujours un `git pull` et un `./vendor/bin/sail migrate`
- Avant chaque push , nettoyez le code avec `./vendor/bin/sail pint` et commitez
- Avant chaque push , n'oubliez pas de faire un `git pull` et de corrigez les eventuelles erreurs

## Deploiements


## Des flux tests

- https://blog.laravel.com/feed
- https://korben.info/feed
- https://linuxfr.org/news.atom
- https://feeds.feedburner.com/d0od
