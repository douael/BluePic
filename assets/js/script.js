var currentLocation = window.location.pathname.split('/');
current = currentLocation[2];
$(document).ready(function () {
        var url = window.location;
    // Will only work if string in href matches with location
        $('ul#navigationBE a[href="' + url + '"]').parent().addClass('active');

    // Will also work for relative and absolute hrefs
        $('ul#navigationBE a').filter(function () {
            return this.href == url;
        }).parent().addClass('active').parent().parent().addClass('active');
    });
