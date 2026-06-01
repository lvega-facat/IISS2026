iNCIALIZAR DOCKER
docker compose down
docker compose build --no-cache
docker compose up -d  

ENTRAR A LA TERMINAL DE LARAVEL
docker exec -it laravel_app bash

AL INICIAR EL PROYECTO
php artisan key:generate

MIGRAR DATABASE
php artisan migrate
