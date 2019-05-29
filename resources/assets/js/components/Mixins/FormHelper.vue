<script>
export default {
  computed: {
    isValid() {
      const validation = this.validation
      return Object
        .keys(validation)
        .every(function (key) {
          return validation[key]
        })
    }
  },
  methods: {
    errorClassObject(key) {
      return {
        'has-error': (!this.validation[key])
      }
    }
  },
}
</script>

