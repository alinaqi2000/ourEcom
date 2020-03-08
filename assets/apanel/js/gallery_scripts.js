jQuery(document).ready(function ($) {

    var c_page = 0;
    var n_page = 2;
    var d_class = "disabled";
    var n_class = "btn_next";
    var p_class = "btn_prev";

    function fetchGalls(page) {
        var fetchUrl = $("#demo-gallery").data('url');
        $.ajax({
            method: "POST",
            url: fetchUrl + page,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                if (response['t_count'] != 0) {
                    $('#editGall').show();
                    $("#demo-gallery").html(response['data']);
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
                    $("#demo-gallery").html(response['data']);
                    $(".mFilter").hide();
                    $('#editGall').hide();

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

    fetchGalls(1);

    $(document.body).on("click", "#demo-mail-ref-btn", function () {
        fetchGalls(1);
    });
    $(document.body).on("click", ".btn_next", function () {
        fetchGalls(c_page);
    });
    $(document.body).on("click", ".btn_prev", function () {
        fetchGalls(n_page);
    });
    $('#editGall').on("click", function () {
        $('.gCheckbox').toggle();
        $('#dGall').toggle();
    });

    $('#galleryTrash').click(function () {
        var del_url = $(this).data('url');
        var checkbox = $('.magic-checkbox:checked');
        if (checkbox.length > 0) {

            bootbox.confirm("<h5>Selected image(s) will be deleted permanently, Do you want to delete ?</h5>", function (result) {
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
                            fetchGalls(1);
                            $('.gCheckbox').toggle();
                            $('#dGall').toggle();
                            $.niftyNoty({
                                type: 'success',
                                message: '<div style="font-size:medium;width:auto;">Image(s) deleted successfully.</div>',
                                container: 'floating',
                                timer: 5000
                            });
                        }
                    });
                }

            });
        } else {
            bootbox.alert("<h5>Select atleast one record</h5>", function () { });
        }
    });

});
