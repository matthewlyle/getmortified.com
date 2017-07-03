Mortified = {
	spotlight: function(){
		jQuery('.js-slick-slider').slick({
			slide: '.js-slick-slide',
			dots: true,
			fade: true,
			lazyLoad: 'ondemand',
			mobileFirst: true,
            autoplay: true,
            adaptiveHeight: true
		})
	},

	nav: function(){
		jQuery('siteNav__item').click(function(){
			jQuery(this).addClass('is-active')
		})

		jQuery('header img, header nav a, footer a').click(function(){
			jQuery('header nav a').removeClass('is-active');
		})
	},

	responsiveNav: function(){
		var $trigger = jQuery('.responsiveNavTrigger').unbind();
		var $nav = jQuery('.siteNav');

		function showOrHide() {
			if (jQuery(window).width() > 1075) {
				$nav.show();
			}
			if (jQuery(window).width() < 1075) {
				$nav.hide();
			}
		}

		showOrHide();
		jQuery(window).resize(showOrHide);

		$trigger.click(function(){
			if (jQuery(window).width() < 1075) {
				jQuery(this).addClass('is-active');
				$nav.slideToggle();
			}
		})

		$nav.find('a').click(function(){
			if (jQuery(window).width() < 1075) {
				$nav.slideUp();
			}
		})

	}
}

jQuery(function(){
	Mortified.spotlight();
	Mortified.nav();
	Mortified.responsiveNav();
})

$(window).resize(function() {
  $('.js-slick-slider').slick('resize');
});

jQuery(document).ready(function($) {
    $(window).resize(function() {
        MortifiedPlayer.interface.controls();
    });
    $(document).ready(function() {
        MortifiedPlayer.interface.controls();
        $.get('/podcast-player/proxy.php', function(data) {
            var $items = $(data).find('item'),
                arr = [];
            $items.each(function(i) {
                var $this = $(this),
                    item = {
                        title: $this.find('title').text(),
                        desc: $this.find('description').text(),
                        mp3: $this.find('enclosure').attr('url'),
                        date: $this.find('pubDate').text(),
                        poster: $this.find('itunes\\:image, image').attr('href')
                    }
                arr.push(item);
            });
            new jPlayerPlaylist({
                jPlayer: "#podcast_player",
                cssSelectorAncestor: "#podcast_player_container"
            }, arr, {
                swfPath: "assets/js/lib-jplayer/Jplayer.swf",
                supplied: "mp3",
                wmode: "window",
                preload: "auto",
                autoplay: true,
                ready: function(e) {
                    var poster = $(this).find('img').attr('src'),
                        track = arr[0];
                    first = {
                        title: track.title,
                        desc: track.desc,
                        mp3: track.mp3,
                        poster: track.poster
                    };
                    MortifiedPlayer.updateCurrent(first);
                    $('.podcast-player').addClass('is-ready');
                },
                loadeddata: function() {
                    $('.jp-current-time, .jp-duration').show();
                },
                seeking: function() {
                    $('.jp-seek-bar').css('width', '100%')
                },
                play: function(e) {
                    $('.jp-current-time, .jp-duration').hide();
                    MortifiedPlayer.updateCurrent(e.jPlayer.status.media);
                },
                playing: function() {
                    $('.jp-current-time, .jp-duration').show();
                }
            });
            $('.jp-sound').click(function() {
                $('.jp-volume-bar-container').slideToggle('fast');
            })
            $('.view-more, .podcast-player__title').click(function() {
                MortifiedPlayer.interface.expandedView();
            })
        });
    });
    var MortifiedPlayer = {
        updateCurrent: function(track) {
            var $details = $('.podcast-player__details'),
                heading = ($('.podcast-player__more').is(":visible")) ? 'Now playing' : track.title;
            $('.podcast-player__title').text(heading);
            $details.find('img').attr('src', track.poster);
            $details.find('h2').text(track.title);
            $details.find('p').text(track.desc);
        },
        interface: {
            expandedView: function() {
                if ($('.podcast-player__more').is(':visible')) {
                    var title = $('.podcast-player__details h2').text();
                    console.log(title);
                    $('.podcast-player').removeClass('is-open');
                    $('.podcast-player__title').text(title);
                    $('.podcast-player__more').hide();
                    $('.view-more').attr('src', '/podcast-player/images/playlist.png');
                } else {
                    $('.podcast-player').addClass('is-open');
                    $('.podcast-player__title').text('Now playing');
                    $('.podcast-player__more').slideDown('fast');
                    $('.view-more').attr('src', '/podcast-player/images/close.png');
                }
            }, controls: function() {
                var controls = {
                        first: $('.jp-controls').first(),
                        last: $('.jp-controls').last(),
                        play: $('.jp-play, .jp-pause').parent(),
                        prev: $('.jp-next').parent(),
                        next: $('.jp-prev').parent(),
                        sound: $('.jp-sound').parent(),
                        subscribe: $('.podcast-player-top .inline-list li').first(),
                        more: $('.podcast-player-top .inline-list li').last()
                    },
                    w = $(window).width();
                if (w < 750) {
                    controls.sound.appendTo(controls.first);
                    controls.play.insertBefore(controls.next);
                    controls.more.hide();
                    $('.podcast-player__more').hide();
                } else if (w > 750) {
                    $('.jp-sound').parent().appendTo($('.jp-controls').last())
                    controls.play.prependTo(controls.first);
                    controls.more.show();
                }
            }
        }
    }
});

jQuery(document).ready(function($) {
    $('#subscribe-to-podcast').click(function() {
        window.location = 'https://itunes.apple.com/us/podcast/the-mortified-podcast/id964902342?mt=2';
    })
})


// ajax tweaks

// jQuery('header a').click(function(){
//     setTimeout(
//     function() {
//         Mortified.spotlight();
//     }, 1000);
// })

jQuery('header nav a').click(function(){
    jQuery('header nav a').removeClass('is-active');
    jQuery(this).addClass('is-active');
})

// guide menu

// $(function(){
//     $('li:not(current-menu-ancestor) .sub-menu').hide();
//     $('.menu-item-has-children').click(function(e){
//         e.preventDefault();

//         $(this).toggleClass('is-open');
//         $(this).find('.sub-menu').fadeToggle('fast');
//     })

//     $('.menu-item').click(function(){
//          $('.menu-item-has-children:not(current-menu-ancestor) .sub-menu').fadeOut('fast');
//     })
// })
