Dev deploy:

1. `docker compose build`
   - Builds docker images for the project

2. `docker compose up -d`
   - Starts containers in detached mode (-d flag means in background)

3. `docker compose exec -it php-fpm bash `
   - Connects to php-fpm container in interactive mode

4. `composer install`
   - Installs PHP dependencies from composer.json

5. `php yii migrate/up`
   - Applies all pending database migrations