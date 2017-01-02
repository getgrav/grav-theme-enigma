var isTouch = window.DocumentTouch && document instanceof DocumentTouch;

function scrollHeader() {
    // Has scrolled class on header

    if ($("#header").hasClass('fixed')) {
        var zvalue = $(document).scrollTop();
        if ( zvalue > 75 )
            $("#header").addClass("scrolled");
        else
            $("#header").removeClass("scrolled");
    }
}

jQuery(document).ready(function($){

    // call every load
    scrollHeader();

    // ON SCROLL EVENTS
    if (!isTouch){
        $(document).scroll(function() {
            scrollHeader();
        });
    };

    // TOUCH SCROLL
    $(document).on({
        'touchmove': function(e) {
            scrollHeader(); // Replace this with your code.
        }
    });

    //Smooth scroll to start
    $('#to-start').click(function(){
        var start_y = $('#body-wrapper').position().top;
        var header_offset = 57;
        window.scroll({ top: start_y - header_offset, left: 0, behavior: 'smooth' });
        return false;
    });

    //Smooth scroll to top
    $('#to-top').click(function(){
        window.scroll({ top: 0, left: 0, behavior: 'smooth' });
        return false;
    });


});


