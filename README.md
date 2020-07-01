# Splitfire

Ceci est un microservice permettant d'enregistrer et de lire des tweets; répondant à ce [cachier des charges](https://gist.github.com/splitfire-cs/a02342cc4f6f3192154bde7db7c26e2e).



### Technique

Développé avec [Symfony](https://symfony.com/)
  - Php 7.2
  - MySql 5.7
  - Nginx 1.14

### Installation


Téléchagement des fichiers

```sh
$ composer install
```

Création des tables

```sh
$ php bin/console make:migration
$ php bin/console doctrine:migrations:migrate
```

### Configuration

MySql (fichier .env)

```sh
DATABASE_URL=mysql://splitfire:twitter@127.0.0.1:3306/twitter
```


Nginx : 

```sh
server {
        listen 80 default_server;
        listen [::]:80 default_server;

        root /var/www/splitfire/public/;

        index index.html index.htm index.php index.nginx-debian.html;
        autoindex on;
        autoindex_exact_size off;

        server_name splitfire;

        location / {
                try_files $uri /index.php$is_args$args;
        }

        location ~ ^/index\.php(/|$) {
                fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
                fastcgi_split_path_info ^(.+\.php)(/.*)$;
                include fastcgi_params;
                fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
                fastcgi_param DOCUMENT_ROOT $realpath_root;
                internal;
        }

        location ~ \.php$ {
                return 404;
        }

        access_log /var/log/nginx/splitfire_access.log;
        error_log /var/log/nginx/splitfire_error.log;

}
```



### Test

Ajout tweet

```sh
curl -d '{"author":"loic","message":"test ajout texte et #hashtag ou #multiHash"}' -H "Content-Type: application/json" -X POST http://127.0.0.1/events
```
renvois l'identifiant


Get Tweet

```sh
http://127.0.0.1/events?hashtags[]=tag
```


Paramètres
  - author (String)
  - hashtags (Array)
  - page (Default 1)
  - per_page (Default 25)