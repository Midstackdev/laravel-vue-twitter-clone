<template>
    <form class="flex" @submit.prevent="submit">
        
        <img :src="$user.avatar" class="w-12 rounded-full mr-3 w-12 h-12">
        
        <div class="flex-grow">
            <AppTweetComposeTextarea 
                v-model="form.body"
                placeholder="Tweet your reply"
            />
            <AppTweetComposeMediaProgress 
                class="mb-4"
                v-if="media.progress"
                :progress="media.progress"
            />
           
            <AppTweetImagePreview 
                :images="media.images"
                v-if="media.images.length"
                @remove="removeImage"
            />

            <AppTweetVideoPreview 
                :video="media.video"
                v-if="media.video"
                @remove="removeVideo"
            />
            <div class="flex justify-between">
                <ul class="flex items-center"> 
                    <li class="mr-4">
                        <AppTweetComposeMediaButton 
                            id="media-compose-reply"
                            @selected="handleMediaSelected"
                        />
                    </li>     
                </ul>
                
                <div class="flex items-center justify-end">
                    <AppTweetComposeLimit
                        class="mr-2"
                        :body="form.body"
                    />
                    <button
                        type="submit"
                        class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
                    >
                        Reply
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import axios from 'axios'
    import compose from '../../mixins/compose'
    import { mapActions } from 'vuex'
    
    export default {
        mixins: [
            compose
        ],

        props: {
            tweet: {
                required: true,
                type: Object
            }
        },

        methods: {
            ...mapActions({
                replyToTweet: 'timeline/replyTweet'
            }),

            async post () {
                await this.replyToTweet({
                    tweet: this.tweet,
                    data: this.form
                })

                this.$emit('success')
            }
        }
    }
</script>