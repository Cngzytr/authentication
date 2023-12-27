Step 1: 

    cd auth

    composer install

    cd .. | cd productservice

    composer install --ignore-platform-req=ext-mongodb

    cd ..

    docker-compose up -d --build

Step 2: 

    docker exec -it authservice bash

    php artisan migrate

    php artisan passport:install

    ** After passport install you need to password grant client ID, and Client Secret key. Take a note. 

    php artisan db:seed

    ** Now you can use oauth in postman collection with Client ID and Client Secret.
