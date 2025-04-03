<!-- LEVANTAR EL CONTENEDOR DEL PROYECTO VINCULADO A CONTENEDOR MYSQL -->
docker run -d -v ${PWD}/src:/var/www/html/ -p 3100:80 --name deportenis --network my_network apirestphp8