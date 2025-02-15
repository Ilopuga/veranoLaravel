import { createRouter, createWebHistory } from "vue-router";
import SolicitudList from "@/components/SolicitudList.vue";
import AddSolicitud from "./components/AddSolicitud.vue";
import Login from "@/components/Login.vue";
import Profile from "@/components/Profile.vue";
import Registro from "@/components/Registro.vue";
import ActividadesList from "@/components/ActividadesList.vue";

// Definimos las rutas
const routes = [
    {
        path: "/", // Página principal
        name: "home",
        component: ActividadesList,
    },
    {
        path: "/agregar-solicitud/:id?", // Página para agregar/modificar solicitud. Le paso el parametro
        name: "addSolicitud",
        component: AddSolicitud,
        props: true, // Habilita el paso de parámetros en la URL como propiedades
    },
    {
        path: "/solicitudes", // Lista de solicitudes
        name: "solicitudes",
        component: SolicitudList,
    },
    {
        path: "/registro",
        name: "Registro",
        component: Registro,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/profile",
        name: "Profile",
        component: Profile,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/actividades", // Página de actividades
        name: "actividades",
        component: ActividadesList, // Asegúrate de que este sea el componente que muestra las actividades
        meta: {
            requiresAuth: true,
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
