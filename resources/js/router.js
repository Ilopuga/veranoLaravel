import { createRouter, createWebHistory } from "vue-router";
import SolicitudList from "@/components/SolicitudList.vue";
import AddSolicitud from "./components/AddSolicitud.vue";
import Login from "@/components/Login.vue";
import Profile from "@/components/Profile.vue";
import Registro from "@/components/Registro.vue";

// Definimos las rutas
const routes = [
    {
        path: "/", // Página principal
        name: "home",
        component: SolicitudList, // O el componente que desees mostrar al inicio
    },
    {
        path: "/agregar-solicitud", // Página para agregar una nueva solicitud
        name: "addSolicitud",
        component: AddSolicitud,
    },
    {
        path: "/solicitudes", // Lista de solicitudes
        name: "solicitudes",
        component: SolicitudList,
    },
    {
        path: "/agregar-solicitud", // Página para agregar una solicitud
        name: "addSolicitud",
        component: AddSolicitud,
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
        //Obliga a que el usuario este autenticado para acceder a la ruta. Ruta protegida
        meta: {
            requiresAuth: true,
        },
    },
];

// Creamos el enrutador
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
