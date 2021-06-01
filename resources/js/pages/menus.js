$(document).ready(function () {
    /**
     * change menu name to slug on update section
     */
    $('#menu-name-update').on('keyup', function (evt) {
        let _menuNameVal = changeToSlug($(this).val());
        $('#menu-slug-update').val(_menuNameVal);
    });

    /**
     * change sub menu name on create section
     */
    $('#sub-menu-name-create').on('keyup', function () {
        let _menuNameVal = changeToSlug($(this).val());
        $('#sub-menu-slug-update').val(_menuNameVal);
    });

    /**
     * ben change sub menu
     */
    $('#btn-add-submenu').on('click', function () {
        $.ajax({
            url: '/admin/menus/create',
            type: 'get',
            data: {},
            success: function (result) {
                $('#show-sub-menu').html(result.data);
            }
        });
    });
});
