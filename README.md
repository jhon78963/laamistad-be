<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Microservicio de gestión de usuarios

Se gestionará todo lo referente a la gestión de los usuarios de la ERP

## Comandos caché docker

sudo chown -R www-data:www-data /var/www/html
sudo chown -R $USER:www-data storage
sudo chown -R www-data:www-data storage bootstrap/cache 
sudo chown -R $USER:www-data bootstrap/cache 
sudo chmod -R 775 storage 
sudo chmod -R 775 storage bootstrap/cache 
sudo chmod -R 775 bootstrap/cache
sudo composer dump-autoload
php artisan config:cache
php artisan route:cache
