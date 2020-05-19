<template>
    <tr>
        <td v-if="ctrl">{{data.web_page}}</td>
        <td v-else>
            <input type="text" class="form-control form-control-sm" v-model="webPage">
        </td>
        <td v-if="ctrl">{{data.web_account}}</td>
        <td v-else>
            <input type="text" class="form-control form-control-sm" v-model="webAccountInput">
        </td>
        <td v-if="ctrl">{{data.password}}</td>
        <td v-else>
            <input type="text" class="form-control form-control-sm" v-model="password">
        </td>
        <td v-if="ctrl">{{data.description}}</td>
        <td v-else>
            <input type="text" class="form-control form-control-sm" v-model="description">
        </td>
        <td>
            <div class="btn-group btn-group-sm">
                <button v-if="ctrl" class="btn btn-warning" @click="ctrl=false">Editar</button>
                <button v-if="!ctrl" class="btn btn-success" @click="petitionUpdate">Actualizar</button>
                <button v-if="!ctrl" class="btn btn-secondary" @click="cancelUpdate">Cancelar</button>
                <button class="btn btn-danger" @click="petitionDestroy">Eliminar</button>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        props: {
            webAccount: '',
            index: ''
        },
        data(){
            return {
                webPage: this.webAccount.web_page,
                webAccountInput: this.webAccount.web_account,
                password: this.webAccount.password,
                description: this.webAccount.description,
                ctrl: true,
                data: this.webAccount
            }
        },
        methods: {
            petitionUpdate(){
                this.$emit('petitionUpdate', {
                    id: this.webAccount.id,
                    web_page: this.webPage,
                    web_account: this.webAccountInput,
                    password: this.password,
                    description: this.description,
                    index: this.index
                })
                this.data.web_page = this.webPage
                this.data.web_account = this.webAccountInput
                this.data.password = this.password
                this.data.description = this.description
                this.ctrl = true
            },
            petitionDestroy(){
                if (confirm('Eliminará la sub cuenta')){
                    this.$emit('petitionDestroy', {
                        id: this.webAccount.id,
                        index: this.index
                    })
                }
            },
            cancelUpdate(){
                this.webPage = this.data.web_page
                this.webAccountInput = this.data.web_account
                this.password = this.data.password
                this.description = this.data.description
                this.ctrl = true
            }
        }
    }
</script>

<style scoped>

</style>
