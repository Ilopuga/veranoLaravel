<template>
    <div class="max-w-4xl mx-auto p-6">
      <!-- Título -->
      <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800">
        Actividades Ofrecidas
      </h2>
  
      <!-- Texto informativo -->
      <p class="text-lg text-gray-600 text-center mb-6">
        Aquí podrás ver las actividades que ofrecemos. Elige la que más te interese.
      </p>
  
      <!-- Contenedor de actividades -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
  <div
    v-for="actividad in actividades"
    :key="actividad.id"
    class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300"
  >
  <h3 class="text-xl font-bold text-gray-800 text-center">{{ actividad.id }}<span>. </span>{{ actividad.nombre }}</h3>

    <!-- Tema con negrita -->
    <p class="text-gray-600 mt-2">
      <span class="font-bold">Tema:</span> {{ actividad.tema }}
    </p>
    
    <!-- Plazas disponibles con negrita -->
    <p class="text-gray-600 mt-2">
      <span class="font-bold">Plazas disponibles:</span> {{ actividad.plazas }}
    </p>
    
    <!-- Descripción sin negrita -->
    <p class="text-gray-500 mt-2">{{ actividad.descripcion }}</p>
  </div>
</div>

    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        actividades: [], // Array para almacenar las actividades
      };
    },
    mounted() {
      // Obtener actividades al cargar el componente
      this.fetchActividades();
    },
    methods: {
      async fetchActividades() {
        try {
          const response = await fetch("http://127.0.0.1:8000/api/actividades", {
            method: "GET",
          });
  
          if (response.ok) {
            const data = await response.json();
            this.actividades = data;
          } else {
            console.error("Error al obtener actividades");
          }
        } catch (error) {
          console.error("Error en la conexión", error);
        }
      },
    },
  };
  </script>
  