<template>
    <div>
        <h1>Hola, soy Laravel con Vue</h1>
    </div>
    <ul>
        <li>
            <router-link to="/solicitudes">Listado de solicitudes</router-link>
        </li>
        <li>
            <router-link to="/login">Login</router-link>
        </li>
        <li>
            <router-link to="/registro">Registro</router-link>
        </li>
    </ul>
    <!--Se añade el componente router-view para que Vue pueda renderizar los componentes de las rutas-->
    <router-view></router-view>
</template>
<script>
    export default {};
</script>