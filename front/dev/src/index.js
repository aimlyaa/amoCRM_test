import "./components/app/app.scss";
import Vue   from 'vue';
import Vuex  from 'vuex';
import App   from './components/app/app.vue';

Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    entId: 0,
    entName : "",
    textResult : "",
  },
  mutations: {
    setEntId(state, id) {
      state.entId = id
    },
    setEntName(state, name) {
      state.entName = name
    },
    appendTextResult(state, result) {
      state.textResult = "ID сущности " + state.entName + ": " + result + "\n" + state.textResult
    }
  },
})

new Vue({
    el: '#root',
    store,
    render: h => h(App)
});