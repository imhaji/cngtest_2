<?php

use App\Models\Tempstore;
use App\Models\Stuffpack;
use App\Models\TempRecieptList;
use App\Models\Stuff;
use App\Models\Unit;

// کارگاه ها
$tempstores = Tempstore::latest()->get();
// لیست رسید ها
$temp_lists = TempRecieptList::latest()->get();
$stuff_packes = array();
$stuffs = array();
if (count($temp_lists)) {



    foreach ($temp_lists as $stuff_item) {

        $stuffpack_id = $stuff_item->stuffpack_id;
        $stuff_id = $stuff_item->stuff_id;

        if ($stuffpack_id != 0) {
            // مجموعه کالا
            $stuff_packes[] = Stuffpack::find($stuffpack_id);
        }

        if ($stuff_id != 0) {
            // کالا ها
            $stuff_info = Stuff::find($stuff_id);
            $unit_info = Unit::where('id', $stuff_info->unit_id)->select('name')->first();
            $stuff_info->unit_name = $unit_info->name;
            $stuffs[] = $stuff_info;
        }

    }
}
?>
<div class="stuff-header">
    <form action="{{ Route('createTransfer') }}" method="POST" class="form-horizontal col-md-12">
    <div class="header row p-3 text-center outset bg-lightgreen">
        <h3 class="display-6">
            <div class="i fas fa-new"></div>
            انتقال کالا ها بین انبار
        </h3>
    </div>
        <div class="row">
            @csrf
            <div class="form-group  add">
                @if(count($tempstores))
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="source_temp" class="form-label">
                                    انبار مبدا :
                                </label>
                                <select class="form-control" name="source_temp">
                                    <option selected disabled>انتخاب کارگاه</option>
                                    @foreach($tempstores as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="destination_temp" class="form-label">
                                    انبار مقصد :
                                </label>
                                <select class="form-control" name="destination_temp">
                                    <option selected disabled>انتخاب کارگاه</option>
                                    @foreach($tempstores as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger">هیچ کارگاهی در سیستم ثبت نشده است</div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transfer_date" class="form-label">
                                تاریخ :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder="" id="transfer_date"
                                   name="transfer_date">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transfer_number" class="form-label">
                                شماره انتقال :
                            </label>
                            <input type="text" class=" inset" placeholder="" id="transfer_number"
                                   name="transfer_number">
                        </div>
                    </div>
                </div>
                    <div class="row"> {{-- انتخاب کالا یا مجموعه --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="temp-reciept-stuff-radion" class="form-label">
                                    <input class="form-control" value="0" type="radio" name="stuff-type-radio"
                                           id="temp-reciept-stuff-radion" checked>اضافه کردن کالا به لیست
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="temp-reciept-stuffpack-radion" class="form-label">
                                    <input class="form-control" value="1" type="radio" name="stuff-type-radio"
                                           id="temp-reciept-stuffpack-radion">اضافه کردن مجموعه به لیست
                                </label>
                            </div>
                        </div>
                    </div>
                @if(count($stuffs))
                    <div class="row" id="stuff_div">
                        <div class="col-md-4 border ">
                            <div class="form-group select-stuff-or-stuffpack">
                                <div class="" id="select-stuff-to-add-trnsfer">
                                    <label for="stuff-select-input" class="form-label">
                                        انتخاب کالا:
                                    </label>
                                    <select name="stuff_id" id="stuff_id" class="inset form-control">
                                        <option value="0" selected disabled>انتخاب کنید</option>
                                        @foreach($stuffs as $stuff)
                                            <option data-unit="{{ $stuff->unit_name }}" data-code="{{ $stuff->code }}"
                                                    value="{{ $stuff->id }}">{{ $stuff->name }}</option>
                                        @endforeach
                                    </select>
                                </div>



                            </div>
                        </div>
                        <div class="col-md-4 border">
                            <div class="form-group">
                                <label for="stuff-number-input-trnsfer" class="form-label">
                                    تعداد :
                                </label>
                                <input type="number" class="form-control inset" name="stuff-number-input-trnsfer"
                                       id="stuff-number-input-trnsfer" value="1" min="1" max="100"
                                       style="background: #fff;">

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="item-comment-input-trnsfer" class="form-label">
                                توضیحات :
                            </label>
                            <input type="text" class=" inset" name="item-comment-input-trnsfer"
                                   id="item_stuff_comment" min="1"
                                   max="100" style="background: #fff;">

                        </div>

                    </div>
                @else
                    <div class="alert alert-warning">هیچ کالایی ثبت نشده است</div>
                @endif
                @if(count($stuff_packes))
                    <div class="row" id="stuffpack_div" style="display: none">
                        <div class="col-md-4 border ">
                            <div class="form-group select-stuff-or-stuffpack">
                                <div class="" id="select-stuff-to-add-trnsfer">
                                    <label for="stuff-select-input" class="form-label">
                                        انتخاب مجموعه کالا:
                                    </label>
                                    <select name="stuffpack_id" id="stuffpack_id" class="inset form-control">
                                        <option value="0" selected disabled>انتخاب کنید</option>
                                        @foreach($stuff_packes as $stuff_pack)
                                            <option data-code="{{ $stuff_pack->code }}"
                                                    value="{{ $stuff_pack->id }}">{{ $stuff_pack->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 border">
                            <div class="form-group">
                                <label for="stuff-number-input-trnsfer" class="form-label">
                                    تعداد :
                                </label>
                                <input type="number" class="form-control inset" name="stuff-number-input-trnsfer"
                                       id="stuffpack-number-input-trnsfer" value="1" min="1" max="100"
                                       style="background: #fff;">

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="item-comment-input-trnsfer" class="form-label">
                                توضیحات :
                            </label>
                            <input type="text" class=" inset" name="item-comment-input-trnsfer"
                                   id="item_stuffpack_comment" min="1"
                                   max="100" style="background: #fff;">

                        </div>

                    </div>
                @else
                    <div class="alert alert-warning">هیچ مجموعه کالایی ثبت نشده است</div>
                @endif
                <div class="row">

                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center align-center">
                        <div class="form-group ">
                            <button class="w-100 btn btn-success" id="" onclick="add_transfer_list()" type="button">
                                <i class="fas fa-plus"></i>
                                اضافه به لیست
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="result"></div>
                </div>

            </div>
            <div class="col-sm-12 stuffpack-list p-3 border inset">

                <table class="table table-bordered" id="temp-reciept-list-table-trnsfer">
                    <div class="">
                        <thead>
                        <tr class="table-primary">
                            <th>
                                ردیف
                            </th>
                            <th>
                                کد کالا
                            </th>
                            <th>
                                نام کالا
                            </th>
                            <th>
                                تعداد
                            </th>
                            <th>
                                واحد
                            </th>
                            <th>
                                سریال (ها)
                            </th>
                            <th>
                                توضیحات
                            </th>

                            <th>
                                حذف
                            </th>

                        </tr>
                        </thead>
                        <tbody id="stuff-body">

                        </tbody>
                        <thead>
                        <tr class="table-primary">
                            <th>
                                ردیف
                            </th>
                            <th>
                                کد کالا / مجموعه
                            </th>
                            <th>
                                نام کالا / مجموعه
                            </th>
                            <th>
                                تعداد
                            </th>
                            <th>
                                واحد
                            </th>
                            <th>
                                توضیحات
                            </th>
                            <th>
                                سریال (ها)
                            </th>
                            <th>
                                حذف
                            </th>

                        </tr>
                        </thead>
                        <tbody id="stuffpack-body">

                        </tbody>
                    </div>
                </table>
            </div>

            <div class="row">

                <div class="col">
                    <button class="btn btn-success hidden" type="submit" id="insert-new-reciept-save-btn-trnsfer">
                        <i class="fas fa-save"></i>
                        ثبت
                    </button>
                </div>
                <div class="col">
                    <button class="btn btn-primary" id="insert-new-reciept-back-btn-trnsfer">
                        <i class="fas fa-backward"></i>
                        بازگشت
                    </button>
                </div>
                <div class="col">
                    <div class="mt-2 alert" id="insert-new-reciept-response-trnsfer">

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="{{ asset('js/transfer-stuff/transfer.js') }}"></script>

<script type="text/javascript">
    $(document).on('change', 'input[name="stuff-type-radio"]', function (e) {
        $('#stuff_div').fadeOut('fast');
        $('#stuffpack_div').fadeOut('fast');

        is_stuffpack = $('input[name="stuff-type-radio"]:checked').val();
        if(is_stuffpack == 1)
            $('#stuffpack_div').fadeIn();
        else
            $('#stuff_div').fadeIn();
    });
</script>
