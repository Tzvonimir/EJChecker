import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  state: {
    combinations: []
  },
  getters: {
    getCombinations (state) {
      return state.combinations
    }
  },
  mutations: {
    setCombination (state, combination) {
      state.combinations.push(combination)
    },
    deleteCombination (state, index) {
      state.combinations.splice(index, 1)
    }
  },
  plugins: [createPersistedState()],
  strict: debug
})
