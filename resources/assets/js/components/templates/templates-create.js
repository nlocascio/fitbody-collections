Vue.component('app-templates-create', {
    components: {
        'summernote': require('./summernote')
    },

    data () {
        return {
            form: {
                busy: false,
                content: null,
                name: null,
                title: null,
                csrf_token: null,
                id: null
            }
        }
    },

    methods: {
        update () {
            this.$http.put('/template/' + this.form.id, this.form)
                .then(() => {
                    swal('Saved!')
                })
        },

        create () {

        }
    },

    ready () {
        console.log('Templates ready.')
    }

})