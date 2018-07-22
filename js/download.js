
function download(id) {

    if(id)
    {
        $.ajax({
            url: 'views/downloads.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data)
            {
                $("#skini"+id).hide();
                $("#preuzimanje" + id).html("<i class='fa fa-spin fa-cog'><i>");
                setInterval(function () {
                    $("#preuzimanje" + id).html(data);
                }, 400);
            },
            error: function(xhr)
            {
                $("#preuzimanje" + id).html(xhr.responseText);
            }
        });
    }

}