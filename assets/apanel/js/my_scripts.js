$(document.body).ready(function () {


    // Sidebar setting remove
    $('#demo-nifty-settings').remove();

    // Topbar Logo Toggle 
    $('#sideButton').click(function () {

        var themeUrl = $(this).data('url');
        var sideMode = $(this).data('mode');
        $.ajax({
            dataType: 'JSON',
            url: themeUrl,
            type: 'POST',
            async: true,
            data: {
                mode: sideMode,
            },
            success: function (response) {
                console.log(response);
                if (response) {
                    if (response['mode'] == "closed") {
                        $('.layOut').addClass("mainnav-lg");
                        $('.layOut').removeClass("mainnav-sm");
                        $('#brandLogo').show();
                        $('#brandFav').hide();
                        $('#sideIcon').removeClass('ti-view-list-alt');
                        $('#sideIcon').addClass('ti-view-list');
                        // window.location.reload();
                    } else {
                        $('.layOut').addClass("mainnav-sm");
                        $('.layOut').removeClass("mainnav-lg");
                        $('#sideIcon').addClass('ti-view-list-alt');
                        $('#sideIcon').removeClass('ti-view-list');
                        $('#brandLogo').hide();
                        $('#brandFav').show();
                        // window.location.reload();
                    }
                }
            }
        });



    });

    // Dark Mode Ajax

    $('#darkColor').click(function () {
        var darkSheet = $(this).data('dark');
        var lightSheet = $(this).data('light');
        var themeUrl = $(this).data('url');
        var themeMode = $(this).data('mode');
        $('#dark_sheet').attr("href", darkSheet);
        $.ajax({
            dataType: 'JSON',
            url: themeUrl,
            type: 'POST',
            async: true,
            data: {
                mode: themeMode,
                light: lightSheet,
                dark: darkSheet
            },
            success: function (response) {
                console.log(response);
                if (response) {
                    if (response['mode'] == 'dark') {
                        $('#dark_sheet').attr("href", darkSheet);
                        $('#moonIcon').hide();
                        $('#moonImg').show();
                        // window.location.reload();
                    } else {
                        $('#dark_sheet').attr("href", lightSheet);
                        $('#moonIcon').show();
                        $('#moonImg').hide();
                        // window.location.reload();
                    }
                }
            }
        });
    });

    // Status Buttton ajax


    $(document).on('click', '.statusBtn', function () {
        var statusUrl = $(this).data('url');
        var statusId = $(this).data('id');
        var statusField = $(this).data('field');
        var statusValue = $(this).data('value');
        $.ajax({
            url: statusUrl,
            method: 'POST',
            data: {
                id: statusId,
                field: statusField,
                value: statusValue,
            },
            success: function (response) {
                console.log(response);
                if (response == '0') {
                    $('#pageStatus' + statusId).removeClass('btn-success');
                    $('#pageStatus' + statusId).html('InActive');
                    $('#pageStatus' + statusId).addClass('btn-danger');
                    $('#pageStatus' + statusId).attr('data-value', response);
                    $('#pageStatus' + statusId).attr('title', 'Click to Active');

                } else {
                    $('#pageStatus' + statusId).removeClass('btn-danger');
                    $('#pageStatus' + statusId).html('Active');
                    $('#pageStatus' + statusId).addClass('btn-success');
                    $('#pageStatus' + statusId).attr('data-value', response);
                    $('#pageStatus' + statusId).attr('title', 'Click to Inactive');
                }

            }
        });
    });

    // Starred Button ajax

    $(document.body).on('click', '.starredBtn', function () {
        var statusUrl = $(this).data('url');
        var statusId = $(this).data('id');
        var statusField = $(this).data('field');
        var statusValue = $(this).data('value');
        $.ajax({
            url: statusUrl,
            method: 'POST',
            data: {
                id: statusId,
                field: statusField,
                value: statusValue,
            },
            success: function (response) {
                console.log(response);
                if (response == '0') {
                    $('#listItem' + statusId).removeClass('mail-starred');
                    $('#stars' + statusId).attr('data-value', response);
                } else {
                    $('#listItem' + statusId).addClass('mail-starred');
                    $('#stars' + statusId).attr('data-value', response);

                }

            }
        });
    });



    // Label Buttton ajax


    $(document).on('click', '.labelBtn', function () {
        var statusUrl = $(this).data('url');
        var statusId = $(this).data('id');
        var statusField = $(this).data('field');
        var statusValue = $(this).data('label');
        $.ajax({
            url: statusUrl,
            method: 'POST',
            data: {
                id: statusId,
                field: statusField,
                value: statusValue,
            },
            success: function (response) {
                console.log(response);
                location.reload();

            }
        });
    });

    // Order Ajax

    $(document.body).on('click', '.orders', function () {
        $('.txtedit').hide();
        $(this).next('.txtedit').show().focus();
        $(this).hide();
    });


    $(document.body).on('focusout', '.txtedit', function () {
        var edit_id = $(this).data('id');
        var orderUrl = $(this).data('url');
        var fieldname = $(this).data('order');
        var value = $(this).val();
        $(this).hide();
        $(this).prev('.orders').show();
        $(this).prev('.orders').text(value);
        $.ajax({
            url: orderUrl,
            method: 'POST',
            data: { order: fieldname, value: value, id: edit_id },
            success: function (response) {
                console.log(response);

            }
        });
    });



    $(document.body).on('click', '.close', function () {
        $('#alrt').removeClass('in');
        $('#alrt').addClass('fadeOut');
        $('#floating-top-right').fadeOut(1000);

    });

    // Admin Search
    $(document.body).on('keyup', '#inputName', function () {

        var name = $('#inputName').val();
        if (name == '') {
            $("#loadAdmins").fadeOut(250);
        } else {
            $('#loadAdmins').fadeIn(250);
            var urlAdmins = $(this).data('url');
            $.ajax({
                method: "POST",
                url: urlAdmins,
                data: {
                    search: name,
                },
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    $("#loadAdmins").html(response);
                },
                error: function () {
                    $('#loadAdmins').fadeOut(250);
                }

            });
        }
    });

    $(document.body).on('click', '.selectAdmin', function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#inputName').val(name);
        $('#inputName').attr('data-id', id);
        $('#loadAdmins').fadeOut(250);

    });




});
