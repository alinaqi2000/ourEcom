$(document).ready(function () {

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
                        // window.location.reload();
                    } else {
                        $('.layOut').addClass("mainnav-sm");
                        $('.layOut').removeClass("mainnav-lg");
                        
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




});