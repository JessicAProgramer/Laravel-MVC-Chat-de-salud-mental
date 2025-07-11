# Laravel-MVC-Chat-de-salud-mental
# Laravel-MVC-Chat-de-salud-mental

Aplicación web desarrollada en Laravel bajo el patrón MVC, diseñada para brindar soporte y chat en temas de salud mental.

## Tabla de Contenidos

- [Características](#características)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Ejecutar el Proyecto](#ejecutar-el-proyecto)
- [Estructura Principal](#estructura-principal)
- [Comandos Útiles](#comandos-útiles)
- [Contribuir](#contribuir)
- [Licencia](#licencia)

---

## Características

- Chat en tiempo real entre usuarios y especialistas.
- Registro y autenticación de usuarios.
- Gestión de perfiles.
- Panel administrativo.
- Seguridad y privacidad de datos.

## Requisitos

- PHP >= 8.1
- Composer
- MySQL/MariaDB/PostgreSQL
- Node.js y npm (opcional, para assets)
- Extensiones PHP requeridas por Laravel

## Instalación

1. **Clona el repositorio:**
   ```bash
   git clone https://github.com/JessicAProgramer/Laravel-MVC-Chat-de-salud-mental.git
   cd Laravel-MVC-Chat-de-salud-mental
   ```

2. **Instala las dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Instala las dependencias de Node (opcional, para assets):**
   ```bash
   npm install
   npm run dev
   ```

## Configuración

1. **Copia el archivo de entorno:**
   ```bash
   cp .env.example .env
   ```

2. **Configura el archivo `.env`** con tus credenciales de base de datos y otras variables. Ejemplo:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=chat_salud_mental
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```

3. **Genera la clave de la aplicación:**
   ```bash
   php artisan key:generate
   ```

4. **Ejecuta las migraciones y seeders (opcional):**
   ```bash
   php artisan migrate --seed
   ```

## Ejecutar el Proyecto

Levanta el servidor de desarrollo con:

```bash
php artisan serve
```

Accede a [http://localhost:8000](http://localhost:8000) en tu navegador.

## Estructura Principal

- `app/`: Lógica de la aplicación (Modelos, Controladores).
- `routes/`: Definición de rutas.
- `resources/views`: Vistas Blade.
- `database/`: Migraciones y seeders.
- `public/`: Assets públicos.

## Comandos Útiles

- **Ver rutas:**  
  `php artisan route:list`
- **Limpiar caché:**  
  `php artisan cache:clear`
- **Ejecutar pruebas:**  
  `php artisan test`
- **Optimizar configuración:**  
  `php artisan config:cache`

## Contribuir

¿Quieres aportar?  
1. Haz un fork del repositorio.
2. Clona tu fork y crea una rama nueva.
3. Realiza tus cambios y abre un Pull Request.

## Licencia

Este proyecto se distribuye bajo la licencia MIT. Consulta el archivo LICENSE para más información.

---

¿Tienes dudas o sugerencias?  
Escribe un issue en el repositorio o contacta a la autora.
