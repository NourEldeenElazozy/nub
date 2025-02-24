@extends('layouts.master')
@section('css')
@section('title')
    <?php echo $title = 'المدن'; ?>
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
    أضافة
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
                                <th>الرقم</th>
                                <th>اسم المدينة</th>
                                <th>سعر التوصيل</th>
                                <th>مناطق</th>
                                <th>تاريخ الانشاء</th>
                                <th>تعديلات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->price }}</td>
                                    <td>{{ $city->status == 0 ? 'لايوجد' : 'يوجد' }}</td>
                                    <td>{{ $city->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal"
                                            data-target="#edit{{ $city->id }}" title="تعديل"
                                            class="btn btn-info btn-sm" title="تعديل"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $city->id }}" title="حذف"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                </div>
                <!-- edit_modal_Section -->
                <div class="modal fade" id="edit{{ $city->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    تعديل بيانات المدينة
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('cities.update', Crypt::encrypt($city->id)) }}" method="post">
                                    {{ method_field('put') }}
                                    @csrf
                                    <label for="Name" class="mr-sm-2"> الاسم
                                        :</label>
                                    <input class="form-control" type="text" value="{{ $city->name }}"
                                        name="name" required />
                                    <label for="Name" class="mr-sm-2"> السعر
                                        :</label>
                                    <input class="form-control" type="number" min="0.0"
                                        value="{{ $city->price }}" name="price" required />
                                    <label for="Name" class="mr-sm-2"> مناطق
                                        :</label>
                                    <select name="status" class="form-control p-1">
                                        <option value="0" {{ $city->status == 0 ? 'selected' : '' }}>لايوجد
                                        </option>
                                        <option value="1" {{ $city->status == 1 ? 'selected' : '' }}>يوجد</option>
                                    </select>
                                    <br><br>
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
                <div class="modal fade" id="delete{{ $city->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    حذف المنطقة
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('cities.destroy', Crypt::encrypt($city->id)) }}" method="post">
                                    {{ method_field('Delete') }}
                                    @csrf
                                    <h3 class="text-center">هل انت متأكد من عملية الحذف ؟</h3>
                                    <p class="text-center"> اذا تم الحذف سوف يتم حذف كل ماهو متعلق بهذا المدينة</p>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    اضافة مدينة جديد
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cities.store') }}" method="POST">
                    @csrf
                    <label for="Name" class="mr-sm-2"> الاسم
                        :</label>
                    <input class="form-control" type="text" name="name" required />
                    <label for="Name" class="mr-sm-2"> السعر
                        :</label>
                    <input class="form-control" type="number" min="0.0" name="price" required />
                    <label for="Name" class="mr-sm-2"> مناطق
                        :</label>
                    <select name="status" class="form-control p-1">
                        <option value="0">لايوجد
                        </option>
                        <option value="1">يوجد</option>
                    </select>
                    <br><br>
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
