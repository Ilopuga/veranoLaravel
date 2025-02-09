<template>
    <div class="container">
        <h1 class="text-center mt-5">Bienvenido a Laravel con Vue</h1>
        
        <!-- Lista de navegación con enlaces a las rutas -->
        <ul class="list-group mt-4">
            <li class="list-group-item">
                <router-link to="/solicitudes">Listado de solicitudes</router-link>
            </li>
            <li class="list-group-item">
                <router-link to="/agregar-solicitud">Agregar nueva solicitud</router-link>
            </li>
            <li class="list-group-item">
                <router-link to="/login">Login</router-link>
            </li>
            <li class="list-group-item">
                <router-link to="/registro">Registro</router-link>
            </li>
        </ul>

        <!-- Aquí se renderizan los componentes según las rutas definidas -->
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "Hola", // El nombre del componente
    };
</script>

<style scoped>
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        font-size: 2rem;
    }

    ul {
        padding-left: 0;
    }

    .list-group-item {
        font-size: 1.1rem;
    }

    .mt-5 {
        margin-top: 3rem;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }
</style>
