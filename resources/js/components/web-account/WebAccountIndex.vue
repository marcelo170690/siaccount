<template>
    <div>
        <web-account-create
            :account-id="accountId"
            v-on:petitionAddWebAccount="petitionAddWebAccount($event)"
        ></web-account-create>
        <table class="table table-bordered table-sm text-center">
            <thead>
            <tr>
                <th>Account</th>
                <th>Web</th>
                <th>Password</th>
                <th>Description</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                <web-account
                    v-for="(webAccount, index) in webAccounts"
                    :web-account="webAccount"
                    :key="webAccount.id"
                    :index="index"
                    v-on:petitionUpdate="petitionUpdate($event)"
                    v-on:petitionDestroy="petitionDestroy($event)"
                ></web-account>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            accountId: ''
        },
        mounted(){
            this.getWebAccounts();
        },
        data(){
            return {
                webAccounts: []
            }
        },
        methods: {
            getWebAccounts(){
                axios.get('/webAccount/'+this.$route.params.accountId)
                    .then((response)=>{
                        this.webAccounts = response.data;
                    })
            },
            petitionAddWebAccount(message){
                this.webAccounts.push(message)
            },
            petitionUpdate(message){
                axios.put('/webAccount/'+message.id,{
                    web_page: message.web_page,
                    web_account: message.web_account,
                    password: message.password,
                    description: message.description,
                })
                    .then((response)=>{
                        console.log(response.data)
                    })
            },
            petitionDestroy(message){
                axios.delete('/webAccount/'+message.id)
                    .then(
                        this.webAccounts.splice(message.index, 1)
                    )
            }
        }
    }
</script>

<style scoped>

</style>
