export default {
  state: {
    isLoading: false
  },
  setStartLoad() {
    this.state.isLoading = true
  },
  setFinishedLoad(flg) {
    const self = this

    setTimeout(function() {
      self.state.isLoading = false
    }, 550)
  }
}
