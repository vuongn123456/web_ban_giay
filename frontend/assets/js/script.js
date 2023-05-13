$(document).ready(function () {


  $('.add-to-cart').each(function () {
    $(this).click(function () {
      event.preventDefault();
      var id = $(this).attr('data-id');
      $.ajax({
        url: 'index.php?controller=cart&action=add',
        method: 'GET',
        data: {
          id: id,
        },
        success: function (data) {
          $('.ajax-message').html('Thêm sản phẩm vào giỏ thành công').addClass('ajax-message-active');

          setTimeout(function () {
            $('.ajax-message').removeClass('ajax-message-active');
          }, 3000);
          var cart_total = $('.cart-amount').text();
          cart_total++;
          $('.cart-amount').text(cart_total);
          $('.cart-amount-mobile').text(cart_total);
        }
      })
    })
  })

});