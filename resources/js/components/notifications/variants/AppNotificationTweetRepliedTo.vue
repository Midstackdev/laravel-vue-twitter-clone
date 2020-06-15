<template>
    <div class="p-4 flex-grow">
        <AppTweet
            class="!border-0"
            v-if="resolvedTweet" 
            :tweet="resolvedTweet" 
        />
        
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'

    export default {
        props: {
            notification: {
                required: true,
                type: Object
            }
        },

        computed: {
            ...mapGetters({
                tweet: 'notifications/tweet'
            }),

            resolvedTweet () {
                return this.tweet(this.notification.data.tweet.id)
            }
        }
    }
</script>