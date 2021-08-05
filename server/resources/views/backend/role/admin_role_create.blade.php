@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">管理者追加</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>管理者名 <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end cold md 6 -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>メールアドレス <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end cold md 6 -->
                                    </div> <!-- end row -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>電話番号 <span class="text-danger">(任意)</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                                </div>
                                            </div>
                                        </div> <!-- end cold md 6 -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>パスワード <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" name="password" class="form-control">
                                                </div>
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end cold md 6 -->
                                    </div> <!-- end row -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>管理者画像 <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="file" name="profile_photo_path" class="form-control" id="image">
                                                    @error('profile_photo_path')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end cold md 6 -->

                                        <div class="col-md-6">
                                            <img id="showImage" src="{{ url('upload/no_image.jpg') }}" style="width: 100px; height: 100px">
                                        </div> <!-- end cold md 6 -->
                                    </div> <!-- end row -->

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_2" name="brand" value="1">
                                                        <label for="checkbox_2">ブランド</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_3" name="category" value="1">
                                                        <label for="checkbox_3">カテゴリー</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_4" name="product" value="1">
                                                        <label for="checkbox_4">商品</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_5" name="slider" value="1">
                                                        <label for="checkbox_5">スライダー</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_6" name="coupons" value="1">
                                                        <label for="checkbox_6">クーポン</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_7" name="shipping" value="1">
                                                        <label for="checkbox_7">配送エリア</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_8" name="blog" value="1">
                                                        <label for="checkbox_8">ブログ</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_9" name="setting" value="1">
                                                        <label for="checkbox_9">セッティング</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_10" name="returnorder" value="1">
                                                        <label for="checkbox_10">返品</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_11" name="review" value="1">
                                                        <label for="checkbox_11">商品レビュー</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_12" name="orders" value="1">
                                                        <label for="checkbox_12">オーダー</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_13" name="stock" value="1">
                                                        <label for="checkbox_13">在庫</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_14" name="reports" value="1">
                                                        <label for="checkbox_14">レポート</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_15" name="alluser" value="1">
                                                        <label for="checkbox_15">会員リスト</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_16" name="adminuserrole" value="1">
                                                        <label for="checkbox_16">管理者</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right mt-3">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="管理者登録">
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
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
