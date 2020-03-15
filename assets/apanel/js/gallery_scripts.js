
var c_page = 0;
var n_page = 2;
var c_mode = '';
var d_class = "disabled";
var n_class = "btn_next";
var p_class = "btn_prev";
function fetchGalls(page, mode) {

    var fetchUrl = $("#demo-gallery").data('url') + page + '/' + mode;


    $.ajax({
        method: "POST",
        url: fetchUrl,
        dataType: "JSON",
        success: function (response) {
            console.log(response);
            if (response['t_count'] != 0) {
                $('#editGall').show();
                $("#demo-gallery").html(response['data']);
                $(".mail_count").html("<strong>" + response['n_count'] + "-" + response['a_count'] + "</strong> of <strong>" + response['t_count'] + "</strong>");
                c_page = response['p_nxt'];
                n_page = response['m_nxt'];
                c_mode = response['c_mode'];

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
jQuery(document).ready(function ($) {

    // var myModule = {};
    // $(function () {
    //     var foo = function () {/*code*/ };
    //     myModule.bar = foo;
    // });




    // $("#loadGals").load(function () {
    //     fetchGalls(1);
    // });

    $(document.body).on("click", ".btn_next", function () {
        fetchGalls(c_page, c_mode);
        $('#dGall').hide();
    });
    $(document.body).on("click", ".btn_prev", function () {
        fetchGalls(n_page, c_mode);
        $('#dGall').hide();
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
                            fetchGalls(1, c_mode);
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




    // Pop Up
    $(document.body).on('click', '#closeGal', function () {
        $('#galPop').removeClass('fadeIn');
        $('#galPop').addClass('fadeOut');
        $('.pad-all').removeClass('zoomInDown');
        $('body').removeClass('modal-open');
        $('.pad-all').addClass('zoomOutDown');

        setTimeout(function () {
            $('#galPop').hide();
            $('.photos').html(' ');
            $('#container').css('z-index', '1');

        }, 1000);


    });
    $(document.body).on('click', '.galShow', function () {
        $('#galPop').addClass('fadeIn');
        $('.pad-all').addClass('zoomInDown');

        fetchGalls(1, c_mode);
        $('.pad-all').removeClass('zoomOutDown');
        $('#galPop').removeClass('fadeOut');
        $('body').addClass('modal-open');
        $('#container').css('z-index', '0');
        $('#galPop').show();

    });

    $(document.body).on('click', '#browseType', function () {

        $('#typeImg').val('browse');
    });
    $(document.body).on('click', '#saveGal', function () {
        var n = $("input:checked");
        if (n.length > 0) {
            var src = n.data('path');
            var file = n.data('file');

            // var newFile=src+
            // console.log(src);
            $('#recImg').attr('src', src + file);



            // 
            $('#typeImg').val('gallery');
            $('#newImg').val(file);
            $('#galPop').removeClass('fadeIn');
            $('#galPop').addClass('fadeOut');
            $('.pad-all').removeClass('zoomInDown');
            $('body').removeClass('modal-open');
            $('.pad-all').addClass('zoomOutDown');
            setTimeout(function () {
                $('#galPop').hide();
                $('#container').css('z-index', '1');
                $('.photos').html(' ');

            }, 1000);
        }
        else {
            bootbox.alert("<h5>Select atleast one record</h5>", function () { });
        }
    });


});
