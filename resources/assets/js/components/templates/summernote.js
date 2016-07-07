module.exports = {
    template: "<textarea class='form-control' :name='name'></textarea>",
    props: {
        content: {
            required: true,
            twoWay: true
        }
    },

    ready () {
        var self = this;

        $(this.$el).summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['picture', 'link']],
            ],
            callbacks: {
                onInit () {
                    if (typeof self._slotContents.default !== 'undefined') {
                        $(self.$el).summernote('code', self._slotContents.default.textContent)
                    }
                },
                onChange (contents) {
                    self.content = contents
                }
            }
        })
    }
}
