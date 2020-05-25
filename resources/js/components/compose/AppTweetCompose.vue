<template>
    <form class="flex" @submit.prevent="submit">
        
        <img :src="$user.avatar" class="w-12 rounded-full mr-3 w-12 h-12">
        
        <div class="flex-grow">
            <AppTweetComposeTextarea 
                v-model="form.body"
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
                            id="media-compose"
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
                        Tweet
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import axios from 'axios'
    
    export default {
        data () {
            return {
                form: {
                    body: '',
                    media: []
                },

                media: {
                    images: [],
                    video: null
                },

                mediaTypes: {}
            }
        },

        methods: {
            async submit () {
                await axios.post(`/api/tweets`, this.form)

                this.form.body = ''
            },

            removeVideo () {
                this.media.video = null
            },

            removeImage (image) {
                this.media.images = this.media.images.filter((i) => {
                    return image !== i
                })
            },

            async getMeidaTypes () {
                let response = await axios.get(`api/media/types`)

                this.mediaTypes = response.data.data
            },

            handleMediaSelected (files) {
                Array.from(files).slice(0, 4).forEach((file) => {
                    if (this.mediaTypes.image.includes(file.type)) {
                        this.media.images.push(file)
                    }

                    if (this.mediaTypes.video.includes(file.type)) {
                        this.media.video = file
                    }

                })
                
                if (this.media.video) {
                    this.media.images = []
                }
            }
        },

        mounted () {
            this.getMeidaTypes()
        }
    }
</script>