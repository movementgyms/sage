export default {
  init() {
    $(document).on('click', 'html', function() {
      $('.dropdown-content').hide();
      $('.covid-dropdown-content').hide();
    });
    // disable close when clicking on menu
    $(document).on('click', '.covid-dropdown', function(event) {
      event.stopPropagation();
    });
    // toggle menu opening
    $(document).on('click', '.covid-dropdown-text', function() {
      $('.covid-dropdown-content').toggle();
    });
  },
  finalize() {
  },
};
