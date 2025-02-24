@extends('layouts.master')
@section('css')
@section('title')
    <?php echo $title = 'المناطق'; ?>
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
@if ($errors->any())
    <?php Alert::error($errors->all(), 'هناك خطأ في الحقول')->showConfirmButton('تم', '#c0392b'); ?>
@endif
<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">
            <h5 class="card-title">المناطق</h5>
            <div class="accordion accordion-border">
                @foreach ($cities as $city)
                    <div class="acd-group">
                        <a href="#" class="acd-heading">{{ $city->name }}</a>
                        <div class="acd-des" style="display: none;">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered p-0 table-hover">
                                        <thead>
                                            <tr>
                                                <th>الرقم</th>
                                                <th>اسم المنطقة</th>
                                                <th>سعر التوصيل</th>
                                                <th>تاريخ الانشاء</th>
                                                <th>تعديلات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($city->cityRel as $area)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $area->name }}</td>
                                                    <td>{{ $area->price . ' دينار ' }}</td>
                                                    <td>{{ $area->created_at->format('Y-m-d') }}</td>
                                                    <td>
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#edit{{ $area->id }}" title="تعديل"
                                                            class="btn btn-info btn-sm" title="تعديل"><i
                                                                class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal" data-target="#delete{{ $area->id }}"
                                                            title="حذف"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="edit{{ $area->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    تعديل بيانات المنطقة
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('areas.update', Crypt::encrypt($area->id)) }}"
                                                                    method="POST">
                                                                    {{ method_field('put') }}
                                                                    @csrf
                                                                    <label for="Name" class="mr-sm-2"> الاسم
                                                                        :</label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ $area->name }}" name="name"
                                                                        required />
                                                                    <label for="Name" class="mr-sm-2"> السعر
                                                                        :</label>
                                                                    <input class="form-control" type="number"
                                                                        min="0.0" value="{{ $area->price }}"
                                                                        name="price" required />

                                                                    <label for="Name" class="mr-sm-2"> المدينة
                                                                        :</label>
                                                                    <select name="city" class="form-control p-1"
                                                                        required>
                                                                        @foreach ($cities as $city)
                                                                            <option value="{{ $city->id }}"
                                                                                {{ $city->id == $area->city ? 'selected' : '' }}>
                                                                                {{ $city->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <br><br>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">رجوع</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">حفظ</button>
                                                            </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="delete{{ $area->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    حذف المنطقة
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('areas.destroy', Crypt::encrypt($area->id)) }}"
                                                                    method="post">
                                                                    {{ method_field('Delete') }}
                                                                    @csrf
                                                                    <h3 class="text-center">هل انت متأكد من عملية الحذف
                                                                        ؟</h3>
                                                                    <p class="text-center"> اذا تم الحذف سوف يتم حذف كل
                                                                        ماهو متعلق بهذه المنطفة</p>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">رجوع</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">حفظ</button>
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
                @endforeach
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
                    اضافة منطقة جديد
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('areas.store') }}" method="POST">
                    @csrf
                    <label for="Name" class="mr-sm-2"> الاسم
                        :</label>
                    <input class="form-control" type="text" name="name" required />
                    <label for="Name" class="mr-sm-2"> السعر
                        :</label>
                    <input class="form-control" type="number" min="0.0" name="price" required />
                    <label for="Name" class="mr-sm-2"> المدينة
                        :</label>
                    <select name="city" class="form-control p-1" required>
                        <option selected disabled>المنطقة ...</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
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
