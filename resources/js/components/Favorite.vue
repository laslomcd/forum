<template>
    <a title="Click to mark as favorite" :class="classes" @click.prevent="toggle">
        <i class="fas fa-star fa-2x"></i>
        <span class="favorites-count">{{ count }}</span>
    </a>
</template>

<script>
    export default {
        props: ['question'],
        data() {
            return {
                isFavorited: this.question.is_favorited,
                count: this.question.favorites_count,
                signedIn: false,
                questionId: this.question.id,
                userId: this.question.user.id
            }
        },

        computed: {
            classes() {
                return [
                    'favorite', 'mt-2',
                    ! this.signedIn ? 'off' : (this.isFavorited ? 'favorited' : '')
                ]
            },
            endpoint() {
                return `/questions/${this.questionId}/favorites`;
            }
        },

        methods: {
            toggle() {
                if(! this.signedIn) {
                    this.$toast.warning("Please log in to favorite this question", "Warning", {
                        timeout: 3000,
                        position: 'bottomLeft'
                    });
                    return;
                }
                this.isFavorited ? this.destroy() : this.create()
            },
            destroy() {

                axios.delete(this.endpoint)
                .then(res => {
                    this.count--
                    this.isFavorited = false
                })
            },
            create() {
                this.count++
                this.isFavorited = true
                axios.post(this.endpoint, {
                    user_id: this.userId,
                    question_id: this.questionId
                })
            }
        }
    }
</script>

