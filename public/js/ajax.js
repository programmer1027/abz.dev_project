$(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    ajaxLoad($(this).attr('href'));
});
$(document).on('submit', '#clear', function (event) {
    event.preventDefault();
    ('#search').text('');
});
$(document).on('submit', 'form#frm', function (event) {
    event.preventDefault();
    var form = $(this);
    var data = new FormData($(this)[0]);
    var url = form.attr("action");
    $.ajax({
        type: form.attr('method'),
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('.is-invalid').removeClass('is-invalid');
            if (data.fail) {
                for (control in data.errors) {
                    $('#' + control).addClass('is-invalid');
                    $('#error-' + control).html(data.errors[control]);
                }
            } else {
                ajaxLoad(data.redirect_url);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });
    return false;
});

function ajaxLoad(filename, content) {
    content = typeof content !== 'undefined' ? content : 'content';
   $('.loading').show();
    $.ajax({
        type: "GET",
        url: filename,
        contentType: false,
        success: function (data) {
            $("#" + content).html(data);
            $('.loading').hide();
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}

function ajaxDelete(filename, token, content) {
    content = typeof content !== 'undefined' ? content : 'content';
    $('.loading').show();
    $.ajax({
        type: 'POST',
        data: {_method: 'DELETE', _token: token},
        url: filename,
        success: function (data) {
            $("#" + content).html(data);
            $('.loading').hide();
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}
jQuery(function ($) {
    $(document).on('change', '#enableSelect', function () {
        if (this.checked) {
            $('#position').prop('disabled', false);
            $('#parent_id').prop('disabled', false);
            var position = $("#position option:selected").val();
            var formData = $(this).val();
            $.ajax({
                method: 'GET', // Type of response and matches what we said in the route
                url: 'ajaxemployees/changeselect', // This is the url we gave in the route
                data: {'id': position}, // a JSON object to send back
                contentType: false,
                success: function(response){ // What to do if we succeed
                    $("select[name='parent_id']").html('');
                    $("select[name='parent_id']").html(response.options);
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
        else{
            $('#position').prop('disabled', true);
            $('#parent_id').prop('disabled', true);
        }
    });
});

$(document).on('change', '#position', function (event) {
    event.preventDefault();
    var position = $("#position option:selected").val();
    var formData = $(this).val();
    $.ajax({
        method: 'GET', // Type of response and matches what we said in the route
        url: 'ajaxemployees/changeselect', // This is the url we gave in the route
        data: {'id': position}, // a JSON object to send back
        contentType: false,
            success: function(response){ // What to do if we succeed
                $("select[name='parent_id']").html('');
                $("select[name='parent_id']").html(response.options);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
});








