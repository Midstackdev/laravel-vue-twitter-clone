<template>
    <ul class="flex mt-4">
        <li class="w-3/12">
            <AppTweetReplyAction 
                 :tweet="tweet"
            />
        </li>
        <li class="w-3/12">
            <AppTweetRetweetAction 
                :tweet="tweet"
            />
        </li>
        <li class="w-3/12">
            <AppTweetLikeAction 
                :tweet="tweet"
            />
        </li>
    </ul>
</template>

<script>
    
    export default {
        props: {
            tweet: {
                require: true,
                type: Object
            }
        }
    }
</script>