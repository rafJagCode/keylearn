<template>
    <v-container class="user-results">
        <result v-for="test in tests" :key="test.id" :test="test"></result>
    </v-container>
</template>
<script>
import {mapGetters} from 'vuex';
import Result from '@/components/dashboard/Result';
export default {
    data(){
        return{
            tests: null
        }
    },
    computed:{
        ...mapGetters(['user'])
    },
    mounted(){
        Vue.axios.post('/api/get-user-results', this.user).then((res)=>{
            this.tests = res.data;
        })
    },
    components:{
        Result
    }
}
</script>