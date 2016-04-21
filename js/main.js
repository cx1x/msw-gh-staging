jQuery(document).ready(function(event){
	var isAnimating = false,
	newLocation = '';
	firstLoad = false;
  
  
  console.log('js in!');
  
  
  
	//trigger smooth transition from the actual page to the new one 
	$('main').on('click', '[data-type="page-transition"]', function(event){
		event.preventDefault();
		isAnimating = false;
		//detect which page has been selected
		var newPage = $(this).attr('href');
		// console.log(newPage);
		//if the page is not already being animated - trigger animation
		if( !isAnimating ) changePage(newPage, true);
		firstLoad = true;
	});


	$('#dog-search-button').on('click', function(){
		//alert('yummy');
	});
	/*  $(window).bind('beforeunload',function(){

	//save info somewhere

	return 'are you sure you want to leave?';

	}); */

	//detect the 'popstate' event - e.g. user clicking the back button
	$(window).on('popstate', function() {
		if( firstLoad ) {
			/*
			Safari emits a popstate event on page load - check if firstLoad is true before animating
			if it's false - the page has just been loaded 
			*/
			var newPageArray = location.pathname.split('/'),
			//this is the url of the page to be loaded 
			newPage = newPageArray[newPageArray.length - 1];

			if( !isAnimating  &&  newLocation != newPage ) changePage(newPage, false);
		}
		firstLoad = true;
	});

	function changePage(url, bool) {
		isAnimating = true;
		// trigger page animation
		$('body').addClass('page-is-changing');
		
			loadNewContent(url, bool);
			newLocation = url;
			
		$('.cd-loading-bar').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
		
			loadNewContent(url, bool);
			newLocation = url;
			$('.cd-loading-bar').off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
		});
		//if browser doesn't support CSS transitions
		if( !transitionsSupported() ) {
			loadNewContent(url, bool);
			newLocation = url;
		}
	}

	function loadNewContent(url, bool) {
		url = ('' == url) ? 'index.php' : url;
		var newSection = 'cd-'+url.replace('.php', '');
		var section = $('<div class="cd-main-content '+newSection+'"></div>');
		console.log(section);

		section.load(url+' .cd-main-content > *', function(event){
			// load new content and replace <main> content with the new one
			$('main').html(section);
			//if browser doesn't support CSS transitions - dont wait for the end of transitions
			var delay = ( transitionsSupported() ) ? 1200 : 0;
			setTimeout(function(){
			
				//wait for the end of the transition on the loading bar before revealing the new content
				( section.hasClass('cd-about') ) ? $('body').addClass('cd-about') : $('body').removeClass('cd-about');
				$('body').removeClass('page-is-changing');
				$('.cd-loading-bar').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				isAnimating = false;
				$('.cd-loading-bar').off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
				});
				
				// if (/predictor/i.test(newSection)){	
					
					
					// $('#predictor-dog-1').animate({ left: '100%'}, 2500, 'swing');
					// $('#predictor-dog-2').animate({ left: '27%'}, 2500, 'swing');
					// $('#predictor-dog-3').animate({ left: '63%'}, 2500, 'swing');
					// $('#predictor-dog-4').animate({ left: '84%'}, 2500, 'swing');
					// $('#predictor-dog-5').animate({ left: '95%'}, 2500, 'swing');
					// $('#predictor-dog-6').animate({ left: '60%'}, 2500, 'swing');
				
				// }
				
				if (/dogperf-list/i.test(newSection)){
				
					$('#datetimepicker12').datetimepicker({
						inline: true,
						format: 'YYYY-MM-DD',
						maxDate : 'now',
						minDate : '02/16/2016',
						showTodayButton: true
					});
				
				}
				
				$('#datetimepicker12').datetimepicker({
					inline: true,
					format: 'YYYY-MM-DD',
					maxDate : 'now',
					minDate : '02/16/2016',
					showTodayButton: true
				});
					
				$("#selectDate").click(function(){
					var selectedDate = $('#selectedDate').val();
					// var _href = $(this).attr("href");
					$(this).attr("href", "/greyhoundbet-staging/result/" + selectedDate);
				});
					
				$("#dog-search-text").keyup(function() {
		            var $th = $(this);
		            $th.val( $th.val().replace(/[^a-zA-Z ]/g, function(str) { alert('You typed " ' + str + ' ".\n\n Please use only letters.'); return ''; } ) );
		        });
				$( "#dog-search-button" ).click(function() {
				  //alert( $("#dog-search-text").val() );
				  window.location.href = "/greyhoundbet-staging/search-result/1/" + $("#dog-search-text").val();
				  //$(this).attr("href", "greyhoundbet-staging/search-result/1/" + $("#dog-search-text").val());
				});

				if( !transitionsSupported() ) isAnimating = false;
				
			}, delay);

			if(url!=window.location && bool){
				//add the new page to the window.history
				//if the new page was triggered by a 'popstate' event, don't add it
				window.history.pushState({path: url},'',url);
			}
		});
	}

	function transitionsSupported() {
		return $('html').hasClass('csstransitions');
	}

});