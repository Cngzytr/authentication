Step 1: 

    docker-compose up -d --build

Step 2: 

    docker exec -it authentication-webapp-1 "bash"

    composer install

    php artisan migrate

    php artisan passport:install

    php artisan db:seed

Step 3:

    docker exec -it authentication-productservice-1 "bash"

    composer install