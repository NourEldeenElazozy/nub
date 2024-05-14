@extends('layouts.master')
@section('css')
<style>
    .exampleModal {
      width: 500px;
    }
  </style>
@section('title')
    <?php echo $title = 'الإعتمادات'; ?>
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ $title }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسية</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
    إضافة
</button>
<br><br>
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <?php Alert::error($errors->all(), 'هناك خطأ في الحقول')->showConfirmButton('تم', '#c0392b'); ?>
                @endif
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0 table-hover">
                        <thead>
                            <tr>
                                <th>التسلسل</th>

                                <th> أسم المرسل</th>
                                <th>العملة</th>
                                <th> رقم الاعتماد</th>
                                <th>قيمة الاعتماد</th>
                                <th>رقم الحساب</th>
                                <th>تعديلات</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mans as $credit)
                                <tr>
                                    <td>{{ $credit->id }}</td>

                                    <td>{{ $credit->sender->name }}</td>

                                    <td>{{ $credit->currency->name }}</td>
                                    <td>{{ $credit->credit_number }}</td>
                                    <td>{{ $credit->credit_amount}}</td>
                                    <td>{{ $credit->account_number }}</td>

                                    <td>
                                        <button type="button" data-toggle="modal"
                                            data-target="#edit{{ $credit->id }}" title="تعديل"
                                            class="btn btn-info btn-sm" title="تعديل"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $credit->id }}" title="حذف"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                </div>

                <!-- edit_modal_Section -->
                <div class="modal fade" id="edit{{ $credit->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات الاعتماد</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('credits.update', $credit->id) }}" method="post" enctype="multipart/form-data">
                                    {{ method_field('put') }}
                                    @csrf

                                    <div class="row">
                                        <div class="col">
                                            <label for="sender_id" class="mr-sm-2">اسم المرسل:</label>
                                            <select class="form-control" name="sender_id" required>
                                                @foreach($senders as $sender)
                                                    <option value="{{ $sender->id }}" {{ $credit->sender_id == $sender->id ? 'selected' : '' }}>{{ $sender->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="credit_number" class="mr-sm-2">رقم الاعتماد:</label>
                                            <input class="form-control" type="text" name="credit_number" value="{{ $credit->credit_number }}" required />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="importer_name" class="mr-sm-2">اسم المستورد:</label>
                                            <input class="form-control" type="text" name="importer_name" value="{{ $credit->importer_name }}" required />
                                        </div>
                                        <div class="col">
                                            <label for="issue_date" class="mr-sm-2">تاريخ الاصدار:</label>
                                            <input class="form-control" type="date" name="issue_date" value="{{ $credit->issue_date }}" required />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="credit_amount" class="mr-sm-2">قيمة الاعتماد:</label>
                                            <input class="form-control" type="text" name="credit_amount" value="{{ $credit->credit_amount }}" required />
                                        </div>
                                        <div class="col">
                                            <label for="currency_id" class="mr-sm-2">العملة:</label>
                                            <select class="form-control" name="currency_id" required>
                                                @foreach($currencies as $currency)
                                                    <option value="{{ $currency->id }}" {{ $credit->currency_id == $currency->id ? 'selected' : '' }}>{{ $currency->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="expiry_date" class="mr-sm-2">تاريخ الانتهاء:</label>
                                            <input class="form-control" type="date" name="expiry_date" value="{{ $credit->expiry_date }}" required />
                                        </div>
                                        <div class="col">
                                            <label for="account_number" class="mr-sm-2">رقم الحساب:</label>
                                            <input class="form-control" type="text" name="account_number" value="{{ $credit->account_number }}" required />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="authorized_by" class="mr-sm-2">تم التفويض بواسطة:</label>
                                            <input class="form-control" type="text" name="authorized_by" value="{{ $credit->authorized_by }}" required />
                                        </div>
                                        <div class="col">
                                            <label for="goods_origin" class="mr-sm-2">منشأ البضاعة:</label>
                                            <input class="form-control" type="text" name="goods_origin" value="{{ $credit->goods_origin }}" required />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="purpose_of_transfer" class="mr-sm-2">الغرض من التحويل:</label>
                                            <textarea class="form-control" name="purpose_of_transfer" required>{{ $credit->purpose_of_transfer }}</textarea>
                                        </div>
                                        <div class="col">
                                            <label for="manufacturing_statement" class="mr-sm-2">بيان الصنع:</label>
                                            <textarea class="form-control" name="manufacturing_statement" required>{{ $credit->manufacturing_statement }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="financing_method" class="mr-sm-2">كيفية التمويل:</label>
                                            <input class="form-control" type="text" name="financing_method" value="{{ $credit->financing_method }}" required />
                                        </div>
                                        <div class="col">
                                            <label for="beneficiary_name" class="mr-sm-2">اسم المستفيد:</label>
                                            <input class="form-control" type="text" name="beneficiary_name" value="{{ $credit->beneficiary_name }}" required />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="credit_status" class="mr-sm-2">الوضع الائتماني:</label>
                                            <input class="form-control" type="text" name="credit_status" value="{{ $credit->credit_status }}" required />
                                        </div>
                                        <!-- يمكنك استمرار إضافة باقي الحقول هنا -->
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">رجوع</button>
                                <button type="submit" class="btn btn-success">حفظ</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- delete_modal_Section -->
                <div class="modal fade" id="delete{{ $credit->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    حذف الإعتماد
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('credits.destroy', Crypt::encrypt($credit->id)) }}" method="post">
                                    {{ method_field('Delete') }}
                                    @csrf
                                    <h3 class="text-center">هل انت متأكد من عملية الحذف ؟</h3>
                                    <p class="text-center"> اذا تم الحذف سوف يتم حذف كل ماهو متعلق بهذا الإعتماد</p>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">رجوع</button>
                                        <button type="submit" class="btn btn-danger">حفظ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
 @endforeach
                                    </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add_modal_Section -->

            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    إضافة اعتماد جديد
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('credits.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="sender_id">اسم المرسل:</label>
                            <select id="sender_id" name="sender_id" class="form-control" required>
                                @foreach($senders as $sender)
                                    <option value="{{ $sender->id }}">{{ $sender->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="currency_id">العملة:</label>
                            <select id="currency_id" name="currency_id" class="form-control" required>
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="credit_number">رقم الاعتماد:</label>
                            <input type="text" name="credit_number" id="credit_number" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="importer_name">اسم المستورد:</label>
                            <input type="text" name="importer_name" id="importer_name" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="issue_date">تاريخ الاصدار:</label>
                            <input type="date" name="issue_date" id="issue_date" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="credit_amount">قيمة الاعتماد:</label>
                            <input type="number" name="credit_amount" id="credit_amount" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="expiry_date">تاريخ الانتهاء:</label>
                            <input type="date" name="expiry_date" id="expiry_date" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="account_number">رقم الحساب:</label>
                            <input type="text" name="account_number" id="account_number" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="authorized_by">تم التفويض بواسطة:</label>
                            <input type="text" name="authorized_by" id="authorized_by" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="goods_origin">منشأ البضاعة:</label>
                            <input type="text" name="goods_origin" id="goods_origin" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="purpose_of_transfer">الغرض من التحويل:</label>
                            <textarea name="purpose_of_transfer" id="purpose_of_transfer" class="form-control" required></textarea>
                        </div>
                        <div class="col">
                            <label for="manufacturing_statement">بيان الصنع:</label>
                            <textarea name="manufacturing_statement" id="manufacturing_statement" class="form-control" required></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="financing_method">كيفية التمويل:</label>
                            <input type="text" name="financing_method" id="financing_method" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="beneficiary_name">اسم المستفيد:</label>
                            <input type="text" name="beneficiary_name" id="beneficiary_name" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="credit_status">الوضع الائتماني:</label>
                            <input type="text" name="credit_status" id="credit_status" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الرجوع</button>
                        <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

            <!-- row closed -->

        @endsection
        @section('js')

        @endsection
