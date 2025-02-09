<template>
    <div>
        <h1 class="bg-red-800 text-white">Listado de solicitudes</h1>
        <!-- Iteramos el array para mostrar los registros -->
        <ul>
            <li v-for="solicitud in solicitudes" :key="solicitud.id">
                {{ solicitud.nombre }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    // Este array está vacío, pero se llenará con los datos de la API
    data() {
        return {
            solicitudes: []
        };
    },
    // Cargamos los datos al montar el componente
    mounted() {
        // Obtenemos el token del localStorage
        const token = localStorage.getItem('token');

        // Si el token existe, lo añadimos a las cabeceras de la solicitud
        if (token) {
            fetch('http://127.0.0.1:8000/api/solicitudes', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('No autorizado o error en la respuesta');
            })
            .then(data => {
                this.solicitudes = data; // Asignamos los datos a 'solicitudes'
            })
            .catch(error => {
                console.error('Error al obtener las solicitudes:', error);
            });
        } else {
            console.log('No se encontró el token de autenticación.');
        }
    }
};
</script>
