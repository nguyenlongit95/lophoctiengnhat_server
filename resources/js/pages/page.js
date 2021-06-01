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
    $("#form-add-pages").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "name": {
                required: true,
            },
            "info": {
                required: true,
                minlength: 8
            },
        },
        messages: {
            "name" : {
                required: 'Bạn hãy nhập tên trang!',
            },
            "info" : {
                required: 'Bạn hãy nhập thông tin trang!',
                minlength: 'Thông tin trang ít nhất 8 ký tự!'
            }
        }
    });
});
