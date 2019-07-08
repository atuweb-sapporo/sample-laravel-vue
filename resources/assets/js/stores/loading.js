const state = {
  isLoading: false
};

const mutations = {
  start(state) {
    state.isLoading = true
  },
  finish(state) {
    setTimeout(function() {
      state.isLoading = false
    }, 250)
  }
};

export default {
  namespaced: true,
  state,
  mutations
};
