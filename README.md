<h1 align="center">
    Green Gold
</h1>

___

<h5 align="center">Back-End realizado como práctica personal utilizando Laravel tras finalizar el Bootcamp de GeeksHubs. Por José Carlos Núñez. </h5>

<p align="center">
    <a href="#about">About</a> ·
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




