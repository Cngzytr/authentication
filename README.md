Step 1: 

    docker-compose up -d --build

Step 2: 

    docker exec -it authentication-webapp-1 "bash"

    composer install

    php artisan migrate

    php artisan passport:install

    ** After passport install you need to password grant client ID, and Client Secret key. Take a note. 

    php artisan db:seed

    ** Now you can use oauth in postman collection with Client ID and Client Secret.

Step 3:

    docker exec -it authentication-productservice-1 "bash"

    composer install