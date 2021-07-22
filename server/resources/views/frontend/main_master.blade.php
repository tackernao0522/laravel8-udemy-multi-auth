<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- Toastr Css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->

    @include('frontend.body.header')

    <!-- ============================================== HEADER : END ============================================== -->

    @yield('content')

    <!-- /#top-banner-and-menu -->

    <!-- ============================================================= FOOTER ============================================================= -->

    @include('frontend.body.footer')

    <!-- ============================================================= FOOTER : END============================================================= -->

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;
            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;
            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;
            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;

        }
        @endif
    </script>

    <!-- Add to Cart Product Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong><span id="pname"></span></strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img src=" " class="card-img-top" alt="..." style="height: 200px; width: 200px" id="pimage">
                            </div>
                        </div> <!-- end col md -->

                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item">@if(session()->get('language') == 'english') Product Price: @else 商品価格: @endif <strong class="text-danger">¥<span id="pprice"></span></strong>
                                    <del id="oldprice">¥</del>
                                </li>
                                <li class="list-group-item">@if(session()->get('language') == 'english') Product Code: @else 商品番号: @endif <strong id="pcode"></strong></li>
                                <li class="list-group-item">@if(session()->get('language') == 'english') Category: @else カテゴリー: @endif <strong id="pcategory"></strong></li>
                                <li class="list-group-item">@if(session()->get('language') == 'english') Brand: @else ブランド: @endif <strong id="pbrand"></strong></li>
                                <li class="list-group-item">@if(session()->get('language') == 'english') Stock: @else 在庫: @endif <span class="badge badge-pill badge-success" id="aviable" style="background: green; color: white;"></span>
                                    <span class="badge badge-pill badge-danger" id="stockout" style="background: red; color: white;"></span>
                                </li>
                            </ul>
                        </div> <!-- end col md -->

                        <div class="col-md-4">
                            <div class="form-group" id="sizeColor">
                                <label for="color">@if(session()->get('language') == 'english') Choose Color @else カラー選択 @endif</label>
                                <select class="form-control" id="color" name="color">

                                </select>
                            </div> <!-- end form group -->

                            <div class="form-group" id="sizeArea">
                                <label for="size">@if(session()->get('language') == 'english') Choose Size @else サイズ選択 @endif</label>
                                <select class="form-control" id="size" name="size">

                                </select>
                            </div> <!-- end form group -->

                            <div class="form-group">
                                <label for="qty">@if(session()->get('language') == 'english') Quantity @else 数量 @endif</label>
                                <input type="number" class="form-control" id="qty" value="1" min="1">
                            </div> <!-- end form group composer require bumbummen99/shoppingcart "after" php artisan vendor:publish --provider="Gloudemans\Shoppingcart\ShoppingcartServiceProvider" --tag="config" -->
                            <input type="hidden" id="product_id">
                            <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">@if(session()->get('language') == 'english') Add to Cart @else カートに入れる @endif</button>
                        </div> <!-- end col md -->
                    </div> <!-- end row -->
                </div> <!-- end modal Body -->
            </div>
        </div>
    </div>
    <!-- End Add to Cart Product Modal -->

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        // Start Product View with Modal
        function productView(id) {
            // alert(id)
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    $('#pname').text(data.product.product_name_ja);
                    $('#price').text(data.product.selling_price);
                    $('#pcode').text(data.product.product_code);
                    $('#pcategory').text(data.product.category.category_name_ja);
                    $('#pbrand').text(data.product.brand.brand_name_ja);
                    $('#pimage').attr('src', 'https://melpit-user-s3.s3.ap-northeast-1.amazonaws.com/products/thambnail/' + data.product.product_thambnail);

                    $('#product_id').val(id);
                    $('#qty').val(1);

                    // Product Price
                    if (data.product.discount_price == null) {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text(data.product.selling_price);
                    } else {
                        $('#pprice').text(data.product.discount_price);
                        $('#oldprice').text(data.product.selling_price);
                    } // end product price

                    // Start Stock option
                    if (data.product.product_qty > 0) {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#aviable').text('在庫あり');
                    } else {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#stockout').text('在庫切れ');
                    } // end Stock Option

                    // Color
                    $('select[name="color"]').empty();
                    $.each(data.color, function(key, value) {
                        $('select[name="color"]').append('<option value=" ' + value + ' ">' + value + ' </option>')
                        if (data.color == "") {
                            $('#sizeColor').hide();
                        } else {
                            $('#sizeColor').show();
                        }
                    }) // end color

                    // Size
                    $('select[name="size"]').empty();
                    $.each(data.size, function(key, value) {
                        $('select[name="size"]').append('<option value=" ' + value + ' ">' + value + ' </option>')
                        if (data.size == "") {
                            $('#sizeArea').hide();
                        } else {
                            $('#sizeArea').show();
                        }
                    }) // end size
                }
            })
        }
        // End Product View with Modal

        // Start Add To Cart Product
        function addToCart() {
            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            var color = $('#color option:selected').text();
            var size = $('#size option:selected').text();
            var quantity = $('#qty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    color: color,
                    size: size,
                    quantity: quantity,
                    product_name: product_name
                },
                url: "/cart/data/store/" + id,
                success: function(data) {
                    miniCart()
                    $('#closeModal').click();
                    // console.log(data);

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            })
        }
        // End Add to Cart Product
    </script>
    <script type="text/javascript">
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(response) {
                    $('span[id="cartSubTotal"]').text('¥' + response.cartTotal + '(税込)');
                    $('#cartQty').text(response.cartQty);
                    var miniCart = "";

                    $.each(response.carts, function(key, value) {
                        miniCart += `<div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="detail.html"><img src="https://melpit-user-s3.s3.ap-northeast-1.amazonaws.com/products/thambnail/${value.options.image}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                      <div class="price"> ${'¥' + value.price.toLocaleString()} x ${value.qty} </div>
                    </div>
                    <div class="col-xs-1 action"> <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button> </div>
                  </div>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>`
                    });

                    $('#miniCart').html(miniCart);
                }
            })
        }
        miniCart();

        // mini cart remove Start
        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product-remove/' + rowId,
                dataType: 'json',
                success: function(data) {
                    miniCart();
                    cart();

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            });
        }
        // end mini cart remove
    </script>

    <!-- Add Wishlist Page -->
    <script type="text/javascript">
        function addToWishList(product_id) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-wishlist/" + product_id,
                success: function(data) {
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            })
        }
    </script>
    <!--  End Add Wishlist Page -->

    <!-- Load Wishlist Data -->
    <script type="text/javascript">
        function wishlist() {
            $.ajax({
                type: 'GET',
                url: '/user/get-wishlist-product',
                dataType: 'json',
                success: function(response) {
                    var rows = "";

                    $.each(response, function(key, value) {
                        rows += `<tr>
                                    <td class="col-md-2"><img src="https://melpit-user-s3.s3.ap-northeast-1.amazonaws.com/products/thambnail/${value.product.product_thambnail}"></td>
                                    <td class="col-md-7">
                                        <div class="product-name"><a href="#">@if(session()->get('language') == 'english') ${value.product.product_name_en} @else ${value.product.product_name_ja} @endif</a></div>
                                        <div class="price">
                                        ${value.product.discount_price == null
                                            ? `${'¥' + value.product.selling_price}`
                                        :
                                        `${'¥' + value.product.discount_price} <span>${'¥' + value.product.selling_price}</span>`
                                        }
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                        <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)">@if(session()->get('language') == 'english') Add to cart @else カートに入れる @endif</button>
                                    </td>
                                    <td class="col-md-1 close-btn">
                                        <button type="submit" class="" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>`
                    });

                    $('#wishlist').html(rows);
                }
            })
        }
        wishlist();

        // wishlist remove Start
        function wishlistRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/user/wishlist-remove/' + id,
                dataType: 'json',
                success: function(data) {
                    wishlist();

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            });
        }
        // end wishlist remove
    </script>
    <!-- End Load Wishlist Data -->

    <!-- Load MyCart Data -->
    <script type="text/javascript">
        function cart() {
            $.ajax({
                type: 'GET',
                url: '/user/get-cart-product',
                dataType: 'json',
                success: function(response) {
                    var rows = ""
                    $.each(response.carts, function(key, value) {
                        rows += `<tr>
        <td class="col-md-2"><img src="https://melpit-user-s3.s3.ap-northeast-1.amazonaws.com/products/thambnail/${value.options.image}" alt="imga" style="width:60px; height:60px;"></td>

        <td class="col-md-2">
            <div class="product-name"><a href="#">${value.name}</a></div>

            <div class="price">
                            ¥${value.price.toLocaleString()}
                        </div>
                    </td>
          <td class="col-md-2">
            <strong>${value.options.color} </strong>
            </td>
         <td class="col-md-2">
          ${value.options.size == null
            ? `<span> .... </span>`
            :
          `<strong>${value.options.size} </strong>`
          }
            </td>
           <td class="col-md-2">
            <button type="submit" class="btn btn-success btn-sm">+</button>
        <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width:25px;" >
        <button type="submit" class="btn btn-danger btn-sm">-</button>
            </td>
             <td class="col-md-2">
            <strong>¥${value.subtotal.toLocaleString()} </strong>
            </td>

        <td class="col-md-1 close-btn">
            <button type="submit" class="" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-times"></i></button>
        </td>
                </tr>`
                    });

                    $('#cartPage').html(rows);
                }
            })
        }
        cart();

        // MyCart remove Start
        function cartRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/user/cart-remove/' + id,
                dataType: 'json',
                success: function(data) {
                    cart();
                    miniCart();

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            });
        }
        // end MyCart remove
    </script>
    <!-- End Load MyCart Data -->
</body>

</html>
