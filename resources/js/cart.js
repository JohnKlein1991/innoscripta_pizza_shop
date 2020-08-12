
$(document).ready(function() {
    let fadeTime = 300;

    /* Assign actions */
    $('.product-quantity input').change( function() {
        updateQuantity(this);
    });

    $('.product-removal button').click( function() {
        removeItem(this);
    });


    /* Recalculate cart */
    function recalculateCart()
    {
        var subtotal = 0;

        /* Sum up row totals */
        $('.product').each(function () {
            subtotal += parseFloat($(this).children('.product-line-price').text());
        });

        /* Calculate totals */
        var tax = subtotal * taxRate;
        var shipping = (subtotal > 0 ? shippingRate : 0);
        var total = subtotal + tax + shipping;

        /* Update totals display */
        $('.totals-value').fadeOut(fadeTime, function() {
            $('#cart-subtotal').html(subtotal.toFixed(2));
            $('#cart-tax').html(tax.toFixed(2));
            $('#cart-shipping').html(shipping.toFixed(2));
            $('#cart-total').html(total.toFixed(2));
            if(total == 0){
                $('.checkout').fadeOut(fadeTime);
            }else{
                $('.checkout').fadeIn(fadeTime);
            }
            $('.totals-value').fadeIn(fadeTime);
        });
    }


    /* Update quantity */
    function updateQuantity(quantityInput)
    {
        /* Calculate line price */
        var productRow = $(quantityInput).parent().parent();
        var price = parseFloat(productRow.children('.product-price').text());
        var quantity = $(quantityInput).val();
        var linePrice = price * quantity;

        /* Update line price display and recalc cart totals */
        productRow.children('.product-line-price').each(function () {
            $(this).fadeOut(fadeTime, function() {
                $(this).text(linePrice.toFixed(2));
                recalculateCart();
                $(this).fadeIn(fadeTime);
            });
        });
    }

    function recalculateTotalSum()
    {
        let grandTotalPriceElem = $('span.grand_total');

        let itemsTotalPrice = +$('span.total_price').html();
        let deliveryPrice = +$('span.delivery_price').html();

        grandTotalPriceElem.html(itemsTotalPrice + deliveryPrice);
    }


    /* Remove item from cart */
    function removeItem(removeButton)
    {
        /* Remove row from DOM and recalc cart total */
        let productRow = $(removeButton).parent().parent();
        let pizzaId = removeButton.dataset.pizzaId;
        $(removeButton).html('<i class="fas fa-spinner"></i>');
        $.ajax('/cart/remove/' + pizzaId)
            .done((data) => {
                if (data.success && data.total_price) {
                    $('span.total_price').html(data.total_price);
                    $(removeButton).html('Remove');
                    productRow.slideUp(fadeTime, function() {
                        productRow.remove();
                        recalculateTotalSum();
                    });
                }
            });
    }

});

