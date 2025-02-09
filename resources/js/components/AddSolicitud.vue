<template>
  <div>
    <h2>Añadir Nueva Solicitud</h2>

    <!-- Formulario para agregar una nueva solicitud -->
    <form @submit.prevent="submitForm">
      <div>
        <label for="dni">DNI</label>
        <input type="text" v-model="dni" id="dni" required />
      </div>

      <div>
        <label for="nombre">Nombre</label>
        <input type="text" v-model="nombre" id="nombre" required />
      </div>

      <div>
        <label for="email">Correo Electrónico</label>
        <input type="email" v-model="email" id="email" required />
      </div>

      <div>
        <label for="telefono">Teléfono</label>
        <input type="text" v-model="telefono" id="telefono" required />
      </div>

      <div>
        <label for="actividad_id">Actividad</label>
        <select v-model="actividad_id" id="actividad_id" required>
          <option v-for="actividad in actividades" :key="actividad.id" :value="actividad.id">
            {{ actividad.nombre }}
          </option>
        </select>
      </div>

      <div>
        <label for="descripcion">Descripción</label>
        <textarea v-model="descripcion" id="descripcion"></textarea>
      </div>

      <button type="submit">Agregar Solicitud</button>
    </form>

    <!-- Mensajes de éxito o error -->
    <div v-if="mensaje" :class="mensajeClase">
      {{ mensaje }}
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dni: '',
      nombre: '',
      email: '',
      telefono: '',
      actividad_id: null,
      descripcion: '',
      actividades: [],  // Lista de actividades para el dropdown
      mensaje: '',
      mensajeClase: ''
    };
  },
  created() {
    // Obtener las actividades del backend para mostrarlas en el formulario
    this.fetchActividades();
  },
  methods: {
    // Función para obtener las actividades
    async fetchActividades() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/actividades', {
          method: 'GET',
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`, // Usando el token de autenticación
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
    // Función para enviar el formulario
    async submitForm() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/solicitudes', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`, // Usando el token de autenticación
          },
          body: JSON.stringify({
            dni: this.dni,
            nombre: this.nombre,
            email: this.email,
            telefono: this.telefono,
            actividad_id: this.actividad_id,
            descripcion: this.descripcion,
          }),
        });

        if (response.ok) {
          this.mensaje = 'Solicitud añadida con éxito';
          this.mensajeClase = 'success';
          this.dni = ''; // Limpiar el formulario
          this.nombre = '';
          this.email = '';
          this.telefono = '';
          this.actividad_id = null;
          this.descripcion = '';
        } else {
          const data = await response.json();
          this.mensaje = data.message || 'Error al añadir solicitud';
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
