<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <a class="navbar-brand" href="/">
                Sistema de Cuentas
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul v-if="user" class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'accountIndex'}" data-toggle="collapse" data-target=".navbar-collapse.show">Mis Cuentas</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'webAccountIndexAll'}" data-toggle="collapse" data-target=".navbar-collapse.show">Mis sub cuentas</router-link>
                    </li>
                </ul>
                <ul v-if="!user" class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <button class="btn btn-success" data-toggle="modal" data-target="#loginModal">
                            Login
                        </button>
                    </li>
                </ul>
                <ul v-else class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{user.name}}</a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" @click="logout">
                                Cerrar Sesión
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                       Iniciar Sesión
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Email</span>
                            </div>
                            <input type="text" class="form-control" v-model="email">
                        </div>
                        <span v-if="errors.email" class="text-danger">
                            {{errors.email[0]}}
                        </span>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Contraseña</span>
                            </div>
                            <input type="password" class="form-control" v-model="password">
                        </div>
                        <span v-if="errors.password" class="text-danger">
                            {{errors.password[0]}}
                        </span>
                        <div v-if="ctrlUE" class="alert alert-danger">
                            {{message}}
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <div class="btn-group">
                            <button class="btn btn-success" @click="login">Iniciar Sesión</button>
                            <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created(){
            this.init();
        },
        data(){
            return{
                user: '',
                email: '',
                password: '',
                errors: [],
                ctrlUE: false,
                message: '',
                ctrlCloseModal: false
            }
        },
        methods: {
            init(){
                axios.get('/auth/init')
                    .then(response=>{
                        this.user = response.data
                        this.ctrlUE = false
                    })
            },
            login(){
                this.errors=[]
                axios.post('/auth/login',{
                    email: this.email,
                    password: this.password
                })
                    .then(response=>{
                        this.user = response.data
                        this.ctrlUE = false
                        this.ctrlCloseModal = true
                        location.reload();
                    })
                    .catch(error=>{
                        if (error.response.status==422){
                            this.errors = error.response.data.errors
                        }
                        if (error.response.status==401){
                            this.ctrlUE = true
                            this.message = error.response.data
                        }
                    })
            },
            logout(){
                axios.get('/auth/logout')
                    .then(response=>{
                        this.user = response.data
                    })
            }
        }
    }
</script>

<style scoped>

</style>
