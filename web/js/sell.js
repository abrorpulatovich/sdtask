$('#sell-sell_quantity').on('blur', function() {
    var sell_quantity = $(this).val();
    var product_id = $('#sell-product_id').val();

    if(!product_id || !sell_quantity || sell_quantity <= 0) {
        swal(
            "Xatolik!",
            "Maxsulot tanlanmagan yoki Maxsulot soni noto'g'ri kiritilgan!",
            "error"
        );
        return false;
    } else {
        $.ajax({
            url: '/sell/check-count',
            type: 'get',
            data: { product_id: product_id, sell_quantity: sell_quantity },
            success: function (data) {
                var result = JSON.parse(data);
                swal(
                    "Xatolik!",
                    result.message,
                    "warning"
                );
                $('#sell-sell_quantity').val('');
            },
            error: function () {
            }
        });
    }
});
