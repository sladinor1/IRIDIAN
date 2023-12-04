# IRIDIAN
Comandos usados desde la terminal:
Para la instalación: 
Invoke-Expression (New-Object System.Net.WebClient).DownloadString('https://get.scoop.sh') -RunAsAdmi
scoop install symfony-cli
Para crear el proyecto (y las dependencias necesarias): 
composer create-project symfony/skeleton:"7.0.*@dev" IRIDIAN
composer require webapp   
composer require symfony/form  
composer require symfony/orm-pack   
composer require doctrine/dbal   
composer require twig   
composer require symfony/validator
Migraciones:
php bin/console make:migration
php bin/console doctrine:migrations:migrate
Pata iniciar el servidor:
symfony server:start
El url del ejercicio es http://127.0.0.1:8000/messenger
