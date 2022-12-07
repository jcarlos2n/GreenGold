<h1 align="center">
    Green Gold
</h1>

___

<h5 align="center">Back-End realizado como práctica personal utilizando Laravel tras finalizar el Bootcamp de GeeksHubs. Por José Carlos Núñez. </h5>

<p align="center">
    <a href="#About">About</a> ·
    <a href="#Usage">Usage</a> ·
    <a href="#Features">Features</a>
</p>

___

## About

El Back-End que he desarrollado con Laravel, el cual consiste en un E-commerce de venta de productos tropicales, en especial aguacates.<br> 
Compuesto de varios End-points y dinstintas utilidades así como CRUD. Es un trabajo aún incompleto pero al que le estoy dedicando tiempo por que ser algo muy completo.
<p align="center">
<img src="Images/tablas.png" width= 500><br>
<sub> Tablas y relaciones</sub>
</p>

----

## Usage

Debido a que Heroku ha pasado a ser de pago, para utilizarla debes descargar el repositorio e inicializarlo en tu máquina local.

<p><strong>End-Points de Usuario</strong></p>
En primer lugar podemos ver el End-point de register.

<p align="center">
<img src="Images/register.png" width= 500><br>
<sub> Register</sub>
</p>


LogIn, para hacer el login, debemos introducir email y password. El login nos devolverá un token con el que podremos utilizar otros End-Points.
<p align="center">
<img src="Images/login.png" width= 500><br>
<sub> Login</sub>
</p>

LogOut, para hacer efectivo el LogOut, debemos introducir el token devuelto en el Login como Bearer Token.
<p align="center">
<img src="Images/logout.png" width= 500><br>
<sub> LogOut</sub>
</p>

Profile, para obtener los datos de usuario, deberemos introducir el token  devuelto en el Login como Bearer Token.
<p align="center">
<img src="Images/profile.png" width= 500><br>
<sub> Profile</sub>
</p>

<p><strong>End-Points de Administrador</strong></p>
En primer lugar podemos ver el End-point en el que podremos añadir nuevos admin mediante su ID.
<p align="center">
<img src="Images/addsuper.png" width= 500><br>
<sub> Add super admin</sub>
</p>

El siguiente End-point consiste en eliminar un admin mediante su ID.

<p align="center">
<img src="Images/deletesuper.png" width= 500><br>
<sub> Delete super admin</sub>
</p>

Ahora utilizaremos un End-Point de administrador, el cual nos muestra todos los usuarios registrador en nuestra BBDD.

<p align="center">
<img src="Images/getprofiles.png" width= 500><br>
<sub> Perfiles de usuarios</sub>
</p>


----

## Features
Proyecto realizado con las siguientes tencologías:<br>
<p align="center"><img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" > · <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" > · <img src="https://img.shields.io/badge/JWT-000000?style=for-the-badge&logo=JSON%20web%20tokens&logoColor=white" > · <img src="https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=Postman&logoColor=white"> · <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white"></p>





