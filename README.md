# Backend - API de Prospectos (Laravel)

Esta es la API construida en Laravel que maneja el registro y validación de prospectos. Utiliza SQLite como base de datos por defecto para facilitar el entorno de desarrollo.

## Requisitos Previos
* PHP 8.2 o superior
* Composer
* Extensión de SQLite habilitada en PHP

## Instalación y Configuración

1. **Instalar dependencias de PHP:**
   ```bash
   composer instal
2. **Configurar el entorno:**
Duplica el archivo de configuración de ejemplo y genera la clave de seguridad de la aplicación:

    ```bash
    cp .env.example .env
    php artisan key:generate
2. **Configurar la base de datos**
Verifica que tu archivo .env tenga configurada la conexión a SQLite (Laravel creará el archivo database.sqlite automáticamente si no existe):
    ```bash
    DB_CONNECTION=sqlite
4. Elimina o comenta las líneas de DB_HOST, DB_PORT, DB_DATABASE si existen
Ejecutar las migraciones:
Crea la estructura de la base de datos y la tabla prospects:
    ```bash
    php artisan migrate:fresh
## Ejecución
Inicia el servidor de desarrollo integrado de Laravel:

Bash
php artisan serve
La API estará escuchando peticiones en: http://localhost:8000/api/prospects  
