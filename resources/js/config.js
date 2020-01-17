$(document).ready(function () {
    $('.delete').click(function () {
        var el = this;
        var delete_id = $(el).data('id');
        var route = $(el).data('url');
        var result = confirm('Bạn có chắc chắn muốn xóa không?');
        if (result) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: route,
                method: 'post',
                data: {
                    'id': delete_id,
                    _method: 'delete',
                },
                success: function(response) {
                    if (response === true) {
                        $(el).closest('tr').css('background', 'red');
                        $(el).closest('tr').fadeOut(800, function () {
                            $(el).remove();
                            alert( 'Xóa thành công');
                        });
                    } else {
                        alert( 'Xóa không thành công');
                    }
                }
            });
        }
    });
});

