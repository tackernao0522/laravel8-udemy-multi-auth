@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">商品の登録 </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="POST" action="{{ route('product-store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <!-- start 1st row  -->
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>ブランド <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="brand_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">ブランド</option>
                                                        @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected': '' }}>{{ $brand->brand_name_ja }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>メインカテゴリー <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">メインカテゴリー</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected': '' }}>{{ $category->category_name_ja }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>サブカテゴリー <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subCategory_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">サブカテゴリー</option>
                                                    </select>
                                                    @error('subCategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 1st row  -->

                                    <div class="row">
                                        <!-- start 2nd row  -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>孫カテゴリー <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subSubCategory_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">孫カテゴリー</option>
                                                    </select>
                                                    @error('subSubCategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>商品名<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_ja" class="form-control" value="{{ old('product_name_ja') }}" required="">
                                                    @error('product_name_ja')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name English<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_en" class="form-control" value="{{ old('product_name_en') }}" required="">
                                                    @error('product_name_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 2nd row  -->

                                    <div class="row">
                                        <!-- start 3RD row  -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>商品コード <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_code" class="form-control" value="{{ old('product_code') }}" required="">
                                                    @error('product_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>在庫数 <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_qty" class="form-control" value="{{ old('product_qty') }}" required="">
                                                    @error('product_qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>商品タグ <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_ja" class="form-control" value="Lorem,Ipsum,Amet" data-role="tagsinput" required="">
                                                    @error('product_tags_ja')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 3RD row  -->

                                    <div class="row">
                                        <!-- start 4th row  -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tags En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_en" class="form-control" value="Lorem,Ipsum,Amet" data-role="tagsinput" required="">
                                                    @error('product_tags_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>サイズ <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_ja" class="form-control" value="Small,Midium,Large" data-role="tagsinput">
                                                    @error('product_size_ja')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size En <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_en" class="form-control" value="Small,Midium,Large" data-role="tagsinput">
                                                    @error('product_size_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 4th row  -->

                                    <div class="row">
                                        <!-- start 5th row  -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>カラー <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_ja" class="form-control" value="red,Black,Amet" data-role="tagsinput">
                                                    @error('product_color_ja')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Color En <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_en" class="form-control" value="red,Black,Amet" data-role="tagsinput">
                                                    @error('product_color_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>価格 <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="selling_price" class="form-control" required="">
                                                    @error('selling_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 5th row  -->

                                    <div class="row">
                                        <!-- start 6th row  -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>割引価格 <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount_price" class="form-control">
                                                    @error('discount_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>メインサムネイル <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)" required="">
                                                    @error('product_thambnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb" alt="">
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>マルチ画像 <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg" required="">
                                                    @error('multi_img')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="row" id="preview_img"></div>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 6th row  -->

                                    <div class="row">
                                        <!-- start 7th row  -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>商品説明(小見出し) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp_ja" id="textarea" class="form-control" required placeholder="Textarea text">{{ old('short_descp_ja') }}</textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp_en" id="textarea" class="form-control" required placeholder="Textarea text">{{ old('short_descp_en') }}</textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->
                                    </div> <!-- end 7th row  -->

                                    <div class="row">
                                        <!-- start 8th row  -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>商品説明(メイン) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" name="long_descp_ja" rows="10" cols="80" required="">商品説明(メイン)</textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Long Description En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor2" name="long_descp_en" rows="10" cols="80" required="">Long Description English.</textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->
                                    </div> <!-- end 8th row  -->

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_2" name="hot_deals" value="1">
                                                        <label for="checkbox_2">お得情報</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_3" name="featured" value="1">
                                                        <label for="checkbox_3">おすすめ商品</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_4" name="special_offer" value="1">
                                                        <label for="checkbox_4">特別セール</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_5" name="special_deals" value="1">
                                                        <label for="checkbox_5">特別割引</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>デジタル製品 <span class="text-danger">pdf,xlx,csv</span></h5>
                                            <div class="controls">
                                                <input type="file" name="file" class="form-control">
                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->

                                    <div class="text-xs-right">
                                        <input type="button" class="btn btn-rounded btn-primary mb-5" onclick="submit();" value="商品登録">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/category/subCategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subSubCategory_id"]').html('');
                        var d = $('select[name="subCategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subCategory_id"]').append('<option value="' + value.id + '">' + value.subCategory_name_ja + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

        $('select[name="subCategory_id"]').on('change', function() {
            var subCategory_id = $(this).val();
            if (subCategory_id) {
                $.ajax({
                    url: "{{ url('/category/sub-subCategory/ajax') }}/" + subCategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subSubCategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subSubCategory_id"]').append('<option value="' + value.id + '">' + value.subSubCategory_name_ja + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

<script type="text/javascript">
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80)
                                    .height(80); //create image element
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>
@endsection
