#### Juan Diego Ramirez Mogotocoro
### facilpost - prueba admision


## Tecnologias aplicadas
- [Laravel](https://laravel.com/) en el parte del backend con su arquitectura MVC
- [PostgresSQL](https://bootcamp.laravel.com) en la parte de base de datos
- [Blade](https://www.postgresql.org/) en la parte del frontend

## Funcionalidades
- Consumo del api de tercero: : https://www.themoviedb.org/ - trae la cartelera de peliculas y la pobla en la base de datos local de postgres
- creacion de enpoint de eliminar las peliculas y poder editarlas
- visualizacion de las peliculas en el frontend

## Esquema de la base de datos

![image](https://)

## *Ejecucion del proyecto* 🏃

*⚠️Para poder ejecutar este proyecto debes tener previamente instalado PHP - postgresSQL y composer⚠️*
- clonar este repositorio en el directorio de tu eleccion
- abrir la terminal en la ruta  del proyecto y ejecutar ```composer install```
- copiar el archivo .env.example y renovarlo .env para las variables de entorno - cambiar los siguientes datos segun tu contexto
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
```
- ejecuta el siguiente comando en la terminal ```php artisan server```
- ingresa a la url mostrada, podras ver ya la interfaz de usuario

## Ejecucion de los test

- para correr los test debe ejecutar el siguiente comando
```php artisan test```
