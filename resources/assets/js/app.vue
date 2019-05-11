<template>
  <div id="app">
    <loader v-show="loadState.isLoading"></loader>
    <router-view></router-view>
  </div>
</template>

<script>
import ajaxStore from '@/js/stores/ajaxStore'
import loader from '@/js/components/Layouts/Loading'

export default {
  data() {
    return {
      loadState : ajaxStore.state
    }
  },
  components: {
    loader: loader
  }
}
</script>
