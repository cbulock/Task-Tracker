$('.approve').on('click', function (event) {
  var $button = $(this);
  TT.call('History/approve', {
    id: $button.data('historyId')
  })
    .done(function () {
      $button.hide();
    });
});