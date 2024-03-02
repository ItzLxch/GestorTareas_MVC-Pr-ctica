# GestorTareas_MVC-Pr-ctica

INSTRUCCIONES DE INSTALACIÓN Y EJECUCIÓN
PRERREQUISITOS
Tener instalado XAMPP con PHP y MySQL.
Acceso a un navegador web.
CONFIGURACIÓN DE XAMPP
Inicie XAMPP y asegúrese de que los módulos Apache y MySQL estén en ejecución.
Abra el Administrador de MySQL (phpMyAdmin) y cree una base de datos que coincida con la configuración de su proyecto.
Importe cualquier archivo .sql proporcionado para configurar la base de datos con las tablas y datos iniciales necesarios.
INSTALACIÓN DE LA APLICACIÓN
Clone o descargue el repositorio de código fuente en su máquina local.
Extraiga los archivos y colóquelos en la carpeta htdocs dentro de su directorio de instalación de XAMPP.
Navegue al directorio donde extrajo los archivos y busque el archivo conexion.php dentro de la carpeta Config.
Abra conexion.php y asegúrese de que los detalles de la base de datos coincidan con su configuración local de MySQL.
EJECUCIÓN DE LA APLICACIÓN
Abra su navegador web y vaya a localhost/nombre_de_su_proyecto.
Regístrese utilizando la interfaz de usuario proporcionada accediendo a localhost/nombre_de_su_proyecto/indexRegistro.php.
Una vez registrado, inicie sesión a través de la página localhost/nombre_de_su_proyecto/indexLogin.php.
Dependiendo de sus credenciales, será dirigido a la interfaz de administrador o cliente.
Como administrador, podrá realizar operaciones CRUD en tareas y acceder a los informes a través de los botones proporcionados.
Como cliente, podrá ver las tareas disponibles y seleccionarlas para actualizar su estado.
ACTUALIZACIÓN DE ESTADO DE TAREAS (CLIENTES)
Seleccione las tareas que desea marcar utilizando los checkboxes proporcionados junto a cada tarea.
Una vez seleccionadas, haga clic en el botón 'Guardar' para actualizar el estado de las tareas seleccionadas.
NOTAS ADICIONALES
Para el uso de los reportes instale el fpdf186
