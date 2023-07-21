function increase() {
    $('#product_qty').val(parseInt($('#product_qty').val()) + 1);
}

function decrease() {
    $('#product_qty').val() > 1 ? $('#product_qty').val(parseInt($('#product_qty').val() - 1)) : 1;
}
