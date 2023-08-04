export default {
  init() {
    $(document).on('click', '.membership-rates__locations__toggle', function() {
      $(this).parents('.membership-rates__locations').toggleClass('is-active');
      $(this).siblings('.membership-rates__locations__content').slideToggle();
    });

    $(document).on('click', '.membership-rates__rates__toggle', function() {
      if ($(this).parents('.membership-rates__rates').hasClass('is-disabled')) {
        return;
      }

      $(this).parents('.membership-rates__rates').toggleClass('is-active');
      $(this).siblings('.membership-rates__rates__content').slideToggle();
    });

    $(document).on('click', '.membership-rates__locations__select', function(e) {
      e.preventDefault();
      $('.membership-rates__rates').removeClass('is-disabled');

      $('.membership-rates__selected-gym').text($(this).text());

      $('.membership-rates__rates__gym').removeClass('is-active');
      $('.membership-rates__rates__gym[data-gym="' + $(this).attr('data-gym') + '"]').addClass('is-active');
      $(this).parents('.membership-rates__rates').addClass('is-active');
      $('.membership-rates__rates__content').hide().slideDown();
    });

    // Auto select gym
    try {
      // Check if URL parameter is used
      const url_params = new URLSearchParams(window.location.search);
      const location_parameter = url_params.get('location');
      if (location_parameter) {
        const parameter_location = window.elcap_gym_data.find(e => e.name.toLowerCase() === location_parameter);
        $(`.membership-rates__locations__select[data-gym=${parameter_location.blog_id}]`).trigger('click');
      } else {
        const elcap_data = JSON.parse(localStorage.getItem('elcap_data'));
        $(`.membership-rates__locations__select[data-gym=${elcap_data.user_blog_id}]`).trigger('click');
      }

      $('.membership-rates__locations').removeClass('is-active');
      $('.membership-rates__locations__content').slideUp();

      $('.membership-rates__rates').addClass('is-active');
      $('.membership-rates__rates__content').slideDown();
    }
    catch (e) {
      // noop
    }
  },
  finalize() {
    if ($('.membership-rates__locations').hasClass('is-active')) {
      $('.membership-rates__locations__content').css('display', 'block');
    }

    if ($('.membership-rates__rates').hasClass('is-active')) {
      $('.membership-rates__rates__content').css('display', 'block');
    }
  },
};
