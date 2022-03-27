import { createStore } from 'vuex'

const store = createStore({
    state: {
        users: [],
    },
    getters: {
        index(state) {
            return state.users
        },
        find: state => id => {
            return state.users.find(user => user.id === id);
        }
    },
    mutations: {
        store(state, data) {
            state.users = [...data]
        },
        destroy(state, id) {
            state.users = state.users.filter(user => user.id !== id)
        }
    },
    actions: {
        store({ commit }, data) {
            commit('store', data)
        },
        destroy({ commit }, id) {
            commit('destroy', id)
        }
    }
})

export default store;