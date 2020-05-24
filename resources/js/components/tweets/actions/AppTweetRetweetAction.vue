<template>
    <div>
        <AppDropdown v-if="!retweeted">
            <template slot="trigger">
                <AppTweetRetweetActionButton 
                    :tweet="tweet"
                />
            </template>
            <AppDropdownItem @click.prevent="retweetOrunretweet">
                Retweet
            </AppDropdownItem>
            <AppDropdownItem>
                Retweet with comment
            </AppDropdownItem>
        </AppDropdown>

        <AppTweetRetweetActionButton
            @click.prevent="retweetOrunretweet"
            v-else 
            :tweet="tweet"
        />
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },

        computed: {
            ...mapGetters({
                retweets: 'retweets/retweets'
            }),

            retweeted () {
                return this.retweets.includes(this.tweet.id)
            }
        },

        methods: {
            ...mapActions({
                retweetTweet: 'retweets/retweetTweet',
                unretweetTweet: 'retweets/unretweetTweet'
            }),

            retweetOrunretweet () {
                if (this.retweeted) {
                    this.unretweetTweet(this.tweet)
                    return
                }

                this.retweetTweet(this.tweet)
            }
        }
    }
</script>