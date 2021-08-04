@extends('admin.admin_master')

@section('admin')

@php
$date = date('Y年n月j日');
$today = App\Models\Order::where('order_date', $date)->sum('amount');

$month = date('n月');
$month = App\Models\Order::where('order_month', $month)->sum('amount');

$year = date('Y年');
$year = App\Models\Order::where('order_year', $year)->sum('amount');

$pendings = App\Models\Order::where('status', 'pending')->get();
@endphp

<style>
    @media (max-width: 600px) {
        h3.text-white.mb-0.font-weight-500 {
            font-size: 12px;
        }

        p.text-mute.mt-20.mb-0.font-size-16 {
            font-size: 12px;
        }
    }
</style>

<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body" style="display: block; overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                        <div class="icon bg-primary-light rounded w-60 h-60">
                            <i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">本日の売上げ</p>
                            <h3 class="text-white mb-0 font-weight-500">¥ {{ number_format($today) }} <small class="text-success"><i class="fa fa-caret-up"></i> JPY</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body" style="display: block; overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                        <div class="icon bg-warning-light rounded w-60 h-60">
                            <i class="text-warning mr-0 font-size-24 mdi mdi-car"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">今月売上げ</p>
                            <h3 class="text-white mb-0 font-weight-500">¥ {{ number_format($month) }} <small class="text-success"><i class="fa fa-caret-up"></i> JPY</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body" style="display: block; overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">本年度売上げ</p>
                            <h3 class="text-white mb-0 font-weight-500">¥ {{ number_format($year) }} <small class="text-danger"><i class="fa fa-caret-down"></i> JPY</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body" style="display: block; overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                        <div class="icon bg-danger-light rounded w-60 h-60">
                            <i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">未対応オーダー</p>
                            <h3 class="text-white mb-0 font-weight-500">{{ count($pendings) }}件 <small class="text-danger"><i class="fa fa-caret-up"></i> オーダー</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">
                            未対応オーダー
                        </h4>
                    </div>

                    @php
                    $orders = App\Models\Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
                    @endphp

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <thead>
                                    <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 100px"><span class="text-white">受注日</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">オーダー番号</span></th>
                                        <th style="min-width: 150px"><span class="text-fade">合計金額</span></th>
                                        <th style="min-width: 150px"><span class="text-fade">支払い方法</span></th>
                                        <th style="min-width: 130px"><span class="text-fade">ステータス</span></th>
                                        <th style="min-width: 120px"><span class="text-fade">プロセス</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $item)
                                    <tr>
                                        <td class="pl-0 py-8">
                                            <span class="text-white font-weight-600 d-block font-size-16">
                                                {{ $item->order_date }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-white font-weight-600 d-block font-size-16">
                                                {{ $item->invoice_no }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-fade font-weight-600 d-block font-size-16">
                                                ¥ {{ number_format($item->amount) }}(税込)
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-white font-weight-600 d-block font-size-16">
                                                {{ $item->payment_method }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($item->status == 'pending')
                                            <span class="badge badge-primary-light badge-lg">未対応</span>
                                            @endif
                                        </td>
                                        <td class="text-left">
                                            <a href="#" class="waves-effect waves-light btn btn-info btn-circle mx-5"><span class="mdi mdi-bookmark-plus"></span></a>
                                            <a href="#" class="waves-effect waves-light btn btn-info btn-circle mx-5"><span class="mdi mdi-arrow-right"></span></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
