<template>
    <div class="w-full inline-block p-4 border-b border-gray-800 hover:bg-gray-800">
        <component 
            :is="`app-tweet-variant-${tweet.type}`"
            :tweet="tweet"
        />
    </div>
</template>

<script>
    
    import AppTweetUsername from './AppTweetUsername'

    export default {
        componenets: {
            AppTweetUsername
        },
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },
        data () {
            return {
                
            }
        },
        methods: {
            
        },
        mounted() {
            
        }
    }
</script>
