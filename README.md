
# Proyecto PHP con Docker

Este proyecto es una aplicación PHP que utiliza Docker para el entorno de desarrollo y manejo de archivos PDF. Asegúrate de seguir las instrucciones a continuación para configurar correctamente el proyecto y poder cargar archivos sin problemas.

## Requisitos

- Docker
- Docker Compose

## Instalación
1. **Construye los contenedores de Docker:**

   Una vez que tengas el proyecto clonado, debes construir los contenedores de Docker con el siguiente comando:

   ```bash
   docker-compose up --build
   ```

2. **Configura los permisos de la carpeta `uploads`:**

   Es necesario establecer permisos adecuados en el directorio `uploads` para que el contenedor de Docker pueda escribir en él. Para hacerlo, ejecuta el siguiente comando dentro del contenedor de Docker:

   ```bash
   docker exec -it php-app bash
   chmod -R 777 /var/www/html/uploads
   ```

   Esto otorgará permisos completos para leer, escribir y ejecutar archivos dentro de la carpeta `uploads` en el contenedor.
3. **Accede a la aplicación:**

   Después de configurar los permisos, puedes acceder a la aplicación en tu navegador en la siguiente URL:

   ```
   http://localhost:8080
   ```

## Estructura del Proyecto

La estructura de carpetas del proyecto es la siguiente:

```
.
├── app
│   ├── config
│   │   └── db.php
│   ├── controllers
│   │   ├── UploadController.php
│   │   └── VentasController.php
│   ├── models
│   │   ├── FileModel.php
│   │   └── Venta.php
│   └── views
│       ├── upload
│       │   ├── index.php
│       └── ventas
│           └── index.php
├── index.php
├── public
│   ├── assets
│   ├── css
│   └── js
└── uploads
```

## Uso

- **Subir Archivos:** Para cargar un archivo PDF, ve a la sección de carga de archivos y selecciona el archivo que deseas cargar.
- **Ver Archivos:** Los archivos cargados se almacenarán en el directorio `uploads` dentro del contenedor de Docker y estarán disponibles para su lectura.

## Problemas comunes

### Error de permisos al subir archivos

Si encuentras un error de permisos al intentar subir archivos, asegúrate de haber ejecutado correctamente el siguiente comando dentro del contenedor Docker:

```bash
chmod -R 777 /var/www/html/uploads
```

Este comando garantiza que el contenedor tiene permisos de escritura sobre el directorio `uploads`.

## Contribución

Si deseas contribuir a este proyecto, por favor sigue estos pasos:

1. Realiza un fork del proyecto.
2. Crea una rama para tu funcionalidad: `git checkout -b feature/nueva-funcionalidad`.
3. Realiza tus cambios y haz commit: `git commit -am 'Añadir nueva funcionalidad'`.
4. Haz push a tu rama: `git push origin feature/nueva-funcionalidad`.
5. Crea un pull request.

## Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.
