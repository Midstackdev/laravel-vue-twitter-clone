<template>
    <div class="flex w-full">
        <div class="mr-3">
            <img :src="tweet.user.avatar" class="w-12 rounded-full">
        </div>
        <div class="flex-grow">
            <AppTweetUsername 
                :user="tweet.user"
            />
            <AppTweetBody 
                :tweet="tweet"
            />

            <AppTweet 
                class="border border-gray-700 rounded-lg mt-4"
                :tweet="tweet.original_tweet"
            />

            <AppTweetActionGroup 
                :tweet="tweet"
            />
        </div>
    </div>
</template>

<script>
    
    export default {
        props: {
            tweet: {
                required: true,
                type: Object,
            }
        }
    }
</script>