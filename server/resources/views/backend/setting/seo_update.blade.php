@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">SEOセッティング</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="POST" action="{{ route('update.seoSetting', $seo->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Meta Title <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $seo->meta_title) }}">
                                                    @error('meta_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Meta Author <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="meta_author" class="form-control" value="{{ old('meta_author', $seo->meta_author) }}">
                                                    @error('meta_author')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Meta Keyword <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="meta_keyword" class="form-control" value="{{ old('meta_keyword', $seo->meta_keyword) }}">
                                                    @error('meta_keyword')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Meta Description <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <textarea name="meta_description" id="textarea" class="form-control">{{ old('meta_description', $seo->meta_description) }}</textarea>
                                                    @error('meta_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Google Analytics <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <textarea name="google_analytics" id="textarea" class="form-control">{{ old('google_analytics', $seo->google_analytics) }}</textarea>
                                                    @error('google_analytics')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end cold md 6 -->
                                    </div> <!-- end row -->

                                    <div class="text-xs-right mt-3">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="更新">
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
@endsection
