import "./bootstrap";
import { createApp } from "vue";
//import Hola from "@/components/Hola.vue";
import SolicitudList from "@/components/SolicitudList.vue";
import Hola from "./components/Hola.vue";
import router from "./router";

//Creo app
createApp(Hola).use(router).mount("#app");
