import Vue  from 'vue'
import Vuex from 'vuex'
import loading from "@/js/stores/loading";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    loading
  }
});
