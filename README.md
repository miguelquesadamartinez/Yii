# Sistema de Gestión de Usuarios - Yii Framework 1.1.24

Aplicación completa de gestión de usuarios desarrollada con Yii Framework 1.1.24, incluyendo contenedor Docker para facilitar su despliegue y uso.

## 🚀 Características

- **CRUD Completo de Usuarios**: Crear, leer, actualizar y eliminar usuarios
- **Sistema de Autenticación**: Login/logout con validación de credenciales
- **Control de Acceso**: Protección de rutas con filtros de acceso
- **Validación de Formularios**: Validación del lado del servidor y cliente
- **Interfaz Responsive**: Diseño con Blueprint CSS Framework
- **Base de Datos MySQL**: Gestión de datos persistente
- **Docker**: Contenedores para desarrollo y producción

## 📋 Requisitos

- Docker Desktop instalado
- Docker Compose
- Navegador web moderno

## 🛠️ Instalación

### 1. Clonar el proyecto con Git

```powershell
# Clonar el repositorio
git clone <URL_DEL_REPOSITORIO> Yii
cd Yii

# O si ya tienes el repositorio remoto configurado
git clone https://github.com/tu-usuario/yii-project.git
cd yii-project
```

### 2. Construir y levantar los contenedores

```powershell
docker-compose up -d --build
```

Este comando:

- Descarga e instala Yii Framework 1.1.24
- Configura PHP 7.4 con Apache
- Levanta MySQL 5.7
- Inicializa la base de datos con usuarios de ejemplo
- Configura phpMyAdmin para gestión de BD

### 3. Verificar que los contenedores están corriendo

```powershell
docker-compose ps
```

Deberías ver 3 contenedores activos:

- `yii_web` - Servidor web Apache con PHP
- `yii_db` - Base de datos MySQL
- `yii_phpmyadmin` - Interfaz web para MySQL

### 4. Ejecutar migraciones de base de datos (Opcional)

El proyecto ya inicializa la base de datos automáticamente con `database/init.sql`, pero también cuenta con un sistema de migraciones de Yii. Para ejecutar migraciones:

```powershell
# Acceder al contenedor web
docker exec -it yii_web bash

# Dentro del contenedor, ejecutar migraciones
cd /var/www/html/protected
php yiic.php migrate
```

Las migraciones disponibles están en `protected/migrations/`:

- `m260119_183948_create_users_table.php` - Tabla de usuarios
- `m260119_174541_create_posts_table.php` - Tabla de posts
- `m260119_183949_create_categories_table.php` - Tabla de categorías
- `m260119_190954_create_user_types_table.php` - Tabla de tipos de usuario
- `m260119_184037_add_category_to_posts.php` - Agregar categoría a posts
- `m260119_192827_add_image_to_posts.php` - Agregar imagen a posts
- `m260123_000000_add_slug_to_posts.php` - Agregar slug a posts

## 🌐 Acceso a la Aplicación

### Aplicación Web

- **URL**: http://localhost:8082
- **Usuario admin**: `admin` / `admin123`
- **Usuario demo**: `demo` / `demo123`

### phpMyAdmin (Gestión de Base de Datos)

- **URL**: http://localhost:8083
- **Servidor**: `db`
- **Usuario**: `yii_user`
- **Contraseña**: `yii_password`
- **Usuario root**: `root` / `root_password`

## 📚 Estructura del Proyecto

```
Yii/
├── css/                    # Estilos CSS
│   ├── main.css
│   ├── form.css
│   ├── screen.css
│   └── ...
├── database/               # Scripts SQL
│   └── init.sql           # Inicialización de BD
├── protected/              # Código de la aplicación
│   ├── components/        # Componentes personalizados
│   ├── config/            # Configuración
│   │   ├── main.php      # Config principal
│   │   └── console.php   # Config consola
│   ├── controllers/       # Controladores
│   │   ├── SiteController.php
│   │   └── UserController.php
│   ├── models/            # Modelos
│   │   ├── User.php
│   │   └── LoginForm.php
│   ├── runtime/           # Archivos temporales
│   └── views/             # Vistas
│       ├── layouts/       # Plantillas
│       ├── site/          # Vistas del sitio
│       └── user/          # Vistas de usuarios
├── assets/                # Assets públicos generados
├── framework/             # Framework Yii (auto-descargado)
├── index.php              # Punto de entrada
├── .htaccess              # Configuración Apache
├── Dockerfile             # Configuración Docker
└── docker-compose.yml     # Orquestación de contenedores
```

## 🎯 Funcionalidades Principales

### Gestión de Usuarios

1. **Listar Usuarios** (`/user/index`)
   - Vista en lista de todos los usuarios
   - Paginación automática

2. **Ver Usuario** (`/user/view?id=X`)
   - Detalles completos del usuario
   - Opciones para editar o eliminar

3. **Crear Usuario** (`/user/create`)
   - Formulario de registro
   - Validaciones:
     - Usuario y email únicos
     - Contraseña mínimo 6 caracteres
     - Email válido
     - Confirmación de contraseña

4. **Actualizar Usuario** (`/user/update?id=X`)
   - Edición de datos del usuario
   - Posibilidad de cambiar contraseña (opcional)

5. **Eliminar Usuario** (`/user/delete?id=X`)
   - Eliminación con confirmación
   - Solo vía POST

### Sistema de Autenticación

- Login con username/password
- Sesiones persistentes (Remember Me)
- Logout seguro
- Protección de rutas privadas

## 🔧 Comandos Útiles

### Detener los contenedores

```powershell
docker-compose down
```

### Ver logs de la aplicación

```powershell
docker-compose logs -f web
```

### Ver logs de la base de datos

```powershell
docker-compose logs -f db
```

### Reiniciar contenedores

```powershell
docker-compose restart
```

### Acceder al contenedor web (shell)

```powershell
docker exec -it yii_web bash
```

### Acceder a MySQL desde terminal

```powershell
docker exec -it yii_db mysql -u yii_user -pyii_password yii_users
```

### Crear una nueva migración

```powershell
# Acceder al contenedor
docker exec -it yii_web bash

# Crear migración
cd /var/www/html/protected
php yiic.php migrate create nombre_descriptivo_de_migracion
```

### Ejecutar migraciones

```powershell
# Ver estado de migraciones
docker exec -it yii_web php /var/www/html/protected/yiic.php migrate history

# Aplicar todas las migraciones pendientes
docker exec -it yii_web php /var/www/html/protected/yiic.php migrate

# Aplicar migraciones específicas (ej: 3 migraciones)
docker exec -it yii_web php /var/www/html/protected/yiic.php migrate up 3

# Revertir última migración
docker exec -it yii_web php /var/www/html/protected/yiic.php migrate down

# Revertir migraciones específicas (ej: 2 migraciones)
docker exec -it yii_web php /var/www/html/protected/yiic.php migrate down 2

# Marcar migración como aplicada (sin ejecutar)
docker exec -it yii_web php /var/www/html/protected/yiic.php migrate mark m260123_000000_add_column_example
```

## 🗄️ Base de Datos

### Tabla `users`

| Campo      | Tipo         | Descripción                   |
| ---------- | ------------ | ----------------------------- |
| id         | INT          | ID autoincremental            |
| username   | VARCHAR(128) | Nombre de usuario (único)     |
| password   | VARCHAR(128) | Contraseña hasheada (MD5)     |
| email      | VARCHAR(128) | Email (único)                 |
| first_name | VARCHAR(128) | Nombre                        |
| last_name  | VARCHAR(128) | Apellidos                     |
| status     | TINYINT      | Estado (1=Activo, 0=Inactivo) |
| created_at | DATETIME     | Fecha de creación             |
| updated_at | DATETIME     | Fecha de actualización        |

### Usuarios por Defecto

```
Usuario: admin
Contraseña: admin123
Email: admin@example.com
Tipo: Administrador (user_type_id: 1)

Usuario: demo
Contraseña: demo123
Email: demo@example.com
Tipo: Editor (user_type_id: 2)
```

**Contraseñas hasheadas (MD5):**

- `admin123` → `0192023a7bbd73250516f069df18b500`
- `demo123` → `fe01ce2a7fbac8fafaed7c982a04e229`

### Esquema de Migraciones

El proyecto usa el sistema de migraciones de Yii para gestionar cambios en la base de datos:

1. **Tabla de control**: `migration` - Rastrea qué migraciones se han ejecutado
2. **Directorio**: `protected/migrations/` - Contiene todos los archivos de migración
3. **Nomenclatura**: `mYYMMDD_HHMMSS_descripcion.php` (ej: `m260119_183948_create_users_table.php`)

### Comandos útiles de migración

```powershell
# Ver lista de migraciones disponibles
docker exec -it yii_web php /var/www/html/protected/yiic.php migrate

# Ver historial de migraciones aplicadas
docker exec -it yii_web php /var/www/html/protected/yiic.php migrate history

# Ver migraciones nuevas pendientes
docker exec -it yii_web php /var/www/html/protected/yiic.php migrate new

# Refrescar/recrear base de datos completa
docker exec -it yii_web php /var/www/html/protected/yiic.php migrate fresh
```

## 🔐 Seguridad

- Contraseñas hasheadas con MD5 (para producción usar bcrypt)
- Validación de formularios en servidor y cliente
- Protección CSRF en formularios
- Control de acceso basado en roles
- Prevención de SQL Injection con PDO preparado

## 🐛 Solución de Problemas

### Error de conexión a la base de datos

Espera unos segundos después de `docker-compose up` para que MySQL termine de inicializarse.

### Puerto 8080 ya en uso

Cambia el puerto en `docker-compose.yml`:

```yaml
ports:
  - "8090:80" # Cambia 8080 por otro puerto
```

### Permisos de escritura

Los directorios `assets/` y `protected/runtime/` necesitan permisos de escritura (777), ya están configurados en el Dockerfile.

### Reconstruir contenedores desde cero

```powershell
docker-compose down -v
docker-compose up -d --build
```

## 📝 Desarrollo

### Habilitar modo debug

El modo debug ya está habilitado en [index.php](index.php#L6):

```php
defined('YII_DEBUG') or define('YII_DEBUG',true);
```

### Gii (Generador de Código)

Accede a http://localhost:8080/index.php?r=gii

- **Contraseña**: `admin`

### Agregar más funcionalidades

1. Edita el modelo en `protected/models/User.php`
2. Modifica el controlador en `protected/controllers/UserController.php`
3. Actualiza las vistas en `protected/views/user/`

## 📖 Documentación

- [Yii Framework 1.1 - Guía Definitiva](https://www.yiiframework.com/doc/guide/1.1/es/index)
- [Yii Framework 1.1 - API Reference](https://www.yiiframework.com/doc/api/1.1/)
- [Docker Documentation](https://docs.docker.com/)

## 📄 Licencia

Este proyecto es de código abierto y está disponible bajo la licencia MIT.

---

**¡Disfruta desarrollando con Yii Framework! 🎉**

# URLs Amigables - Implementación Completada

## Cambios Realizados

### 1. Base de Datos

- ✅ Agregado campo `slug` a la tabla `posts`
- ✅ Índice único en el campo `slug`
- ✅ Generados slugs para posts existentes

### 2. Modelo Post

- ✅ Agregado campo `slug` a las reglas de validación
- ✅ Implementado método `generateSlug()` para crear slugs desde títulos
- ✅ Modificado `beforeSave()` para generar slugs automáticamente
- ✅ Soporte para caracteres especiales en español (á, é, í, ó, ú, ñ)
- ✅ Verificación de unicidad (agrega contador si existe duplicado)

### 3. Controlador PostController

- ✅ Actualizado `actionView()` para aceptar slug o id
- ✅ Prioridad al slug sobre el id

### 4. Configuración de Rutas (main.php)

```php
'urlManager'=>array(
    'urlFormat'=>'path',
    'rules'=>array(
        'posts'=>'post/index',
        'post/crear'=>'post/create',
        'post/editar/<id:\d+>'=>'post/update',
        'post/<slug:[a-z0-9\-]+>'=>'post/view',
        // ... más rutas
    ),
),
```

### 5. Vistas Actualizadas

- ✅ `_view.php` - Usa slugs en los enlaces
- ✅ `view.php` - Muestra el campo slug

## Ejemplos de URLs

### Antes:

- `/index.php?r=post/view&id=1`
- `/post/view/id/1`

### Ahora:

- `/post/post-de-pueba`
- `/post/post-dos`
- `/post/mi-nuevo-articulo-sobre-yii`

## Cómo Funciona

1. **Creación de Post**: Al guardar un post, si no tiene slug, se genera automáticamente desde el título
2. **Caracteres Especiales**: Convierte "Título con Ácentos" → "titulo-con-acentos"
3. **Unicidad**: Si existe "post-ejemplo", el siguiente será "post-ejemplo-2"
4. **URLs**: Yii resuelve `/post/slug-del-post` al controlador y acción correcta

## Generación Manual de Slugs

Si necesitas regenerar slugs para posts existentes:

```bash
docker-compose exec web php /var/www/html/update_slugs.php
```

## Patrones de Expresiones Regulares

En las rutas usamos:

- `\d+` - Solo números (para IDs)
- `[a-z0-9\-]+` - Letras minúsculas, números y guiones (para slugs)

## Notas

- Los slugs son únicos en la base de datos
- Se generan automáticamente al crear/editar posts
- El sistema acepta tanto slug como id para compatibilidad
- Los slugs son permanentes y no cambian si se edita el título
