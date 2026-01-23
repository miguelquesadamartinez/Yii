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
