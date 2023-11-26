#### Juan Diego Ramirez Mogotocoro
### facilpost - prueba admision


## Tecnologias aplicadas
- [Laravel](https://laravel.com/) en el parte del backend con su arquitectura MVC
- [PostgresSQL](https://www.postgresql.org/) en la parte de base de datos
- [Blade](https://laravel.com/docs/10.x/blade) en la parte del frontend

## Funcionalidades
- Consumo del api de tercero: : https://www.themoviedb.org/ - trae la cartelera de peliculas y la pobla en la base de datos local de postgres
- creacion de enpoint de eliminar las peliculas y poder editarlas
- visualizacion de las peliculas en el frontend

## Esquema de la base de datos

![image](https://cdn.discordapp.com/attachments/1130302388159381596/1178308504067518535/image.png?ex=6575ac4f&is=6563374f&hm=3692193aad80644749fc5081898d9e3402e35fc29d28547189df27ce14d203ff&)

## *Ejecucion del proyecto* 🏃

*⚠️Para poder ejecutar este proyecto debes tener previamente instalado PHP - postgresSQL y composer⚠️*
- clonar este repositorio en el directorio de tu eleccion
- abrir la terminal en la ruta  del proyecto y ejecutar ```composer install```
- copiar el archivo .env.example y renombrarlo a .env para las variables de entorno - cambiar los siguientes datos segun tu contexto
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=facilpos
DB_USERNAME=postgres
DB_PASSWORD=123
```
- en tu postgresSQL crear la base de datos que pusistes en *DB_DATABASE* - o ejecuta las siguientes sentecias de sql
```
CREATE DATABASE tu_nombre_DB;
```
- ejecuta el siguiente comando en la terminal para ejecutar las migraciones ```php artisan migrate```
- ejecuta el siguiente comando en la terminal ```php artisan server```
- ingresa a la url mostrada, podras ver ya la interfaz de usuario

*❗El codigo sql de la creacion de las tablas se puede observar en databases.sql❗*

## Ejecucion de los test

- para correr los test debe ejecutar el siguiente comando
```php artisan test```
