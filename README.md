# Verdies API
<p align="center"><a href="" target="_blank"><img src="https://res.cloudinary.com/dxtlbsa62/image/upload/v1716879981/Verdies/vkifvb82kknzphziyuws.jpg" width="400" alt="VerdIES Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Estado de la Construcción"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Descargas Totales"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Última Versión Estable"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="Licencia"></a>
</p>

## Acerca de Verdies API

Verdies API es una API backend construida con Laravel 10, utilizando JWT para la autenticación y MySQL como gestor de base de datos. La API proporciona funcionalidades para la autenticación de usuarios, gestión de productos y categorías, así como la gestión de tasas de cambio y monedas equivalentes (Verdcoins).

## Características

- **Autenticación de Usuarios**: Registro, inicio de sesión, cierre de sesión, restablecimiento de contraseña y verificación de correo electrónico.
- **Autenticación con Google**: Autenticación OAuth2 a través de Google.
- **Gestión de Catálogo**: Operaciones CRUD para categorías, productos y tasas de cambio (Verdcoins).
- **Autenticación JWT**: Acceso seguro a rutas protegidas.
- **Base de Datos MySQL**: Gestión de bases de datos robusta y escalable.

## Comenzando

### Requisitos Previos
- PHP 8.0 o superior
- Composer
- MySQL

### Instalación

1. Clona el repositorio:
    ```sh
    git clone https://github.com/juanjose23/verdies-backend-api.git
    cd verdies-backend-api
    ```

2. Instala las dependencias:
    ```sh
    composer install
    ```

3. Copia el archivo `.env.example` a `.env` y configura tus variables de entorno, especialmente los ajustes de la base de datos y las credenciales de Google OAuth:
    ```sh
    cp .env.example .env
    ```
4. Configura las variables de entorno en tu archivo `.env`:
    ```plaintext
    GOOGLE_CLIENT_ID=tu-client-id
    GOOGLE_CLIENT_SECRET=tu-client-secret
    GOOGLE_REDIRECT_URI=dominio.com/api/auth/google/callback

    CLOUDINARY_CLOUD_NAME=tu-cloud-name
    CLOUDINARY_API_KEY=tu-api-key
    CLOUDINARY_API_SECRET=tu-api-secret
    CLOUDINARY_URL=tu-url
    ```
5. Genera la clave de la aplicación:
    ```sh
    php artisan key:generate
    ```

6. Ejecuta las migraciones:
    ```sh
    php artisan migrate
    ```

7. Pobla la base de datos:
    ```sh
    php artisan db:seed
    ```

8. Inicia el servidor de desarrollo local:
    ```sh
    php artisan serve
    ```

### Endpoints de la API

#### Autenticación

- **Autenticación con Google**:
    - `GET /auth/google` - Redirige a Google para autenticación.
    - `GET /auth/google/callback` - Maneja el callback de Google.
  
- **Registro**:
    - `POST /auth/register` - Registra un nuevo usuario.
    - `GET /email/verify/{id}/{hash}` - Verifica la dirección de correo electrónico.

- **Inicio de Sesión**:
    - `POST /auth/login` - Inicia sesión de usuario.
  
- **Restablecimiento de Contraseña**:
    - `POST /auth/password/reset` - Envía enlace de restablecimiento de contraseña.
    - `GET /password/reset/{token}` - Muestra el formulario de restablecimiento de contraseña.
    - `POST /auth/password/reset/process` - Restablece la contraseña.

- **Cierre de Sesión**:
    - `POST /auth/logout` - Cierra la sesión del usuario.

#### Gestión del Catálogo (Rutas Autenticadas)

- **Verdcoins**:
    - `GET /verdcoins` - Lista todos los Verdcoins.
    - `POST /verdcoins` - Crea un nuevo Verdcoin.
    - `GET /verdcoins/{verdcoins}` - Obtiene un Verdcoin específico.
    - `PUT /verdcoins/{verdcoins}` - Actualiza un Verdcoin.
    - `DELETE /verdcoins/{verdcoins}` - Elimina un Verdcoin.

- **Categorías**:
    - `GET /categorias` - Lista todas las categorías.
    - `POST /categorias` - Crea una nueva categoría.
    - `GET /categorias/{categorias}` - Obtiene una categoría específica.
    - `PUT /categorias/{categorias}` - Actualiza una categoría.
    - `DELETE /categorias/{categorias}` - Elimina una categoría.

- **Productos**:
    - `GET /productos` - Lista todos los productos.
    - `POST /productos` - Crea un nuevo producto.
    - `GET /productos/{productos}` - Obtiene un producto específico.
    - `PUT /productos/{productos}` - Actualiza un producto.
    - `DELETE /productos/{productos}` - Elimina un producto.

- **Tasas de Cambio**:
    - `GET /tasa_equivalencia` - Lista todas las tasas de cambio.
    - `POST /tasa_equivalencia` - Crea una nueva tasa de cambio.
    - `GET /tasa_equivalencia/{tasa_equivalencia}` - Obtiene una tasa de cambio específica.
    - `PUT /tasa_equivalencia/{tasa_equivalencia}` - Actualiza una tasa de cambio.
    - `DELETE /tasa_equivalencia/{tasa_equivalencia}` - Elimina una tasa de cambio.

## Contribuir
¡Gracias por considerar contribuir a Verdies API! 

## Vulnerabilidades de Seguridad

Si descubres una vulnerabilidad de seguridad en Verdies API, por favor envía un correo electrónico a los mantenedores del proyecto. Todas las vulnerabilidades de seguridad serán abordadas de inmediato.

## Licencia

Verdies API es un software de código abierto licenciado bajo la [licencia MIT](https://opensource.org/licenses/MIT).
