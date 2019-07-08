<template>
  <div id="app">
    {{isLoading}}
    <spinner v-show="isLoading"></spinner>
    <router-view></router-view>
  </div>
</template>


<script>
import spinner from '@/js/components/Layouts/Spinner'

export default {
  computed: {
    isLoading() {
      return this.$store.state.loading.isLoading
    }
  },
  components: {
    spinner: spinner
  }
}
</script>
