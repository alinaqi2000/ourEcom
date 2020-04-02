// Mails
$(document.body).ready(function () {



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
        var max_sub = $('#inputSubject').val().length;
        var cont = $('#demo-mail-compose').val();
        var max_cnt = $('#demo-mail-compose').val().length;
        // filename.split('.').pop();
        if (max_sub > 0 && id > 0) {
            if (max_sub < 255) {
                if (max_cnt < 600000) {

                    var tgs = $('#tagsinput').val();

                    var urlMail = $('#mailSend').data('url');
                    var fle = $('#inputAttach');
                    var fles = $('#inputAttach')[0].files;
                    var form_data = new FormData();

                    for (var x = 0; x < fles.length; x++) {
                        form_data.append("m_attachs[]", fles[x]);
                        // console.log(fles[x]);

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
                            $('#cond').show();
                            $('#cond').html('<div style="float:left;"><i class="fa fa-spinner fa-spin"></i></div>');
                        },
                        success: function (response) {
                            // console.log(response);
                            $('#cond').show();
                            $('#cond').html('<span class="text-success"><strong>Processed</strong></span>');
                            setTimeout(location.reload.bind(location), 1000);
                        },
                        error: function () {
                            $('#cond').show();
                            $('#cond').html('<span class="text-danger">Error!</span>');
                            setTimeout(location.reload.bind(location), 1000);
                        },


                    });
                } else {
                    $('#cond').show();
                    $('#cond').html('<span class="text-danger">Characters limit(600000) exceed in mail Content. Current size : <b>' + max_cnt + '</b></span>');
                }
            } else {
                $('#cond').show();
                $('#cond').html('<span class="text-danger">Characters limit exceed in mail Subject!</span>');
            }
        } else {
            $('#cond').show();
            $('#cond').html('<span class="text-danger">Please fill in all required fields!</span>');
        }
    });
    var c_page = 0;
    var c_mode = 'normal';
    var n_page = 2;
    var d_class = "disabled";
    var n_class = "btn_next";
    var p_class = "btn_prev";
    var showpage = 1;
    var showMax = $("#mailCookie").data('cokie');
    function fetchMails(page, max, mode = 'normal') {
        if (mode != c_mode) {
            page = 1;
        }
        showMax = $("#mailCookie").data('cokie');


        var fetchUrl = $("#typeMails").data('url');
        $.ajax({
            method: "POST",
            url: fetchUrl + page + '/' + max + '/' + mode,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                if (response['t_count'] != 0) {
                    $('.mFilter').show();
                    $("#mailTrash").show();
                    $("#demo-mail-list").html(response['data']);
                    $(".mail_count").html("<strong>" + response['n_count'] + "-" + response['a_count'] + "</strong> of <strong>" + response['t_count'] + "</strong>");
                    c_page = response['p_nxt'];
                    n_page = response['m_nxt'];
                    c_mode = response['mode'];
                    showMax = response['max'];
                    $("#mailCookie").attr("data-cokie", response['max']);
                    showpage = response['c_page'];
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
                    $("#mailTrash").hide();
                }
                if (response['r_num'] > 0) {
                    $("#tMails").html("<span title='" + response['r_num'] + " unread mails'>Inbox (" + response['r_num'] + ")</span>");
                    $("#t_MAislUnRead").addClass("mail-nav-unread");
                    $("#mailsNoti").addClass("ion-email-unread");
                    $("#mailsNoti").removeClass("ion-email");
                } else {
                    $("#tMails").html("Inbox");
                    $("#t_MAislUnRead").removeClass("mail-nav-unread");
                    $("#mailsNoti").removeClass("ion-email-unread");
                    $("#mailsNoti").addClass("ion-email");
                }



            },
            error: function () {
                $('#loadAdmins').fadeOut(250);
            }

        });
    }
    var showFirstMax = $("#mailCookie").data('cokie');
    fetchMails(showpage, showFirstMax, c_mode);
    $(document.body).on("change", "#mailMax", function () {
        showMax = $('#mailMax').val();
        // console.log(showMax);
        fetchMails(showpage, showMax, c_mode);
    });
    $(document.body).on("click", "#showAllMails", function () {
        fetchMails(1, showMax, 'normal');
    });

    $(document.body).on("click", "#showStarred", function () {
        fetchMails(showpage, showMax, 'starred');
    });
    $(document.body).on("click", "#showUnStarred", function () {
        fetchMails(showpage, showMax, 'unstarred');
    });
    $(document.body).on("click", "#showRead", function () {
        fetchMails(showpage, showMax, 'read');
    });
    $(document.body).on("click", "#showUnRead", function () {
        fetchMails(showpage, showMax, 'unread');
    });
    $(document.body).on("click", "#demo-mail-ref-btn", function () {
        fetchMails(1, showMax, 'normal');
    });
    $(document.body).on("click", ".btn_next", function () {
        fetchMails(c_page, showMax, c_mode);
    });
    $(document.body).on("click", ".btn_prev", function () {
        fetchMails(n_page, showMax, c_mode);
    });
    $('#mailTrash').click(function () {
        var del_url = $(this).data('url');
        var checkbox = $('.magic-checkbox:checked');
        if (checkbox.length > 0) {

            bootbox.confirm("<h5>Selected mail(s) will be deleted permanently for you, Do you want to delete ?</h5>", function (result) {
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
                            fetchMails(1, showMax, c_mode);
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
                    fetchMails(showpage, showMax, c_mode);
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
                    fetchMails(showpage, showMax, c_mode);
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
                    fetchMails(showpage, showMax, c_mode);
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
                    fetchMails(showpage, showMax, c_mode);
                }
            });

        } else {
            bootbox.alert("<h5>Select atleast one record</h5>", function () {
            });
        }
    });
});