import axios from 'axios'

export default {
    async getTweets ({ commit }, url ) {
        let response = await axios.get(url)

        commit('PUSH_TWEETS', response.data.data)

        commit('likes/PUSH_LIKES', response.data.meta.likes, {root: true})
        commit('retweets/PUSH_RETWEETS', response.data.meta.retweets, {root: true})
        console.log(response.data)

        return response
    },

    async quoteTweet (_, { tweet, data }) {
        await axios.post(`/api/tweets/${tweet.id}/quotes`, data)
    },

    async replyTweet (_, { tweet, data }) {
        await axios.post(`/api/tweets/${tweet.id}/replies`, data)
    }
}