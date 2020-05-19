<template>
    <div class="col-md-4">
        <div class="card mt-2 shadow-sm">
            <div class="card-header text-light bg-primary text-center">{{account.account}}</div>
            <div class="card-body">
                <h5 class="card-title">Password: {{account.password}}</h5>
                <p class="card-text">Descripción: {{account.description}}</p>
            </div>
            <div class="card-footer bg-primary text-center">
                <div class="btn-group">
                    <router-link class="btn btn-warning" :to="{name: 'accountEdit', params: {id: account.id}}">Editar</router-link>
                    <router-link class="btn btn-dark" :to="{name: 'webAccountIndex', params: {accountId: account.id}}">
                        Sub Cuentas
                        <span class="badge badge-light">{{account.total}}</span>
                    </router-link>
                    <button class="btn btn-danger" @click="petitionDestroyAccount">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            account: '',
            index: ''
        },
        methods: {
            petitionDestroyAccount(){
                if (confirm('¿Seguro de eliminar esta cuenta?'))
                    this.$emit('petitionDestroyAccount', {
                        id: this.account.id,
                        index: this.index
                    })
            }
        }
    }
</script>

<style scoped>

</style>
