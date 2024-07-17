## NOTE: The .env should not be included but for test reasons, it is part of the repository.

## RUN
- git clone https://github.com/snrweb/sub_plat
- composer install
- php artisan migrate


- docker-compose down ; docker-compose build ; docker-compose up -d
- php artisan db:seed --class=WebsiteSeeder


## Postman api collection
- https://www.postman.com/oluwatobi09/workspace/subplat/collection/11619123-4d27dbda-a374-40c4-be7c-f4f8250feaa8?action=share&creator=11619123&active-environment=11619123-dbb24efb-6ae9-464c-890f-c386ac7d78ee

- Add subscribers via postman
- Add new posts via postman

## RUN AFTER ADDING A POST VIA POSTMAN
- php artisan queue:work --tries=3 --sleep=3 --memory=2048 --timeout=300