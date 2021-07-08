@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Add Brand Page -->
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">孫カテゴリー編集</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('subSubCategory.update', $subSubCategory->id) }}">
                                @csrf
                                <div class="form-group">
                                    <h5>メインカテゴリー <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" class="form-control">
                                            <option value="" selected="" disabled="">メインカテゴリー</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $subSubCategory->category_id) == $category->id ? 'selected': '' }}>{{ $category->category_name_ja }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>サブカテゴリー <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subCategory_id" class="form-control">
                                            <option value="" selected="" disabled="">サブカテゴリー</option>
                                            @foreach($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}" {{ old('subCategory_id', $subSubCategory->subCategory_id) == $subCategory->id ? 'selected': '' }}>{{ $subCategory->subCategory_name_ja }}</option>
                                            @endforeach
                                        </select>
                                        @error('subCategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>孫カテゴリー名 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subSubCategory_name_ja" class="form-control" value="{{ old('subSubCategory_name_ja', $subSubCategory->subSubCategory_name_ja) }}">
                                        @error('subSubCategory_name_ja')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>G-ChildCategory English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subSubCategory_name_en" class="form-control" value="{{ old('subSubCategory_name_en', $subSubCategory->subSubCategory_name_en) }}">
                                        @error('subSubCategory_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mt-3">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="更新">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
