<template>
    <div class="max-w-4xl mx-auto p-6">
      <!-- Título -->
      <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800">
        Perfil de Usuario
      </h2>
  
      <!-- Si existe el usuario, mostramos sus datos -->
      <div v-if="user" class="bg-white p-6 rounded-lg shadow-md space-y-6">
        <div class="space-y-2">
          <p class="text-lg font-semibold text-gray-700">Nombre</p>
          <p class="text-gray-600">{{ user.name }}</p>
        </div>
  
        <div class="space-y-2">
          <p class="text-lg font-semibold text-gray-700">Correo Electrónico</p>
          <p class="text-gray-600">{{ user.email }}</p>
        </div>
      </div>
  
      <!-- Si no se ha cargado el usuario, mostrar mensaje de carga -->
      <div v-else class="text-center text-gray-600">
        <p>Cargando datos del perfil...</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        user: null, // Datos del usuario
      };
    },
    mounted() {
      // Obtener los datos del usuario al cargar el componente
      fetch('/api/user', {
        method: 'GET',
        headers: {
          // Enviar el token en la cabecera de la petición
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then((response) => response.json())
        .then((data) => {
          this.user = data; // Asignar los datos del usuario
        })
        .catch((error) => {
          console.error('Error al cargar los datos del usuario', error);
        });
    },
  };
  </script>
  
