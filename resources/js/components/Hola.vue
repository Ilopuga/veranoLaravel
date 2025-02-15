<template>
    <div>
      <!-- Cabecera -->
      <header class="bg-gray-800 text-white py-4">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <!-- quiero que sea enlace el titulo -->
             <a href="/" class="text-2xl font-bold">Verano 2025</a>
          
          <!-- Mostrar Login/Registro si no está logueado, y solicitudes si está logueado -->
          <nav>
            <ul class="flex space-x-4">
              <li v-if="!isAuthenticated">
                <router-link to="/login" class="hover:text-blue-500">Login</router-link>
              </li>
              <li v-if="!isAuthenticated">
                <router-link to="/registro" class="hover:text-blue-500">Registro</router-link>
              </li>
              <li v-if="isAuthenticated">
                <router-link to="/solicitudes" class="hover:text-blue-500">Mis solicitudes</router-link>
              </li>
              <li v-if="isAuthenticated">
                <router-link to="/agregar-solicitud" class="hover:text-blue-500">Añadir Solicitud</router-link>
              </li>
              <li v-if="isAuthenticated">
                <button @click="logout" class="hover:text-blue-500">Cerrar sesión</button>
              </li>
            </ul>
          </nav>
        </div>
      </header>
  
      <!-- Contenido -->
      <div class="max-w-7xl mx-auto p-6">
        <router-view></router-view>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        isAuthenticated: false, // Determina si el usuario está logueado
      };
    },
    created() {
      // Verifica si el usuario está autenticado al cargar la página
      this.checkAuthentication();
    },
    watch: {
      // Si el token cambia, actualizamos la autenticación
      '$route': 'checkAuthentication'
    },
    methods: {
      checkAuthentication() {
        // Verifica si el token existe en localStorage (significa que está logueado)
        const token = localStorage.getItem('token');
        if (token) {
          this.isAuthenticated = true;
        } else {
          this.isAuthenticated = false;
        }
      },
      logout() {
        // Elimina el token del localStorage y redirige al login
        localStorage.removeItem('token');
        this.isAuthenticated = false;
        this.$router.push('/login');
      }
    }
  };
  </script>
  
  <style scoped>
  /* Estilos de la cabecera */
  header {
    background-color: #1a202c;
    color: white;
  }
  
  nav ul {
    display: flex;
    list-style-type: none;
    margin: 0;
    padding: 0;
  }
  
  nav ul li {
    margin-right: 1rem;
  }
  
  nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 1rem;
  }
  
  nav ul li button {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
  }
  </style>
  