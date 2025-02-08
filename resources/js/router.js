import { createRouter, createWebHistory } from "vue-router";
import SolicitudList from "@/components/SolicitudList.vue";

import Login from "@/components/Login.vue";
import Profile from "@/components/Profile.vue";
import Registro from "@/components/Registro.vue";

const routes = [
    {
        path: "/solicitudes",
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
        //Obliga a que el usuario este autenticado para acceder a la ruta. Ruta protegida
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
