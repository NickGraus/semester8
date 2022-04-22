$(document).ready(function(){


	$("a.hamburger").click(function(){

        toggleMenu();

	});


    $(".opacity-bg").click(function(){

        toggleMenu();

    });

    function toggleMenu(){
        $("a.hamburger").toggleClass("is-active");
        $(".navbar-collapse").toggleClass("collapsed");
        $(".header-collapse").toggleClass("active");
        $(".body").toggleClass("scroll-lock");
    }

	$(".mobile-dropdown-arrow").click(function(event){
        event.preventDefault();
        if($(this).siblings(".mobile-dropdown").hasClass("opened")) {
            $(this).siblings(".mobile-dropdown").removeClass("opened").siblings(".sub-list").slideUp();
        }
        else {
            $(this).siblings(".mobile-dropdown").parent().siblings().find("a.mobile-dropdown").removeClass("opened").siblings(".sub-list").slideUp();
            $(this).siblings(".mobile-dropdown").addClass("opened").siblings(".sub-list").slideDown();
        }

    });


    $(".current-menu-parent > a.mobile-dropdown-arrow, .current_page_ancestor > a.mobile-dropdown-arrow").addClass("opened");
    $(".mobile-menu-item.current_page_item").parents(".sub-list").show();


});