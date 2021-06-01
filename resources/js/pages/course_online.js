$(document).ready(function () {
    /**
     * Change name to slug
     */
    $('#name').on('keyup', function () {
        let slug = changeToSlug($(this).val());
        $('#link').val(slug);
    });

    /**
     * jQuery validate form content
     */
    $("#form-add-course-online").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "name": {
                required: true,
            },
            "description" : {
                required: true,
            },
        },
        messages: {
            "name" : {
                required: 'Bạn hãy nhập tên trang!',
            },
            "description" : {
                required: "Bạn hãy nhập nội dung khoá học!",
            }
        }
    });
});

/**
 *  Replace ck editor for textarea elements
 */
CKEDITOR.replace( 'ckeditor' );
