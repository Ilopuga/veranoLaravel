<template>
    <div class="max-w-4xl mx-auto p-6">
        <!-- Título -->
        <h1 class="text-3xl text-white bg-green-800 p-4 rounded-lg mb-6 text-center">
            Listado de Solicitudes
        </h1>
        
        <!-- Lista de solicitudes -->
        <div class="space-y-4">
            <div v-for="solicitud in solicitudes" :key="solicitud.id" class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <h3 class="text-xl font-semibold text-gray-800">{{ solicitud.nombre }}</h3>
                <p class="text-gray-600 mt-2">DNI: {{ solicitud.dni }}</p>
                <p class="text-gray-600 mt-2">Nombre: {{ solicitud.nombre }}</p>
                <p class="text-gray-600 mt-2">Email: {{ solicitud.email }}</p>
                <p class="text-gray-600 mt-2">Actividad: {{ solicitud.actividad_id }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            solicitudes: []
        };
    },
    mounted() {
        const token = localStorage.getItem('token');
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
                this.solicitudes = data;
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

