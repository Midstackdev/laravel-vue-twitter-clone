import axios from 'axios'

export default {
    namespaced: true,

    state: {
        likes: []
    },

    getters: {
        likes (state) {
            return state.likes
        }
    },

    mutations: {
        PUSH_LIKES (state, data) {
            state.likes.push(...data)
        },

        PUSH_LIKE (state, id) {
            state.likes.push(id)
        },

        POP_LIKE (state, id) {
            state.likes = state.likes.filter((i) => i != id)
        }
    },

    actions: {
        async likeTweet (_, tweet) {
            await axios.post(`/api/tweets/${tweet.id}/likes`)
        },

        async unlikeTweet (_, tweet) {
            await axios.delete(`/api/tweets/${tweet.id}/likes`)
        },

        syncLike ({ commit, state }, id) {
            if (state.likes.includes(id)) {
                commit('POP_LIKE', id)
                return
            }

            commit('PUSH_LIKE', id)
        }
    }
}