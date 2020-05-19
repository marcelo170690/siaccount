<template>
    <div>
        <div class="row mb-2">
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Página</span>
                    </div>
                    <input type="text" class="form-control" v-model="webPage" @keyup="getWebAccountAll">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Cuenta</span>
                    </div>
                    <input type="text" class="form-control" v-model="webAccount" @keyup="getWebAccountAll">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Descripción</span>
                    </div>
                    <input type="text" class="form-control" v-model="description" @keyup="getWebAccountAll">
                </div>
            </div>
            <div class="col-md-3">
                <select class="custom-select" v-model="accountId" @change="getWebAccountAll">
                    <option value="">Todos</option>
                    <option v-for="account in accounts" :value="account.id">{{account.account}}</option>
                </select>
            </div>
        </div>
        <table class="table table-sm table-striped text-center">
            <thead>
                <tr>
                    <th>Pagina Web</th>
                    <th>Cuenta Web</th>
                    <th>password Web</th>
                    <th>Descripción Web</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="webAccount in webAccounts">
                    <td>{{webAccount.web_page}}</td>
                    <td>{{webAccount.web_account}}</td>
                    <td>{{webAccount.password}}</td>
                    <td>{{webAccount.description}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        created(){
            this.getWebAccountAll();
            this.getAccount();
        },
        data(){
            return {
                webPage: '',
                webAccount: '',
                description: '',
                accountId: '',
                webAccounts: [],
                accounts: []
            }
        },
        methods: {
            getWebAccountAll(){
                axios.get('/webAccount?web_page='+this.webPage+'&'+
                                        'web_account='+this.webAccount+'&'+
                                        'description='+this.description+'&'+
                                        'account_id='+this.accountId
                )
                    .then((response)=>{
                        this.webAccounts = response.data
                    })
            },
            getAccount(){
                axios.get('/account')
                    .then((response)=>{
                        this.accounts = response.data
                    })
            }
        }
    }
</script>

<style scoped>

</style>
