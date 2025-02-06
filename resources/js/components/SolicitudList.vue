<template>
    <div>
        <h1 class="bg-red-800 text-white">Listado de solicitudes</h1>
        <!--Iteramos el array para mostrar lso registros -->
        <ul>
            <li v-for="solicitud in solicitudes" :key="solicitud.id">
                {{ solicitud.nombre }}


            </li>
        </ul>
            
    </div>
</template>

<!--Utilizamos la API creada en Laravel para obtener los datos -->
<script>
    export default {
        // Este array está vacio, pero se llenará con los datos de la API
        data() {
            return {
                solicitudes: []
            }
        },
        // Cargamos los datos al montar el componente
        mounted() {
            fetch('api/solicitudes')
                .then(response => response.json())
                .then(data => {
                    this.solicitudes = data
                })
            }
    }
</script>