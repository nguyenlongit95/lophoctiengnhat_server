$(document).ready(function () {
    /**
     * Change name to slug
     */
    $('#name').on('keyup', function () {
        let slug = changeToSlug($(this).val());
        $('#slug').val(slug);
    });

    /**
     * jQuery validate form content
     */
    $("#form-add-documentation").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        ignore: [],
        rules: {
            name: {
                required: true,
            },
            description : {
                required: function (textarea) {
                    console.log(textarea);
                    CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                    return editorcontent.length === 0;
                },
            },
        },
        messages: {
            name: {
                required: 'Bạn hãy nhập tên khóa học!',
            },
            description: {
                required: "Bạn hãy nhập nội dung khoá học!",
            },
        },
        submit: function () {
            console.log('kjahsdi');
        },
    });
});

/**
 *  Replace ck editor for textarea elements
 */
CKEDITOR.replace( 'ckeditor' );
