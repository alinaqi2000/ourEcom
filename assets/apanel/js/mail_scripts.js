// Mails
$(document.body).ready(function () {


    $('#mailTrash').click(function () {
        var del_url = $(this).data('url');
        var checkbox = $('.magic-checkbox:checked');
        if (checkbox.length > 0) {

            bootbox.confirm("<h5>Selected mail(s) will be deleted permanently for everyone, Do you want to delete ?</h5>", function (result) {
                if (result) {
                    var checkbox_value = [];
                    $(checkbox).each(function () {
                        checkbox_value.push($(this).val());
                    });
                    $.ajax({
                        url: del_url,
                        method: "POST",
                        data: {
                            c_box: checkbox_value
                        },
                        success: function () {
                            fetchMails(1);
                            $.niftyNoty({
                                type: 'success',
                                message: '<div style="font-size:medium;width:auto;">Mail(s) deleted successfully.</div>',
                                container: 'floating',
                                timer: 5000
                            });
                        }
                    });
                }

            });
        } else {
            bootbox.alert("<h5>Select atleast one record</h5>", function () {
            });
        }
    });

    // Read
    $(document.body).on('click', '#mailRead', function () {
        var del_url = $(this).data('url');
        var checkbox = $('.magic-checkbox:checked');
        if (checkbox.length > 0) {
            var checkbox_value = [];
            $(checkbox).each(function () {
                checkbox_value.push($(this).val());
            });
            $.ajax({
                url: del_url,
                method: "POST",
                data: {
                    c_box: checkbox_value
                },
                success: function () {
                    fetchMails(1);
                }
            });

        } else {
            bootbox.alert("<h5>Select atleast one record</h5>", function () {
            });
        }
    });
    // Un Read
    $(document.body).on('click', '#mailUnRead', function () {
        var del_url = $(this).data('url');
        var checkbox = $('.magic-checkbox:checked');
        if (checkbox.length > 0) {
            var checkbox_value = [];
            $(checkbox).each(function () {
                checkbox_value.push($(this).val());
            });
            $.ajax({
                url: del_url,
                method: "POST",
                data: {
                    c_box: checkbox_value
                },
                success: function () {
                    fetchMails(1);
                }
            });

        } else {
            bootbox.alert("<h5>Select atleast one record</h5>", function () {
            });
        }
    });
    $(document.body).on('click', '#mailStarred', function () {
        var del_url = $(this).data('url');
        var checkbox = $('.magic-checkbox:checked');
        if (checkbox.length > 0) {
            var checkbox_value = [];
            $(checkbox).each(function () {
                checkbox_value.push($(this).val());
            });
            $.ajax({
                url: del_url,
                method: "POST",
                data: {
                    c_box: checkbox_value
                },
                success: function () {
                    fetchMails(1);
                }
            });

        } else {
            bootbox.alert("<h5>Select atleast one record</h5>", function () {
            });
        }
    });
    $(document.body).on('click', '#mailUnStarred', function () {
        var del_url = $(this).data('url');
        var checkbox = $('.magic-checkbox:checked');
        if (checkbox.length > 0) {
            var checkbox_value = [];
            $(checkbox).each(function () {
                checkbox_value.push($(this).val());
            });
            $.ajax({
                url: del_url,
                method: "POST",
                data: {
                    c_box: checkbox_value
                },
                success: function () {
                    fetchMails(1);
                }
            });

        } else {
            bootbox.alert("<h5>Select atleast one record</h5>", function () {
            });
        }
    });
    $(document.body).on('change', '#inputAttach', function () {
        var txt = '';
        var fles = $('#inputAttach')[0].files;
        txt += '<div class="row">'
        for (var i = 0; i < fles.length; i++) {
            txt += '<div class="col-lg-4">';

            var file = fles[i];
            txt += "<br><strong>" + (i + 1) + ". " + file.name.split('.').pop().toLowerCase() + "</strong><br>";
            if ('name' in file) {
                txt += "name: " + file.name + "<br>";
            }
            if ('size' in file) {
                var isSize = '';
                if (file.size > 1000000) {
                    txt += "size: " + ((file.size) / 1000000).toFixed(2) + " mb(s) <br>";
                } else if (file.size > 1000 && file.size < 1000000) {
                    txt += "size: " + ((file.size) / 1000).toFixed(2) + " kb(s) <br>";
                } else {
                    txt += "size: " + file.size.toFixed(2) + " bytes <br>";
                }

            }
            txt += '</div>';
            if (i % 3 == 2) {
                txt += '</div><div class="row">';
            }
        }
        txt += '</div>';

        $('#fList').html(txt);
    });


    $(document.body).on('click', '#mailSend', function () {
        var id = $('#inputName').data('id');
        var sub = $('#inputSubject').val();
        var cont = $('#demo-mail-compose').val();
        var tgs = $('#tagsinput').val();

        var urlMail = $('#mailSend').data('url');
        var fle = $('#inputAttach');
        var fles = $('#inputAttach')[0].files;
        var form_data = new FormData();

        for (var x = 0; x < fles.length; x++) {
            form_data.append("m_attachs[]", fles[x]);
        }

        form_data.append("rep_id", id);
        form_data.append("m_cont", cont);
        form_data.append("m_sub", sub);
        form_data.append("m_tgs", tgs);


        $.ajax({
            type: "POST",
            url: urlMail,
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            beforeSend: function () {
                $('#mailSend').html('<i class="demo-psi-mail-send icon-lg icon-fw"></i> Precessing...');
            },
            success: function (response) {
                console.log(response);
                $('#mailSend').html('<i class="demo-psi-mail-send icon-lg icon-fw"></i> Processed');
                setTimeout(location.reload.bind(location), 1000);
            },
            error: function () {
                $('#mailSend').html('<i class="demo-mail-send icon-lg icon-fw"></i> Error!');
                setTimeout(location.reload.bind(location), 1000);
            },


        });
    });
    var c_page = 0;
    var n_page = 2;
    var d_class = "disabled";
    var n_class = "btn_next";
    var p_class = "btn_prev";

    function fetchMails(page) {
        var fetchUrl = $("#typeMails").data('url');
        $.ajax({
            method: "POST",
            url: fetchUrl + page,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                if (response['t_count'] != 0) {
                    $('.mFilter').show();
                    $("#demo-mail-list").html(response['data']);
                    $(".mail_count").html("<strong>" + response['n_count'] + "-" + response['a_count'] + "</strong> of <strong>" + response['t_count'] + "</strong>");
                    c_page = response['p_nxt'];
                    n_page = response['m_nxt'];



                    if (response['a_count'] >= response['t_count']) {
                        $(".pB").addClass(d_class).removeClass(n_class);
                    } else {
                        $(".pB").addClass(n_class).removeClass(d_class);
                    }
                    if (response['n_count'] == 1) {
                        $(".pN").addClass(d_class).removeClass(p_class);

                    } else {
                        $(".pN").removeClass(d_class).addClass(p_class);
                    }
                } else {
                    $("#demo-mail-list").html(response['data']);
                    $(".mFilter").hide();
                }
                if (response['r_num'] > 0) {
                    $("#tMails").html("Inbox (" + response['r_num'] + ")");
                    $("#t_MAislUnRead").addClass("mail-nav-unread");
                } else {
                    $("#tMails").html("Inbox");
                    $("#t_MAislUnRead").removeClass("mail-nav-unread");
                }



            },
            error: function () {
                $('#loadAdmins').fadeOut(250);
            }

        });
    }

    fetchMails(1);
    $(document.body).on("click", "#demo-mail-ref-btn", function () {
        fetchMails(1);
    });
    $(document.body).on("click", ".btn_next", function () {
        fetchMails(c_page);
    });
    $(document.body).on("click", ".btn_prev", function () {
        fetchMails(n_page);
    });

});