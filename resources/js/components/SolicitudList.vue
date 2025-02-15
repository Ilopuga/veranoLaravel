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
                <p class="text-gray-600 mt-2">Telefono: {{ solicitud.telefono }}</p>

                <!-- Botones de Modificar y Eliminar -->
                <div class="mt-4 flex space-x-4">
                    <button @click="editSolicitud(solicitud)" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Modificar
                    </button>
                    <button @click="deleteSolicitud(solicitud.id)" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
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
            solicitudes: []  // Array vacío para almacenar las solicitudes
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
    },
    methods: {
        // Método para eliminar una solicitud
        deleteSolicitud(id) {
            const token = localStorage.getItem('token');
            if (token) {
                fetch(`http://127.0.0.1:8000/api/solicitudes/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Eliminar la solicitud del array local
                        this.solicitudes = this.solicitudes.filter(solicitud => solicitud.id !== id);
                        alert('Solicitud eliminada correctamente');
                    } else {
                        throw new Error('Error al eliminar la solicitud');
                    }
                })
                .catch(error => {
                    console.error('Error al eliminar la solicitud:', error);
                });
            }
        },
        
        // Método para modificar una solicitud
        editSolicitud(solicitud) {
            // Aquí puedes redirigir a un formulario de edición o mostrar un modal de edición
            console.log('Editar solicitud', solicitud);
            // Lógica para modificar la solicitud (puedes usar un modal o redirigir a un formulario)
        }
    }
};
</script>
