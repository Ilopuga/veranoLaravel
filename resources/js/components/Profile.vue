<template>
    <div>
        <h2>Perfil de usuario</h2>
        <!-- Si existe el usuario se muestran sus datos -->
        <div v-if="user">
            <p>Nombre: {{ user.name }}</p>
            <p>Correo: {{ user.email }}</p>
        </div>
        <button class="bg-blue-500 text-white" @click="logout">Salir</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: null,
            };
        },
        //Cargamos los datos del usuario al cargar el componente
        mounted() {
            fetch('/api/user', {
                method: 'GET',
                headers: {
                    //Se envía el token en la cabecera de la petición
                    Authorization: `Bearer ${localStorage.getItem('token')}`,                },
            })
            .then((response) => response.json())
            .then((data) => {
                this.user = data;
            })
            .catch((error) => {
                console.error('Error al cargar el usuario', error);
            });
        },
        methods: {
            logout() {
                fetch('/logout', {
                    method: 'POST',
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`,                    },
                })
                .then((response) => {
                    localStorage.removeItem('token');
                    this.$router.push({ name: 'Login' });
                })
                .catch((error) => {
                    console.error('Error al cerrar sesión', error);
                });
            },
        },
    };
</script>