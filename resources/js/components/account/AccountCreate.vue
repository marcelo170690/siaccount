<template>
    <div>
        <div v-if="ctrl" class="text-right">
            <button class="btn btn-success btn-lg" @click="showForm">+</button>
        </div>
        <div v-else>
            <div class="form-group mt-1">
                <input type="text" class="form-control" placeholder="Ingrese la cuenta" v-model="account">
                <span v-if="errors.account" class="text-danger">{{errors.account[0]}}</span>
            </div>
            <div class="form-group mt-1">
                <input type="text" class="form-control" placeholder="Contraseña" v-model="password">
                <span v-if="errors.password" class="text-danger">{{errors.password[0]}}</span>
            </div>
            <div class="form-group mt-1">
                <textarea name="description" class="form-control" v-model="description" placeholder="Descripción">
                </textarea>
                <span v-if="errors.description" class="text-danger">{{errors.description[0]}}</span>
            </div>
            <div class="form-group mt-1">
                <button class="btn btn-success" @click="storeAccount()">Agregar Cuenta</button>
                <button class="btn btn-secondary" @click="ctrl=true">Cancelar</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        },
        data() {
            return {
                account: '',
                password: '',
                description: '',
                errors: [],
                ctrl: true
            }
        },
        methods: {
            storeAccount(){
                axios.post('/account',{
                    account: this.account,
                    password: this.password,
                    description: this.description,
                })
                .then((response) => {
                    this.account = ''
                    this.password = ''
                    this.description = ''
                    this.ctrl = true
                    this.$emit('petitionStoreAccount', response.data)
                })
                .catch((error) =>{
                    if (error.response.status==422){
                        this.errors = error.response.data.errors
                    }
                })
            },
            showForm(){
                this.ctrl = false
            }
        }
    }
</script>
