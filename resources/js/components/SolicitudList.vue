<template>
    <div class="max-w-4xl mx-auto p-6">
      <h1 class="text-3xl text-white bg-green-800 p-4 rounded-lg mb-6 text-center">
        Listado de Solicitudes
      </h1>
  
      <!-- Lista de solicitudes -->
      <div class="space-y-4">
        <div
          v-for="solicitud in solicitudes"
          :key="solicitud.id"
          class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300"
        >
          <h3 class="text-xl font-semibold text-gray-800">{{ solicitud.nombre }}</h3>
          <p class="text-gray-600 mt-2">DNI: {{ solicitud.dni }}</p>
          <p class="text-gray-600 mt-2">Nombre: {{ solicitud.nombre }}</p>
          <p class="text-gray-600 mt-2">Email: {{ solicitud.email }}</p>
          <p class="text-gray-600 mt-2">
            Actividad: {{ solicitud.actividad_id }}
          </p>
          <p class="text-gray-600 mt-2">
            Telefono: {{ solicitud.telefono }}
          </p>
  
          <!-- Botones de Modificar y Eliminar -->
          <div class="mt-4 flex space-x-4">
            <button
              @click="editSolicitud(solicitud.id)"
              class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >
              Modificar
            </button>
            <button
              @click="openModal(solicitud.id)"
              class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >
              Eliminar
            </button>
          </div>
        </div>
      </div>
  
      <!-- Modal de confirmación -->
      <div v-if="showModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <h3 class="text-lg font-semibold text-gray-700">¿Estás seguro de eliminar esta solicitud?</h3>
          <div class="mt-4 flex justify-end space-x-4">
            <button @click="closeModal" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md">
              Cancelar
            </button>
            <button
              @click="deleteSolicitud(confirmDeleteId)"
              class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md"
            >
              Eliminar
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        solicitudes: [],
        showModal: false, // Controla la visibilidad del modal
        confirmDeleteId: null, // Almacena el ID de la solicitud a eliminar
      };
    },
    mounted() {
      const token = localStorage.getItem("token");
      if (token) {
        fetch("http://127.0.0.1:8000/api/solicitudes", {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
        })
          .then((response) => {
            if (response.ok) {
              return response.json();
            }
            throw new Error("No autorizado o error en la respuesta");
          })
          .then((data) => {
            this.solicitudes = data;
          })
          .catch((error) => {
            console.error("Error al obtener las solicitudes:", error);
          });
      } else {
        console.log("No se encontró el token de autenticación.");
      }
    },
    methods: {
      openModal(id) {
        this.confirmDeleteId = id; // Guarda el ID de la solicitud a eliminar
        this.showModal = true; // Muestra el modal
      },
      closeModal() {
        this.showModal = false; // Cierra el modal
        this.confirmDeleteId = null; // Resetea el ID
      },
      deleteSolicitud(id) {
        const token = localStorage.getItem("token");
        if (token) {
          fetch(`http://127.0.0.1:8000/api/solicitudes/${id}`, {
            method: "DELETE",
            headers: {
              Authorization: `Bearer ${token}`,
            },
          })
            .then((response) => {
              if (response.ok) {
                this.solicitudes = this.solicitudes.filter(
                  (solicitud) => solicitud.id !== id
                );
                alert("Solicitud eliminada correctamente");
                this.closeModal(); // Cierra el modal
              } else {
                throw new Error("Error al eliminar la solicitud");
              }
            })
            .catch((error) => {
              console.error("Error al eliminar la solicitud:", error);
            });
        }
      },
      editSolicitud(id) {
        this.$router.push({ name: "addSolicitud", params: { id } });
      },
    },
  };
  </script>
  