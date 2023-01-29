$(document).ready(function(){
    $('#summernote').summernote({
        toolbar:[
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
        ]
    });

    $('.select2').select2()


    $(function () {
        bsCustomFileInput.init();
    });
});
