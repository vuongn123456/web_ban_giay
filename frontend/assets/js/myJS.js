// frontend/assets/js/script.js
// Click thêm vào giỏ thì gọi Ajax để thêm vào giỏ hàng
$(document).ready(function() {
    $('.add-cart').click(function() {
        event.preventDefault();
        var id = $(this).attr('data-id');
        // alert(id);
        $.ajax({
            url: 'index.php?controller=cart&action=add',
            method: 'get',
            data: {
                id: id
            },
            success: function(data) {
                $('.ajax-message')
                    .html('Thêm sp vào giỏ thành công')
                    .addClass('ajax-message-active');
                // Sau 3s thì tự động ẩn thông báo
                setTimeout(function() {
                    $('.ajax-message').removeClass('ajax-message-active');
                }, 3000);
                // Cập nhật lại số lượng sp trong giỏ
                var cart_total = $('.cart-amount').text();
                cart_total++;
                $('.cart-amount').html(cart_total);
            }
        });
    })

})
