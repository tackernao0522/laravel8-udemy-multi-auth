@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">商品の出品</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form novalidate>
                            <div class="row">
    <div class="col-12">
        <div class="row"> <!-- start 1st row -->
            <div class="col-md-4">
                <div class="form-group">
                    <h5>ブランド <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="brand_id" class="form-control">
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
            </div> <!-- end col md-4 -->
            <div class="col-md-4">
                <div class="form-group">
                    <h5>メインカテゴリー <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="category_id" class="form-control">
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
            </div> <!-- end col md-4 -->
            <div class="col-md-4">
                <div class="form-group">
                    <h5>サブカテゴリー <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="subCategory_id" class="form-control">
                            <option value="" selected="" disabled="">サブカテゴリー</option>
                        </select>
                        @error('subCategory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div> <!-- end col md-4 -->
        </div> <!-- end 1st row -->

        <div class="form-group">
            <h5>Email Field <span class="text-danger">*</span></h5>
            <div class="controls">
                <input type="email" name="email" class="form-control" required data-validation-required-message="This field is required">
            </div>
        </div>
        <div class="form-group">
            <h5>File Input Field <span class="text-danger">*</span></h5>
            <div class="controls">
                <input type="file" name="file" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <h5>Basic Select <span class="text-danger">*</span></h5>
            <div class="controls">
                <select name="select" id="select" required class="form-control">
                    <option value="">Select Your City</option>
                    <option value="1">India</option>
                    <option value="2">USA</option>
                    <option value="3">UK</option>
                    <option value="4">Canada</option>
                    <option value="5">Dubai</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <h5>Textarea <span class="text-danger">*</span></h5>
            <div class="controls">
                <textarea name="textarea" id="textarea" class="form-control" required placeholder="Textarea text"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <h5>Checkbox <span class="text-danger">*</span></h5>
            <div class="controls">
                <input type="checkbox" id="checkbox_1" required value="single">
                <label for="checkbox_1">Check this custom checkbox</label>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <h5>Checkbox Group <span class="text-danger">*</span></h5>
            <div class="controls">
                <fieldset>
                    <input type="checkbox" id="checkbox_2" required value="x">
                    <label for="checkbox_2">I am unchecked Checkbox</label>
                </fieldset>
                <fieldset>
                    <input type="checkbox" id="checkbox_3" value="y">
                    <label for="checkbox_3">I am unchecked too</label>
                </fieldset>
            </div>
        </div>
    </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="出品">
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
@endsection