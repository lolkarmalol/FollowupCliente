<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <title>Etapa Productiva</title>
    <style>
        #userMenu {
            top: 100%;
            margin-top: 0.5rem;
        }
        .user-status {
            text-align: center; /* Centrar el texto */
            color: #009e00; /* Color verde */
            margin-top: 5px; /* Espacio superior para alineación */
            font-size: 12px; /* Ajustar el tamaño de fuente */
        }
        .vis-item.completed {
            background-color: green;
            color: white;
        }
        .vis-item {
            background-color: #3498db;
            color: white;
        }
        .vis-item.vis-selected {
            background-color: #2ecc71;
        }
        .card {
            width: 300px; /* Ajusta el ancho según tus necesidades */
            height: 300px; /* Ajusta la altura según tus necesidades */
            position: relative; /* Necesario para posicionar el texto en el centro */
        }
        #percentage {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2rem; /* Ajusta el tamaño de la fuente según tus necesidades */
            font-weight: bold;
            color: black; /* Color del porcentaje */
        }
    </style>
</head>
<body class="font-['Arial',sans-serif] bg-white m-0 flex flex-col min-h-screen">
  <header class="bg-white text-[#009e00] px-5 py-2.5 flex flex-col items-center border-t-[5px] border-t-white border-b border-b-[#e0e0e0]">

        <div class="flex justify-between w-full">
            <div class="flex items-center">
                <!-- Logo de SENA en el lado izquierdo -->
                <img class="w-[70px] h-[70px]" src="{{ asset('img/logo-sena.png') }}" alt="Sena Logo ">

                <!-- Espaciado entre los dos bloques -->
                <div class="flex-grow m-2"></div>

                <!-- Logo de Etapa Productiva y texto "Centro de Comercio y Servicios" en el lado derecho -->
                <div class="text-left">
                    <!-- Logo de Etapa Seguimiento -->
                    <a href="{{ route('apprentice.home') }}" class="flex items-center">
                        <img src="{{ asset('img/logo.png') }}" alt="Etapa Seguimiento Logo" class="w-10 h-auto mr-1.5">
                        <div class="flex flex-col text-left">
                            <h2 class="text-[12px] m-0 text-[#009e00]">Etapa</h2>
                            <h2 class="text-[12px] m-0 text-[#009e00]">Productiva</h2>
                        </div>
                    </a>

                    <!-- Texto "Centro de Comercio y Servicios" debajo del logo y el texto de Etapa Productiva -->
                    <h2 class="text-sm mt-2 text-[#009e00]">Centro de Comercio y Servicios</h2>
                </div>
            </div>
            <div class="relative ml-auto flex items-center">
                <!-- Contenedor para la imagen y el ícono de los tres puntos -->
                <div class="relative">
                    <!-- Imagen de usuario -->
                    <p class="text-sm font-bold mr-[16px] bg-[#f5f4f4] p-1 rounded-lg  z-20">{{ auth()->user()->name }} {{ auth()->user()->last_name }}</p>

                    <!-- Botón de los tres puntos encima de la imagen -->
                    <button id="menuButton" class="absolute top-[-4px] right-0 bg-transparent p-1 mr-[-15%]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="black" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5.25a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5.25a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" />
                        </svg>
                    </button>
                </div>
                 {{-- Menu --}}
                 <div id="userMenu" class=" hidden absolute right-4  mt-2 w-64 bg-[#D9D9D9] border border-gray-300 rounded-lg shadow-lg z-20">
                     <div class="p-4">
                         <div class="flex items-center mb-4">
                             <div>
                                 <p class="text-sm font-bold">{{ auth()->user()->name }} {{ auth()->user()->last_name }}</p>
                                 <p class="text-sm mt-2">Aprendiz</p>
                             </div>


                         </div>
                         <ul>
                             <li class="mt-2"><a href="{{ route('apprentice.profile') }}" class="block text-center text-green-600 font-bold bg-white border hover:text-white hover:bg-green-600 border-green-600 rounded-lg py-1">Ver perfil</a></li>

                             <li class="mt-2"><a href="{{ route('apprentice.settings') }}" class="block text-black hover:bg-white p-2 rounded-lg">Configuración</a></li>
                         </ul>
                         <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="mt-4">
                             @csrf
                             <button type="submit" class="block text-center text-green-600 font-bold bg-white border hover:text-white hover:bg-green-600 border-green-600 rounded-lg py-2 w-full">Cerrar sesión</button>
                         </form>
                 </div>
             </div>
        </header>
    <nav class="bg-[#009e00] px-2.5 h-14 py-1.5 flex justify-start items-center relative z-10">
        <a href="{{ route('apprentice.notification') }}" id="notifButton" class="absolute right-0">
            <img class="w-[35px] h-auto mr-2.5 filter invert" src="{{ asset('img/notificaciones.png') }}" alt="Notificaciones">
        </a>
        <div class="w-full flex justify-center">
            <ul class="horizontal-list flex space-x-4 justify-center" >
                <li>
                    <a href="{{ route('apprentice.home') }}" class="block text-white text-center bg-transparent px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="{{ route('apprentice.calendar') }}" class="block text-white text-center bg-transparent px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Calendario
                    </a>
                </li>
            </ul>
        </div>

    </nav>
        {{-- FIN Menu --}}

        <div class="w-full flex justify-between items-center mt-6">
            <a href="{{ route('apprentice.home') }}" class="ml-4">
                <img src="{{ asset('img/flecha.png') }}" alt="Flecha" class="w-5 h-auto">
            </a>
        </div>

        <div class="flex justify-center">
            <main class="bg-white m-4 p-6 rounded-lg shadow-lg border border-[#e0e0e0] w-2/3">
                <h1 class="section-header">Configuración</h1>

                <!-- Sección de Cambio de Contraseña -->
                <div class="settings-card">
                    <h2 class="text-lg font-bold mb-4">Cambio de Contraseña</h2>
                    <form action="#" method="#">
                        @csrf
                        <div class="mb-4">
                            <label for="currentPassword" class="block text-sm font-medium text-gray-700">Contraseña Actual</label>
                            <input type="password" id="currentPassword" name="currentPassword" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-500 sm:text-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="newPassword" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
                            <input type="password" id="newPassword" name="newPassword" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-500 sm:text-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirmar Nueva Contraseña</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-500 sm:text-sm" required>
                        </div>
                        <button type="submit" class="bg-[#009e00] text-white px-4 py-2 rounded-md hover:bg-[#37a837]">Actualizar Contraseña</button>
                    </form>
                </div>


            </main>
        </div>

    <!-- Scripts for Dropdowns -->
    <script>
        document.getElementById('menuButton').addEventListener('click', function() {
            document.getElementById('userMenu').classList.toggle('show');
        });

        document.getElementById('notifButton').addEventListener('click', function() {
            document.getElementById('notifMenu').classList.toggle('show');
        });

        // Close dropdowns when clicking outside
        window.onclick = function(event) {
            if (!event.target.closest('#menuButton') && !event.target.closest('#notifButton')) {
                document.getElementById('userMenu').classList.remove('show');
                document.getElementById('notifMenu').classList.remove('show');
            }
        };
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
          // Evento para el toggle del menú 2
          document.getElementById('toggleMenu2').addEventListener('click', function() {
              console.log('toggleMenu2 clicked'); // Verificar si se activa el evento
              var menu = document.getElementById('menu2');
              menu.classList.toggle('hidden'); // Alternar la clase 'hidden'
          });

          // Función para alternar sublistas
          function toggleSublist(event) {
              event.preventDefault(); // Evitar el comportamiento por defecto
              var sublist = event.target.nextElementSibling; // Obtener el siguiente elemento
              if (sublist) {
                  sublist.classList.toggle('hidden'); // Alternar la clase 'hidden' de la sublista
              }
          }

          // Registro del evento para todos los enlaces que necesitan alternar un submenu
          document.querySelectorAll('a[onclick="toggleSublist(event)"]').forEach(function(link) {
              link.addEventListener('click', toggleSublist);
          });
      });
      </script>


    <script src="{{ asset('js/SuperAdmin.js') }}"></script>
</body>
</html>
