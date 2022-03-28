import { createStore } from 'vuex'

const store = createStore({
    state: {
        users: [],
        links:[],
        current:'',
        to:'',
    },
    getters: {
        index(state) {
            return state.users
        },
        data(state) {
            return state.data
        },
        find: state => id => {
            return state.users.find(user => user.id === id);
        }
    },
    mutations: {
        store(state, data) {
            state.users = [...data]
        },
        data(state,data) {
            state.links = [...data.links];
            state.current = data.current_page;
            state.to = data.to;

        },
        destroy(state, id) {
            state.users = state.users.filter(user => user.id !== id)
        }
    },
    actions: {
        store({ commit }, data) {
            commit('store', data)
        },
        data({ commit },data) {
            commit('data',data)
        },
        destroy({ commit }, id) {
            commit('destroy', id)
        }
    }
})

export default store;
