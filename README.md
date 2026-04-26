# Semana-4

Plugin Personalizado: CPT + ACF + REST API

Crearemos un plugin personalizado que registra un Custom Post Type (CPT) llamado proyecto, lo conecta con un campo ACF, lo expone en la REST API y lo consume desde el frontend con fetch().

PASO 1 — Crear el plugin
Ve a la carpeta de plugins de WordPress:
D:\XAMPP\htdocs\wordpress\wp-content\plugins\
1.	Crea una carpeta llamada mi-plugin-proyectos
2.	Dentro crea el archivo mi-plugin-proyectos.php (incluido en el ZIP adjunto)
El plugin contiene 3 funciones principales:
•	registrar_cpt_proyecto() — Registra el CPT con show_in_rest: true
•	agregar_acf_a_rest_api() — Expone el campo ACF en la REST API
•	registrar_endpoint_proyectos() — Endpoint personalizado que devuelve solo títulos en JSON

PASO 2 — Activar el plugin
4.	Ve al panel: http://localhost/wordpress/wp-admin
5.	Ve a Plugins → Plugins instalados
6.	Busca "Mi Plugin Proyectos" y pulsa Activar
Verás un nuevo menú "Proyectos" en la barra lateral del panel.

PASO 3 — Crear el campo ACF para el CPT
7.	Ve a ACF → Grupos de campos → Añadir nuevo
8.	Nombre del grupo: "Datos del Proyecto"
9.	Pulsa Añadir campo y configura:
•	Etiqueta: Descripción Corta
•	Nombre: descripcion_corta
•	Tipo: Texto
10.	En Reglas de ubicación selecciona: Tipo de entrada = Proyecto
11.	Pulsa Publicar

PASO 4 — Crear proyectos de prueba
12.	Ve a Proyectos → Añadir nuevo en el panel
13.	Añade un título y contenido
14.	Rellena el campo Descripción Corta que aparece debajo del editor
15.	Pulsa Publicar y repite para crear al menos 2-3 proyectos

PASO 5 — Crear la página frontend con fetch
16.	Ve a Páginas → Añadir nueva
17.	Título: "Lista de Proyectos"
18.	Pulsa el botón "+" → busca "HTML personalizado"
19.	Pega el siguiente código HTML+JavaScript:
Código para el bloque HTML personalizado:
<div id="lista-proyectos">Cargando proyectos...</div>
El script hace un fetch a: /wordpress/wp-json/wp/v2/proyecto?_fields=id,title,descripcion_corta
Muestra cada proyecto en una tarjeta con su título y descripción corta.
19.	Pulsa Publicar

PASO 6 — Verificar los endpoints REST API
Abre el navegador y comprueba estas URLs:
Endpoint	Descripción
localhost/wordpress/wp-json/wp/v2/proyecto	Todos los proyectos con campo ACF incluido
localhost/wordpress/wp-json/mi-plugin/v1/titulos-proyectos	Solo títulos en array JSON limpio (reto opcional)

Checklist de verificación:
Plugin creado y activado correctamente
CPT 'proyecto' visible en el panel lateral
Campo ACF 'descripcion_corta' asociado al CPT
CPT expuesto en la REST API (show_in_rest: true)
Al menos 2-3 proyectos publicados con el campo ACF relleno
Página frontend mostrando proyectos via fetch()
Endpoint personalizado /titulos-proyectos devuelve JSON limpio (opcional)
