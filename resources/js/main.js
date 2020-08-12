
$(document).on('click', '.add_to_cart', function (e) {
    let currentButton = $(e.currentTarget);
    let pizzaCard = $(e.currentTarget).parents('div.pizza-card');
    let pizzaId = pizzaCard.data('pizzaId');

    currentButton.html('<i class="fas fa-spinner"></i>');

    $.ajax('/cart/add/' + pizzaId)
        .done((data) => {
            if (data.success && data.total_price) {
                $('span.total_price').html(data.total_price);
            }
            currentButton.html('Add to cart');
        });
});
