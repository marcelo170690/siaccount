<template>
    <div>
        <div class="text-right" v-if="ctrl">
            <button class="btn btn-success btn-lg mb-2" @click="showForm()">+</button>
        </div>
        <div v-else>
            <div class="form-group mt-1">
                <input type="text" class="form-control" placeholder="Página web" v-model="webPage">
                <span v-if="errors.web_page" class="text-danger">{{errors.web_page[0]}}</span>
            </div>
            <div class="form-group mt-1">
                <input type="text" class="form-control" placeholder="Cuenta web" v-model="webAccount">
                <span v-if="errors.web_account" class="text-danger">{{errors.web_account[0]}}</span>
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
                <button class="btn btn-primary" @click="storeWebAccount">Registrar</button>
                <button class="btn btn-secondary" @click="ctrl=true">Cancelar</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            accountId: ''
        },
        data(){
            return{
                webPage: '',
                webAccount: '',
                password: '',
                description: '',
                errors: [],
                ctrl: true,
            }
        },
        methods: {
            storeWebAccount(){
                axios.post('/webAccount',{
                    account_id: this.accountId,
                    web_page: this.webPage,
                    web_account: this.webAccount,
                    password: this.password,
                    description: this.description,
                })
                    .then((response)=> {
                        this.webPage = ''
                        this.webAccount = ''
                        this.password = ''
                        this.description = ''
                        this.$emit('petitionAddWebAccount', response.data)
                        this.ctrl = true
                    })
                    .catch((error)=>{
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

<style scoped>

</style>
