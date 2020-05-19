<template>
    <div>
        <div v-if="!ctrl" class="alert alert-success">
            Registro completado
            <router-link class="btn btn-secondary" :to="{name: 'accountIndex'}">Volver</router-link>
        </div>
        <div v-else>
            <div class="form-group mt-1">
                <input type="text" class="form-control" placeholder="Ingrese la cuenta" v-model="account.account">
                <span v-if="errors.account" class="text-danger">{{errors.account[0]}}</span>
            </div>
            <div class="form-group mt-1">
                <input type="text" class="form-control" placeholder="Contraseña" v-model="account.password">
                <span v-if="errors.password" class="text-danger">{{errors.password[0]}}</span>
            </div>
            <div class="form-group mt-1">
                <textarea name="description" class="form-control" v-model="account.description" placeholder="Descripción">
                </textarea>
                <span v-if="errors.description" class="text-danger">{{errors.description[0]}}</span>
            </div>
            <div class="form-group mt-1">
                <button class="btn btn-success" @click="updateAccount()">Guardar Cambios</button>
                <router-link class="btn btn-secondary" :to="{name: 'accountIndex'}">Cancelar</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted(){
            this.getAccount();
        },
        props: {
            id: ''
        },
        data(){
            return{
                account: '',
                errors: [],
                ctrl: true
            }
        },
        methods: {
            getAccount(){
                axios.get('/account/'+this.id)
                    .then((response)=>{
                        this.account = response.data
                    })
                    .catch((error)=>{
                        if (error.response.status==422){
                            this.errors = error.response.data.errors
                        }
                    })
            },
            updateAccount(){
                axios.put('/account/'+this.id,{
                    account: this.account.account,
                    password: this.account.password,
                    description: this.account.description,
                })
                    .then((response)=>{
                        this.account = null
                        this.ctrl = false
                    })
            }
        }
    }
</script>

<style scoped>

</style>
