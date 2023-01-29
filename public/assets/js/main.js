
// Hide desc
$(document).ready(function() {
    // 250 characters are shown by default
    let showChar = 250;
    let dots = ".... ";
    let moreText = "More";
    let lessText = "Less";

    // $.widget.bridge('uibutton', $.ui.button)

    $('.show-text').each(function() {
        let content = $(this).html();

        if(content.length > showChar) {

            let cont = content.substr(0, showChar);
            let restOfTheText = content.substr(showChar, content.length - showChar);

            let html = cont + '<span class="dots">' + dots + '</span><span class="morecontent"><span>' + restOfTheText + '</span><a href="" class="morelink">' + moreText + '</a></span>';

            $(this).html(html);
        }

    });
    $(".morelink").click(function() {
        if($(this).hasClass("test")) {
            $(this).removeClass("test");
            $(this).html(moreText);
        } else {
            $(this).addClass("test");
            $(this).html(lessText);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});

