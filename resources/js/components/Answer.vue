
<script>
    export default {
        props: ['answer'],
        data() {
            return {
                editing: false,
                body: this.answer.body,
                bodyHtml: this.answer.body_html,
                id: this.answer.id,
                questionId: this.answer.question_id,
                beforeEditCache: null
            }
        },
        methods: {
            edit() {
                this.beforeEditCache = this.body
                this.editing = true;
            },

            cancel() {
              this.body = this.beforeEditCache
              this.editing = false
            },

            update() {
                let postUrl = `/questions/${this.questionId}/answers/${this.id}`
                axios.patch(postUrl, {
                    body: this.body
                })
                .then(res => {
                    console.log(res)
                    this.editing = false
                    this.bodyHtml = res.data.body_html
                    alert(res.data.message)
                })
                .catch(err => {
                    console.log('Something went wrong')
                })
            }
        }
    }
</script>

