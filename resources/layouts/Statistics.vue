<template>
  <v-container>
    <span>Statistics</span>
    <user-results></user-results>
  </v-container>
</template>
<script>
import UserResults from '@/components/dashboard/UserResults';
export default {
    components:{
        UserResults
    }
    
}
</script>