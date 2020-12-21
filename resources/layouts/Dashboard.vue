<template>
    <div class="dashboard">
        Dashboard <br>
        Email: {{user.email}}<br><br>
        <v-btn @click.prevent="logout()">Logout</v-btn>
        </div>
</template>
<script>
export default {
    data: () => ({
        user: null,
    }),
    mounted(){
        Vue.axios.get('/api/user').then((res)=>{
            console.log(res.data);
            this.user = res.data;
        }).catch((error)=>{
            console.log(error);
        })
    },
    methods:{
        logout(){
            Vue.axios.post('/api/logout').then(()=>{
                this.$router.push({name: 'home'})
            })
        }
    }
}
</script>