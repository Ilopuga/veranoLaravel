import { createRouter, createWebHistory } from "vue-router";
import SolicitudList from "@/components/SolicitudList.vue";

const routes = [
    {
        path: "/solicitudes",
        component: SolicitudList,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
