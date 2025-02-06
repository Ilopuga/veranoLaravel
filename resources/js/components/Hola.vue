<template>
    <div>
        <h1>Hola, soy Laravel con Vue</h1>
    </div>
    <ul>
        <li>
            <router-link to="/solicitudes">Listado de solicitudes</router-link>
        </li>
    </ul>
    <router-view></router-view>
</template>