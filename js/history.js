var width = $( window ).width();
if (width < 500) {
    shrink_dates();
}


function shrink_dates() {
    $('.date').each(function() {
        var date = new Date($(this)[0].innerText);
        //console.log(date);
        var output = (date.getMonth() + 1) + '-' + (date.getDate() + 1);
        $(this).text(output);
    });
}
