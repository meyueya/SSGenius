(function($) {
    "use strict";

	$(document).ready(function() {
		$(".app-sidebar a").each(function() {
		  var pageUrl = window.location.href.split(/[?#]/)[0];
			if (this.href == pageUrl) {
				$(this).addClass("active");
				$(this).parent().addClass("active"); // add active to li of the current link
				$(this).parent().parent().prev().addClass("active"); // add active class to an anchor
				$(this).parent().parent().prev().click(); // click the item to make it drop
			}
		});
	});

	// ______________Full screen
	$("#fullscreen-button").on("click", function toggleFullScreen() {
      if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
          document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
          document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        } else if (document.documentElement.msRequestFullscreen) {
          document.documentElement.msRequestFullscreen();
        }
      } else {
        if (document.cancelFullScreen) {
          document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        }
      }
    })


// ______________ PAGE LOADING
	$(window).on("load", function(e) {
		$("#global-loader").fadeOut("slow");
	})

	// ______________ BACK TO TOP BUTTON

	$(window).on("scroll", function(e) {
    	if ($(this).scrollTop() > 0) {
            $('#back-to-top').fadeIn('slow');
        } else {
            $('#back-to-top').fadeOut('slow');
        }
    });

    $("#back-to-top").on("click", function(e){
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
	var ratingOptions = {
		selectors: {
			starsSelector: '.rating-stars',
			starSelector: '.rating-star',
			starActiveClass: 'is--active',
			starHoverClass: 'is--hover',
			starNoHoverClass: 'is--no-hover',
			targetFormElementSelector: '.rating-value'
		}
	};
	$(".rating-stars").ratingStars(ratingOptions);
	$(".vscroll").mCustomScrollbar();
	$(".app-sidebar").mCustomScrollbar({
		theme:"minimal",
		autoHideScrollbar: true,
		scrollbarPosition: "outside"
	});
	if ($('.chart-circle').length) {
		$('.chart-circle').each(function() {
			let $this = $(this);

			$this.circleProgress({
			  fill: {
				color: $this.attr('data-color')
			  },
			  size: $this.height(),
			  startAngle: -Math.PI / 4 * 2,
			  emptyFill: '#f6f6f6',
			  lineCap: 'round'
			});
		});
	  }
})(jQuery);

$(function(e) {
		  /** Constant div card */
	  const DIV_CARD = 'div.card';
	  /** Initialize tooltips */
	  $('[data-toggle="tooltip"]').tooltip();

	  /** Initialize popovers */
	  $('[data-toggle="popover"]').popover({
		html: true
	  });
			 /** Function for remove card */
	  $('[data-toggle="card-remove"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);

		$card.remove();

		e.preventDefault();
		return false;
	  });

	  /** Function for collapse card */
	  $('[data-toggle="card-collapse"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);

		$card.toggleClass('card-collapsed');

		e.preventDefault();
		return false;
	  });
	  $('[data-toggle="card-fullscreen"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);

		$card.toggleClass('card-fullscreen').removeClass('card-collapsed');

		e.preventDefault();
		return false;
	  });
  });
  
  	$(document).ready(function() {
  	    
  	    //if ($('.add-page').length > 0){
      	   $(document).on('click','.add-page',function(e){        
      	        e.preventDefault();
      	        var id_facebook_page = $(this).attr('id');
      	        var page_token = $(this).data('page-token');
      	        var id_facebook = $(this).data('id-facebook');
      	         var page = $(this).data('page');
      	        var html = '<span id="'+id_facebook_page+'" class="badge badge-warning">A&ntilde;adiendo...</span>';
      	        $( "#"+id_facebook_page ).replaceWith(html);
      	     	$.ajax({
                url: 'https://ssgenius.com/app/facebook/sincronize.php',
                dataType: "json",
                cache: false,
                type: "POST",
                data: {id_facebook_page: id_facebook_page,page_token: page_token,id_facebook: id_facebook},
                success: function(jsonObject,status) {
                    //console.log("function() ajaxPost : " + status);
                    var html = '<a href="#" class="text-warning quit-page" data-id-page="'+id_facebook_page+'" data-page-token="'+page_token+'" data-id-facebook="'+id_facebook+'" data-page="'+page+'">Quitar</a>';
                    var id = jsonObject.id_facebook_page;
                    $( "#"+id ).replaceWith(html);
                    console.log(jsonObject.id_facebook_page);
                    }
                });     
      	    });
  	  //  }
  	    
 $(document).on('click','.quit-page',function(e){
     e.preventDefault();
    var id_page = $(this).data('id-page');
    var page = $(this).data('page');
     var id_facebook_page = $(this).data('id-page');
     var page_token = $(this).data('page-token');
     var id_facebook = $(this).data('id-facebook');
     var thist = $(this);
       $.confirm({
        title: '<span style="color:#3B5998;">Quitar una p&aacute;gina de Facebook</span>',
        content: 'Deseo quitar <b>' + page + '</b> del SSG',
        type: 'red',
        typeAnimated: true,
        buttons: {
            Aceptar: {
                text: 'Aceptar',
                btnClass: 'btn-red',
                action: function(){
      	     	$.ajax({
                url: 'https://ssgenius.com/app/facebook/delete-page-user.php',
                dataType: "json",
                cache: false,
                type: "POST",
                data: {id_facebook_page: id_facebook_page, page_token: page_token, id_facebook: id_facebook},
                success: function(jsonObject,status) {
                    //console.log("function() ajaxPost : " + status);
                    var html = '<a href="#" id="'+id_facebook_page+'" data-page-token="'+page_token+'" data-id-facebook="'+id_facebook+'" class="btn btn-outline-primary btn-sm add-page">A&ntilde;adir</a>';
                    var id = jsonObject.id_facebook_page;
                    thist.replaceWith(html);
                    console.log(jsonObject.id_facebook_page);
                    }
                });  
                
                }
            },
            Cancelar: function () {
            }
        }
    }); 
});

//adaccount
      	   $(document).on('click','.add-adaccount',function(e){        
      	        e.preventDefault();
      	        var id_adaccount = $(this).attr('id');
      	        var id_facebook = $(this).data('id-facebook');
      	        var adaccount_name = $(this).data('adaccount-name');
      	        var adaccount_status = $(this).data('adaccount-status');
      	        var id_business = $(this).data('id-business');
      	        var business = $(this).data('business');
      	        var access_token = $(this).data('access-token');
      	        var html = '<span id="'+id_adaccount+'" class="badge badge-warning">A&ntilde;adiendo...</span>';
      	        $( "#"+id_adaccount ).replaceWith(html);
      	     	$.ajax({
                url: 'https://ssgenius.com/app/facebook/ajax/add-adaccount.php',
                dataType: "json",
                cache: false,
                type: "POST",
                data: {id_adaccount:id_adaccount, id_facebook:id_facebook, adaccount_name:adaccount_name, adaccount_status:adaccount_status, id_business:id_business, business:business, access_token:access_token},
                success: function(jsonObject,status) {
                    //console.log("function() ajaxPost : " + status);
                    var html = '<a href="#" class="text-warning quit-addacount" id="'+id_adaccount+'" data-id-adaccount="'+id_adaccount+'" data-id-facebook="'+id_facebook+'" data-access-token="'+access_token+'" data-adaccount-name="'+adaccount_name+'"  data-adaccount-status="'+adaccount_status+'" data-id-business="'+id_business+'" data-business="'+business+'">Quitar</a>';
                    var id = jsonObject.id_adaccount;
                    $("#"+id).replaceWith(html);
                   // console.log(jsonObject.id_adaccount);
                    }
                });     
      	    });


 $(document).on('click','.quit-addacount',function(e){ 
     e.preventDefault();
    var id_adaccount = $(this).data('id-adaccount');
    var id_facebook = $(this).data('id-facebook');
    var access_token = $(this).data('access-token');
    var name = $(this).data('adaccount-name');
    var adaccount_status = $(this).data('adaccount-status');
    var id_business = $(this).data('id-business');
    var business = $(this).data('business');
    var thist = $(this);
       $.confirm({
        title: '<span style="color:#3B5998;">Quitar una cuenta publicitaria de Facebook</span>',
        content: 'Deseo quitar <b>' + name + '</b> del SSG',
        type: 'red',
        typeAnimated: true,
        buttons: {
            Aceptar: {
                text: 'Aceptar',
                btnClass: 'btn-red',
                action: function(){
      	     	$.ajax({
                url: 'https://ssgenius.com/app/facebook/ajax/delete-adaccount.php',
                dataType: "json",
                cache: false,
                type: "POST",
                data: {id_adaccount: id_adaccount, access_token: access_token},
                success: function(jsonObject,status) {
                    //console.log("function() ajaxPost : " + status);
                    var html = '<a href="#" id="'+id_adaccount+'" data-id-facebook="'+id_facebook+'" data-adaccount-name="'+name+'" data-adaccount-status="'+adaccount_status+'" data-id-business="'+id_business+'" data-business="'+business+'" data-access-token="'+access_token+'" class="btn btn-outline-primary btn-sm add-adaccount">Añadir</a>';
                    var id = jsonObject.id_adaccount;
                    thist.replaceWith(html);
                    console.log(jsonObject.id_facebook_page);
                    }
                });  
                
                }
            },
            Cancelar: function () {
            }
        }
    }); 
});

  	    $('a.slide-item').click ( function(){
  	        //console.log('o0');
  	        var src = $(this).data('src');
  	        $('a.slide-item').removeClass('active');
  	        $(this).addClass('active');
  	        //console.log(src);
  	     $('#pagef').attr('src', "ssg?psid="+src);   
  	        
  	    });

 $(document).on('click','.app-sidebar__toggle',function(e){  
     var clase = $('#mCSB_1_container').hasClass('mCS_y_hidden');
     if ($("body").hasClass("sidenav-toggled")) {
         $('.header-brand').css({'min-width':'40px','width':'40px','transition': 'width 0.5s'});
        // console.log('hay clase');
     } else {
         $('.header-brand').css({'min-width':'200px','width':'220px','transition': 'width 0.5s'});
         
        // console.log('no hay clase');
     }
 });
 
 $(".app-sidebar").on({
    mouseenter: function () {
        if ($("body").hasClass("sidenav-toggled")) {
             $('.header-brand').css({'min-width':'40px','width':'40px','transition': 'width 0.5s'}); 
           // console.log('el body tiene la clase');
        }else{  
             $('.header-brand').css({'min-width':'200px','width':'220px','transition': 'width 0.5s'});
           // console.log('el body no tiene la clase');
            
        }
        
    },
    mouseleave: function () {
       // console.log('salio el mouse');
    }
});


	});


