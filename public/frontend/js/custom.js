$(document).ready(function () {
    loadcart();
    loadwishlist();
    $('.addtocart').click(function (e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.productid').val();
        var quantity = $(this).closest('.product_data').find('.quantity').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/cart_create",
            data: {
                'product_id': product_id,
                'quantity': quantity,
            },
            success: function (response) {
                swal(response.status);
                loadcart();
            }
        });
    });

    $(document).on('click', '.plus', function (e) {
        e.preventDefault();

        // var plus = $('.quantity').val();
        var plus = $(this).closest('.product_data').find('.quantity').val();
        var value = parseInt(plus, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.quantity').val(value);
            // $('.quantity').val(value);
        }
    });
    $(document).on('click', '.minus', function (e) {
        e.preventDefault();

        // var minus = $('.quantity').val();
        var minus = $(this).closest('.product_data').find('.quantity').val();
        var value = parseInt(minus, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.quantity').val(value);
            // $('.quantity').val(value);
        }
    });
    $(document).on('click', '.delete-cart-item', function (e) {

        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        $.ajax({
            method: "POST",
            url: "/cartitemdelete",
            data: {
                'product_id': product_id,
            },
            success: function (response) {
                //window.location.reload();
                $('.mycart').load(location.href + " .mycart");
                swal("", response.status, "success");
                loadcart();
            }
        });
    });
    $(document).on('click', '.changequantity', function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var quantity = $(this).closest('.product_data').find('.quantity').val();
        data = {
            'product_id': product_id,
            'quantity': quantity,
        }

        $.ajax({
            method: "POST",
            url: "/updatequantity",
            data: data,
            success: function (response) {
                $('.mycart').load(location.href + " .mycart");
                //window.location.reload();
            }
        });
    });

    $('.addtowishlist').click(function (e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.productid').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/cart_wishlist",
            data: {
                'product_id': product_id,
            },
            success: function (response) {
                swal(response.status);
                loadwishlist();
            }
        });
    });

    $(document).on('click', '.removewishlist', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product_data').find('.productid').val();
        $.ajax({
            method: "POST",
            url: "/withlistdelete",
            data: {
                'product_id': product_id,
            },
            success: function (response) {
                //window.location.reload();
                $('.mywishlist').load(location.href + " .mywishlist");
                swal("", response.status, "success");
                loadwishlist();
            }
        });
    });

    function loadcart() {
        $.ajax({
            method: "GET",
            url: "/load-cart-data",
            success: function (response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }

    function loadwishlist() {
        $.ajax({
            method: "GET",
            url: "/load-wishlist-data",
            success: function (response) {
                $('.wishlist-count').html('');
                $('.wishlist-count').html(response.count);
            }
        });
    }
});

