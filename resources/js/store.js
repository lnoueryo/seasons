import Vue from 'vue';
import Vuex from 'vuex';
import router from './routes'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: {id: null, name: null, email: null},
    },
    getters: {
        isAuth: state => state.user.id ? true : false,
    },
    mutations: {
        userData(state, payload) {
            state.user= payload;
        }
    },
    actions: {
        login(context, payload) {
            try {
                axios.post('login', payload).then(response => {
                    context.commit('userData', response.data)
                    router.go(-1)
                })
            } catch (error) {
                router.push('login')
            }
        },
        loadUser(context){
            try {
                axios.get('api/check').then(response => {
                    context.commit('userData', response.data)
                })
            } catch (error) {
                context.dispatch('logout')
            }
        },
        logout(context){
            try {
                axios.post('logout', payload).then(() => {
                    context.commit('userData', {id: null, name: null, email: null})
                })
            } catch (error) {
                context.commit('userData', {id: null, name: null, email: null})
            }
        }
    },
});