$(document).ready(function () {
    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();

        let id = $(this).data('id');
        let thisEle = $(this);

        if (confirm('Are you ready for delete')) {
            $.ajax({
                url: '/blog/delete/' + id,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                success: function (res) {
                    console.log('Deleted successfully', res);
                    if (res.status === 'deleted') {
                        alert('Post Deleted');
                        thisEle.closest('tr').remove();
                    } else {
                        alert('Delete error');
                    }
                },
                error: function (xhr) {
                    alert('Error deleting post. Server problem.');
                    console.error(xhr.responseText);
                }
            });
        }
    });
    
    $('#search-btn').on('change', function() {
        alert("hii");
    });





});