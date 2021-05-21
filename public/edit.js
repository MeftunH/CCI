jQuery(document).ready(function ($) {

});

function EditModal (url,title)
{
    $('.modal-title').html(title);
    $('#edit-modal-content').load(url,function ()
    {

    });
    $('#edit-modal').modal('show');
}


