<template>
    <div>
        <AppTweet
            v-for="tweet in tweets"
            :key="tweet.id"
            :tweet="tweet"
        />
    </div>
</template>

<script>
    import axios from 'axios'
    import AppTweet from '../tweets/AppTweet'
    export default {
        components: {
            AppTweet
        },
        data () {
            return {
                tweets: null
            }
        },
        methods: {
            async getTweets () {
                let response = await axios.get('/api/timeline')

                this.tweets = response.data.data 
            }
        },
        mounted() {
            this.getTweets()
            console.log('Component mounted.')
        }
    }
</script>