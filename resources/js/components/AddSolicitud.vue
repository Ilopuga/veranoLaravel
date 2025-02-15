<template>
  <div>
    <h2>{{ isEdit ? 'Modificar Solicitud' : 'Añadir Nueva Solicitud' }}</h2>

    <!-- Formulario para agregar/modificar una solicitud -->
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

      <button type="submit">{{ isEdit ? 'Modificar Solicitud' : 'Agregar Solicitud' }}</button>
    </form>

    <!-- Mensajes de éxito o error -->
    <div v-if="mensaje" :class="mensajeClase">
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
