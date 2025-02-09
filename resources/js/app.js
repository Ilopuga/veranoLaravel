import "./bootstrap";
import { createApp } from "vue";
import router from "./router"; // Importamos las rutas desde router.js
import Hola from "./components/Hola.vue"; // Importamos Hola.vue

// Creamos la aplicación Vue y la montamos
const app = createApp(Hola); // Usamos Hola.vue como el componente principal

// Usamos el router y montamos Vue en el div con id 'app'
app.use(router).mount("#app");
