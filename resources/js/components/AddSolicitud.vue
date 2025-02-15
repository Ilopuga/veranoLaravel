<template>
  <div class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl font-bold text-center mb-6">{{ isEdit ? 'Modificar Solicitud' : 'Añadir Nueva Solicitud' }}</h2>

    <!-- Formulario para agregar/modificar una solicitud -->
    <form @submit.prevent="submitForm" class="bg-white p-6 rounded-lg shadow-md space-y-4">

      <!-- DNI -->
      <div>
        <label for="dni" class="block text-sm font-semibold text-gray-700">DNI</label>
        <input
          type="text"
          v-model="dni"
          id="dni"
          required
          class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
      </div>

      <!-- Nombre -->
      <div>
        <label for="nombre" class="block text-sm font-semibold text-gray-700">Nombre</label>
        <input
          type="text"
          v-model="nombre"
          id="nombre"
          required
          class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
      </div>

      <!-- Correo Electrónico -->
      <div>
        <label for="email" class="block text-sm font-semibold text-gray-700">Correo Electrónico</label>
        <input
          type="email"
          v-model="email"
          id="email"
          required
          class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
      </div>

      <!-- Teléfono -->
      <div>
        <label for="telefono" class="block text-sm font-semibold text-gray-700">Teléfono</label>
        <input
          type="text"
          v-model="telefono"
          id="telefono"
          required
          class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
      </div>

      <!-- Actividad -->
      <div>
        <label for="actividad_id" class="block text-sm font-semibold text-gray-700">Actividad</label>
        <select
          v-model="actividad_id"
          id="actividad_id"
          required
          class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
          <option v-for="actividad in actividades" :key="actividad.id" :value="actividad.id">
            {{ actividad.nombre }}
          </option>
        </select>
      </div>

      <!-- Botón de envío -->
      <button
        type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        {{ isEdit ? 'Modificar Solicitud' : 'Agregar Solicitud' }}
      </button>
    </form>

    <!-- Mensajes de éxito o error -->
    <div v-if="mensaje" :class="['mt-4 text-center p-2', mensajeClase === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800']">
      {{ mensaje }}
    </div>
  </div>
</template>

<script>
export default {
  props: ['id'],  // Prop para recibir el parámetro de ID desde la URL
  data() {
    return {
      dni: '',
      nombre: '',
      email: '',
      telefono: '',
      actividad_id: null,
      actividades: [],
      mensaje: '',
      mensajeClase: '',
      isEdit: false,  // Flag para saber si estamos editando
    };
  },
  created() {
    this.fetchActividades();  // Cargar actividades
    if (this.id) {
      this.isEdit = true;
      this.fetchSolicitud(this.id);  // Si hay ID, cargamos la solicitud para editar
    }
  },
  methods: {
    // Cargar actividades
    async fetchActividades() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/actividades', {
          method: 'GET',
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
          },
        });

        if (response.ok) {
          this.actividades = await response.json();
        } else {
          this.mensaje = 'Error al obtener las actividades';
          this.mensajeClase = 'error';
        }
      } catch (error) {
        this.mensaje = 'Error en la conexión al obtener las actividades';
        this.mensajeClase = 'error';
      }
    },

    // Cargar la solicitud que se va a editar
    async fetchSolicitud(id) {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/solicitudes/${id}`, {
          method: 'GET',
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
          },
        });

        if (response.ok) {
          const solicitud = await response.json();
          this.dni = solicitud.dni;
          this.nombre = solicitud.nombre;
          this.email = solicitud.email;
          this.telefono = solicitud.telefono;
          this.actividad_id = solicitud.actividad_id;
        } else {
          this.mensaje = 'Error al cargar la solicitud';
          this.mensajeClase = 'error';
        }
      } catch (error) {
        this.mensaje = 'Error en la conexión al cargar la solicitud';
        this.mensajeClase = 'error';
      }
    },

    // Enviar el formulario para crear o modificar la solicitud
    async submitForm() {
      const url = this.isEdit
        ? `http://127.0.0.1:8000/api/solicitudes/${this.id}`
        : 'http://127.0.0.1:8000/api/solicitudes';
      const method = this.isEdit ? 'PUT' : 'POST';

      try {
        const response = await fetch(url, {
          method,
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            dni: this.dni,
            nombre: this.nombre,
            email: this.email,
            telefono: this.telefono,
            actividad_id: this.actividad_id,
          }),
        });

        if (response.ok) {
          this.mensaje = this.isEdit ? 'Solicitud modificada con éxito' : 'Solicitud añadida con éxito';
          this.mensajeClase = 'success';
          this.dni = '';
          this.nombre = '';
          this.email = '';
          this.telefono = '';
          this.actividad_id = null;
          this.$router.push({ name: 'solicitudes' });
        } else {
          const data = await response.json();
          this.mensaje = data.message || 'Error al procesar la solicitud';
          this.mensajeClase = 'error';
        }
      } catch (error) {
        this.mensaje = 'Error en la conexión';
        this.mensajeClase = 'error';
      }
    }
  }
};
</script>

<style scoped>
.success {
  color: green;
}

.error {
  color: red;
}
</style>
