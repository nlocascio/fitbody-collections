Vue.component('app-templates-create', {
    components: {

    },

    data () {
        return {
            content: null
        }
    },

    ready () {
        console.log('Templates ready.')
        $('#summernote').summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['picture', 'link']]
            ]
        });
    }

})