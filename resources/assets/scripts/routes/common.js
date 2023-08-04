import UIkit from 'uikit';
import Cookies from 'js-cookie';
import 'url-search-params-polyfill';

export default {
  init() {
    // This is kind of convoluted, but in order to load the correct nav,
    // Use a browser redirect when coming from the old el-cap.com. If the user
    // Already has a location set, this is handled on the wordpress side
    const url_params = new URLSearchParams(window.location.search);
    const redirect_url = url_params.get('redirect_url');

    if (redirect_url) {
      window.location.href = '/' + redirect_url + window.location.hash;
    }

    // JavaScript to be fired on all pages

    let elcap_data = {};
    let user_blog_id;

    // Set the user location whenever they land on a page
    if (window.elcap_data) {
      user_blog_id = window.elcap_data.user_blog_id;

      try {
        localStorage.setItem('elcap_data', JSON.stringify(window.elcap_data));

        if (window.elcap_data.user_location) {
          // Also set a cookie here since the backend needs it for form routing
          Cookies.set('user_location', window.elcap_data.user_location, {
            expires: 3650,
          });
        }
      }
      catch (e) {
        // noop
      }
    } else {
      try {
        elcap_data = JSON.parse(localStorage.getItem('elcap_data'));

        if (!elcap_data) {
          elcap_data = {};
        }

        user_blog_id = elcap_data.user_blog_id;
      }
      catch (e) {
        // noop
      }
    }

    /**
     * Setup based on local storage
     * This fires on global gym pages
     */

    // Set location selected
    if (elcap_data.user_location) {
      $('body').addClass('has-location-selected');
    }

    // Fill in navigation on main blog pages
    if (elcap_data.location_navigation) {
      let $dropdown_nav = $(elcap_data.location_navigation);
      $dropdown_nav.removeClass('nav-primary').removeClass('nav-location-primary').addClass('nav-primary-dropdown');
      $('.nav-mobile-container .nav-location-primary-container').html(elcap_data.location_navigation);
      $('.nav-primary-dropdown-container .location-primary-nav-container').html($dropdown_nav);
    }

    if (elcap_data.location_navigation_top_level) {
      $('.nav-header .nav-location-primary-container').html(elcap_data.location_navigation_top_level);
    }

    // Fill in location names
    if (elcap_data.user_location_name) {
      $('.user-location-name').text(elcap_data.user_location_name);
    }

    // Disable nav links to #
    $(document).on('click', '.nav a[href="#"]', function (e) {
      e.preventDefault();
    });

    // Choose locations on first visit
    $(document).on('click', 'a[href*="#location-redirect="]', function(e) {
      e.preventDefault();
      let url = $(this).attr('href').substring($(this).attr('href').lastIndexOf('#') + 1);
      let rawParams = url.split('&');
      let params = [];
      for(var i = 0, length1 = rawParams.length; i < length1; i++){
        rawParams[i].replace('#', '');
        var split = rawParams[i].split('=');
        params[split[0]] = split[1];
      }

      if (!elcap_data.user_location) {
        $('body').addClass('no-scroll');
        $('.nav-locations-floating').addClass('is-active');
        let noLocationUrl = params['location-redirect'];
        if(params['activity']) {
          noLocationUrl += '/#activity=' + params['activity'];
        }
        $('.nav-locations-floating').attr('data-url', noLocationUrl);
      } else {
        let redirectUrl = '/' + elcap_data.user_location + '/' + params['location-redirect'];
        if(params['activity']) {
          redirectUrl += '/#activity=' + params['activity'];
        }
        window.location.href = redirectUrl;
      }
    });

    /** End setup based on local storage */

    // Hide all nav menus
    function closeNavigation() {
      closePrimaryNav();
      closeLocationNav();
    }

    function closePrimaryNav() {
      $('.nav-primary-dropdown-container').removeClass('is-active').stop(true, true).slideUp();
    }

    function closeLocationNav() {
      $('.nav-locations-dropdown-container').removeClass('is-active').stop(true, true).slideUp();
    }

    function showPrimaryNavigation(e) {
      e.preventDefault();

      let menu_item;
      const menu_item_classes = $(this).attr('class').split(' ');

      if (menu_item_classes.length > 0) {
        menu_item_classes.forEach((item) => {
          if (item.indexOf('menu-item-') === 0) {
            menu_item = item;
          }
        })
      }

      const $child_menu = $('.nav-primary-dropdown > li.' + menu_item);

      if ($child_menu.hasClass('menu-item-has-children')) {
        $('.nav-primary-dropdown > li').hide();
        $('.nav-primary-dropdown > li.' + menu_item).show();

        closeLocationNav();
        $('.nav-primary-dropdown-container').addClass('is-active').slideDown();
      } else {
        closeNavigation();
      }
    }

    function showLocationNavigation(e) {
      e.preventDefault();

      closePrimaryNav();
      $('.nav-locations-dropdown-container').addClass('is-active').slideDown();
    }

    // Toggle location nav
    $(document).on('mouseenter touchend', '.header-main .nav-location-picker', showLocationNavigation);

    // Toggle primary nav
    $(document).on('mouseenter touchend', '.header-main .nav-header .nav-primary > li', showPrimaryNavigation);

    // Close nav
    $(document).on('mouseleave', '.header-main', closeNavigation);
    $(document).on('click', '.nav-dropdown__close', closeNavigation);

    // Mobile nav
    $(document).on('click', '.mobile-menu-toggle', function (e) {
      e.preventDefault();

      if ($(this).hasClass('is-active')) {
        $('.nav-mobile').slideUp();
        $(this).toggleClass('is-active');
        $('body').removeClass('no-scroll');
      } else {
        $('.nav-mobile-main').slideDown();
        $(this).toggleClass('is-active');
        $('body').addClass('no-scroll');
      }
    });

    $(document).on('click', '.nav-mobile .menu-item-has-children > a', function (e) {
      e.preventDefault();

      $(this).toggleClass('is-active');
      $(this).siblings('.sub-menu').slideToggle();
    });

    $(document).on('click', `
      .mobile-header-actions .icon-map-marker,
      .nav-mobile .nav-location-picker
    `,
      function (e) {
        e.preventDefault();

        if (!$('.nav-mobile-location').is(':visible')) {
          $('.mobile-menu-toggle').addClass('is-active');
          $('.nav-mobile-main').slideUp();
          $('.nav-mobile-location').slideDown();
          $('body').addClass('no-scroll');
        } else {
          $('.mobile-menu-toggle').removeClass('is-active');
          $('.nav-mobile').slideUp();
          $('body').removeClass('no-scroll');
        }
      });

    // Sticky nav
    $(document).on('mouseenter', '.nav-sticky-toggle', function () {
      $(this).addClass('is-expanded');
      $('.header-main').addClass('is-expanded');
    });

    $(document).on('mouseleave', '.header-main', function () {
      $(this).removeClass('is-expanded');
      $('.nav-sticky-toggle').removeClass('is-expanded');
    });

    // Switcher
    $(document).on('click', '.tabbed-content-slider__control', function (e) {
      e.preventDefault();

      const direction = $(this).attr('data-show');
      const switcher_id = '#' + $(this).attr('data-switcher');
      const $switcher = $(switcher_id);
      const $switcher_controls = $(switcher_id + '-controls');
      const active_index = $switcher.children('.uk-active').index();
      let next_index = direction === 'next' ? active_index + 1 : active_index - 1;

      if (next_index < 0) {
        next_index = $switcher.children().length - 1;
      } else if (next_index >= $switcher.children().length) {
        next_index = 0;
      }

      UIkit.switcher(switcher_id).show(next_index);
      $switcher_controls.children().removeClass('uk-active');
      $switcher_controls.children().eq(next_index).addClass('uk-active');
    });

    // Allow CTA links to be clicked when using hacked navigation arrows
    $(document).on('click', '.uk-switcher a.cta-button', function (e) {
      if( e.currentTarget.target === '_blank') {
        window.open(e.currentTarget.href, '_blank');
      } else {
        window.open(e.currentTarget.href, '_self');
      }
    });
    
    // Flip cards
    $(document).on('click', '.cta-list__cta__image-with-flip', function () {
      $(this).toggleClass('active');
    });

    // Message Banner
    $(document).on('click', '.message-banner__more', function () {
      var id = $(this).attr('data-message-banner');

      $(`#${id}`).slideDown();
    });

    $(document).on('click', '.message-banner__expanded__close', function () {
      $('.message-banner__expanded').slideUp();
    });

    // Instructor modal
    $(document).on('click', 'a[href="#instructor-modal"]', function () {
      const instructor = JSON.parse($(this).attr('data-instructor'));
      const classes = instructor.classes ?
        instructor.classes.map((c) => `<li>${c.name}</li>`)
        : [];

      $('#instructor-modal #instructor-modal__image-container > div[role="image"]').attr('style', `background-image: url('${instructor.image.sizes.large}')`);
      $('#instructor-modal #instructor-modal__image-container > div[role="image"]').attr('aria-label', instructor.image.alt);
      $('#instructor-modal #instructor-modal__name').text(instructor.first_name + ' ' + instructor.last_name);
      $('#instructor-modal #instructor-modal__bio').html(instructor.bio);

      if (instructor.classes && instructor.classes.length > 0) {
        $('#instructor-modal #instructor-modal__classes__wrapper').show();
        $('#instructor-modal #instructor-modal__classes').html(classes);
      } else {
        $('#instructor-modal #instructor-modal__classes__wrapper').hide();
      }
    });

    // Text rotator
    function updateTextRotators() {
      $('.text-rotator').each(function () {
        const $active_item = $(this).children('.text-rotator__active');

        $(this).children().removeClass('text-rotator__active');
        if ($active_item.next().length > 0) {
          $active_item.next().addClass('text-rotator__active');
          $(this).width($active_item.next().width());
        } else {
          $(this).children().first().addClass('text-rotator__active');
          $(this).width($(this).children().first().width());
        }
      });

      setTimeout(updateTextRotators, 5000);
    }

    setTimeout(updateTextRotators, 5000);

    // Overline animations
    UIkit.scrollspy('.overline-small, .overline-medium, .overline-large', { delay: 250 });

    $(document).on('inview', '.overline-small, .overline-small-thin, .overline-medium, .overline-large', function () {
      $(this).addClass('overline-expanded')
    });

    // Need to trigger a window resize after load to make sure the instagram images are the right size
    setTimeout(function () { $(window).trigger('resize'); }, 250);

    $(document).on('click', '.nav-locations-floating a', function (e) {
      e.preventDefault();

      const redirect_url = $(this).parents('.nav-locations-floating').attr('data-url');
      window.location.href = $(this).attr('href') + '/' + redirect_url;
    });

    $(document).on('click', '.nav-floating__close', function () {
      $(this).parents('.nav-floating').removeClass('is-active');
      $('body').removeClass('no-scroll');
    });

    // Redirect modal
    // if ($('#redirect-modal').length > 0) {
    //   let redirectModalShown = false;

    //   try {
    //     redirectModalShown = localStorage.getItem('redirectModalShown') === 'true';
    //   } catch (e) {
    //     // noop
    //   }

    //   if (redirectModalShown === false) {
    //     UIkit.modal($('#redirect-modal')[0]).show();

    //     try {
    //       localStorage.setItem('redirectModalShown', 'true');
    //     } catch (e) {
    //       // noop
    //     }
    //   }
    // }

    // Hide past upcoming classes - This is only on location home, but technically this module can go anywhere
    $('.upcoming-classes__list__item').each((index, item) => {
      const date = new Date();

      if ((parseInt($(item).attr('data-start-timestamp'))) < date.getTime() / 1000) {
        $(item).remove();
      }
    });

    function populate_message_banner(id, data) {
      const $banner = $(id);

      if (data && data.title) {
        $banner.removeClass('uk-hidden');

        if (data.title) {
          $banner.find('.message-banner__title').text(data.title);
        }

        if (data.content) {
          $banner.addClass('message-banner-has-content');
          $banner.find('.message-banner__content').html(data.content);
        }

        if (data.type === 'alert') {
          $banner.addClass('message-banner-alert');
        }
      }
    }

    // Get message banners
    $.get('/message-banners/',
      {
        locationId: user_blog_id,
      },
      function(response) {
        if (response) {
          response = JSON.parse(response);

          if (response.global_message_banner) {
            populate_message_banner('#global-message-banner', response.global_message_banner);
          }

          if (response.location_message_banner) {
            populate_message_banner('#location-message-banner', response.location_message_banner);
          }
        }
      }
    );

    // Toggle dropdowns if exist on page
    if( $('.dropdown-container').length ) {
      $(document).on('click', '.dropdown-container', function(event) {
        event.stopPropagation();
      });
      $(document).on('click', '.dropdown-text', function() {
        $('.dropdown-content').toggle();
      });
    }

    if( $('.play-toggle').length ) {
      $('.play-toggle').on('click', function() {
         $(this).toggleClass('paused');

         if( $(this).hasClass('paused') ) {
           document.querySelector('video.desktop').pause();
           document.querySelector('video.mobile').pause();
         } else {
           document.querySelector('video.desktop').play();
           document.querySelector('video.mobile').play();
         }
      });
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
