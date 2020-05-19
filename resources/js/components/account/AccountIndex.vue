<template>
    <div>
        <account-create
            v-on:petitionStoreAccount="petitionStoreAccount($event)"
        ></account-create>
        <div class="row">
            <account-component
                v-for="(account, index) in accounts"
                :account="account"
                :key="account.id"
                :index="index"
                v-on:petitionDestroyAccount="petitionDestroyAccount($event)"
            ></account-component>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getAccounts();
        },
        data(){
            return {
                accounts: []
            }
        },
        methods: {
            getAccounts(){
                axios.get('/account')
                    .then((response)=>{
                        console.log(response.data)
                        this.accounts = response.data;
                    })
            },
            petitionStoreAccount(message){
                this.accounts.push(message)
            },
            petitionDestroyAccount(message){
                axios.delete('/account/'+message.id)
                    .then((response)=>{
                        this.accounts.splice(message.index, 1)
                    })
            }
        }
    }
</script>
