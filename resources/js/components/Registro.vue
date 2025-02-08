<template>
   <div class="flex justify-center items-center">
        <form @submit.prevent="register">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                <input type="text" v-model="name" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo:</label>
                <input type="email" v-model="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña:</label>
                <input type="password" v-model="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Registrar</button>
        </form>
    </div>
</template>

<script>
//Se importa axios. Librería que se utiliza para hacer peticiones HTTP
export default {
    data() {
        //Se inicializan las variables que se usarán en el formulario
        return {
            name: '',
            email: '',
            password: ''
        }
    },
    methods: {
        register() {
            axios
            //Estos son los datos que se enviarán al servidor
                .post('/api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password
            })
            //Si la petición es exitosa, se guarda el token en el local storage y se redirige al usuario a la página de perfil
            .then(response => {
                console.log(response)
                localStorage.setItem('token', response.data.token)
                this.$router.push({ name: 'Profile' });
            })
            //Si hay un error, se imprime en consola
            .catch(error => {
            if (error.response && error.response.status === 422) {
                // Mostrar los errores de validación
                console.log('Errores de validación:', error.response.data.errors);
                // Puedes manejar los errores en el frontend y mostrarlos al usuario
            } else {
                console.log('Error de registro', error);
            }
        });
},
}
}
</script>