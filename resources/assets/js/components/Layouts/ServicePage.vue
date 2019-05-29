<template>
  <div>
    <head-bar></head-bar>
    <div class="container">
      <slot></slot>
    </div>
    <foot-bar></foot-bar>
  </div>
</template>

<script>
import header from '@/js/components/Layouts/Header'
import footer from '@/js/components/Layouts/Footer'

export default {
  components: {
    'head-bar': header,
    'foot-bar': footer
  }
}
</script>
