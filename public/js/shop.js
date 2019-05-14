$(document).on('click', '.delete-item', function(e){
    var token = $('meta[name="csrf-token"]').attr('content');
    var id = $(this).attr('id');
    var url = '/cart/' + id;
    var options = {
        url:url,
        method:'delete',
        data:{
            id : id,
            _token: token,
        },
        success:function(response)
        {
            $('#delete-item' + id).remove();
            $('#cartbox__item' + id).remove();
            $('.totalQty').html(response.totalQty);
            $('.totalPrice').html(response.totalPrice);
            $('.grandtotal .price').html(response.totalPrice);
            $('.cartbox__total__title').siblings().html(response.totalPrice);
        },
        error: function (request, error) {
            alert(" Error: " + arguments);
        }
    }
    e.preventDefault();
    $.ajax(options);
});

$(document).on('click', '.add-btn', function(e){
    var token = $('meta[name="csrf-token"]').attr('content');
    var id = $(this).attr('id');
    var quantity = $('.quantity').val();
    var url = '/cart/' + id;
    var options = {
        url:url,
        method:'PUT',
        data:{
            quantity : quantity,
            id : id,
            _token: token,
        },
        success:function(response)
        {
            $('.cartbox-wrap').addClass('cartbox-wrap is-visible');
            $('.totalQty').html(response.totalQty);
            $('.grandtotal .price').html( '$'+ response.totalPrice);
            $('.cartbox__total__title').siblings().html('$' + response.totalPrice);
            $('#cartbox__item' + response.product.id).remove();

            $('.cartbox__items').append(
                "  <div class='cartbox__item' id = 'cartbox__item" + response.product.id +"'>" +
                "      <div class='cartbox__item__thumb'>" +
                "          <a href='/product/" + response.product.slug +"'>" +
                "              <img src='http://"+ window.location.hostname +':'+ window.location.port + "/storage/uploads/cover_images/" + response.image +"' alt='"+ response.product.name +"'>" +
                "          </a>" +
                "      </div>" +
                "      <div class='cartbox__item__content'>" +
                "          <h5><a href='' class='product-name' > " + response.product.name + "</a></h5>" +
                "              <p>Qty:<span>" + response.cart[id].quantity + "</span></p>" +
                "                                <span class='price'> $" + response.cart[id].price  + " </span>" +
                "      </div>" +
                "<button class='cartbox__item__remove'>" +
                "  <i class='delete-item fa fa-trash' id='" + response.product.id + "'></i>" +
                "</button>" +
                "  </div>");
        },
        error: function (err) {
            if(arguments[2] === 'Unauthorized'){
                $('.accountbox-wrapper').addClass('accountbox-wrapper is-visible');
            }else{
                alert(" Error: " + err);
            }
        }
    }
    e.preventDefault();
    $.ajax(options);
});
