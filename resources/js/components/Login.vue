<template>
    <div class="flex justify-center items-center">
        <form @submit.prevent="login" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo:</label>
                <input type="email" v-model="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña:</label>
                <input type="password" v-model="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Iniciar sesión</button>
        </form>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                email: '',
                password: ''
            }
        },
        methods:{
            login(){
                axios
                    //Endpoint para iniciar sesión
                    .post('/api/login', {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        //Hacen los 2 lo mismo, para saber si se obtiene el token
                        // esto muestra el token en pantalla alert(response.data.token);
                        alert("Inicio de sesión exitoso");
                        //Guardamos el token en el local storage
                        localStorage.setItem('token', response.data.token);
                        //Redirigimos al usuario a la página de perfil
                        this.$router.push({ name: 'Profile' });
                    })
                    .catch(error => {
                        alert('Error de inicio de sesión');
                        console.error('Error de inicio de sesión', error);

                    });
            },
        },
    }
</script>