(function($){

    $(window).load(function(){
        $('.threads-filter a').click(function(e){
            e.preventDefault();

            var str = $(this).attr('href');
            if( $(this).hasClass('active') ) {
                $("#24lb_list .blogdiv").show();
                $(this).removeClass('active');

            }else{
                $("#24lb_list .blogdiv").hide();
                $("#24lb_list .blogdiv:contains('"+str+"')").show();

                $('.threads-filter a').removeClass('active'); 
                $(this).addClass('active');
            }
        });

        $(".owl-carousel").owlCarousel({
            items: 4,
            navigation:true,
            navigationText: [
                "<i class='icon-chevron-left icon-white'></i>",
                "<i class='icon-chevron-right icon-white'></i>"
            ],
        });
    });

})(jQuery);


