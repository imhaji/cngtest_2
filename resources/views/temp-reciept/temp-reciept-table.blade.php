@php
$temp_reciept = \App\Models\TempReciept::all();
$stuffpack = \App\Models\Stuffpack::all();

@endphp
<div class="header row">
    <button class="btn btn-success" id="open-insert-new-temp-reciept-modal">
        <i class="fas fa-plus"></i>
        ثبت رسید موقت
    </button>
</div>

@if ($temp_reciept->count() == 0)
    <div class="row">
        <div class="alert alert-info">
            هنوز رسیدی ثبت نشده است.
        </div>
    </div>
@else
    <div class="contents">
        <table class="table table-bordered">
            <div class="">
                <thead>
                    <tr class="table-primary">
                        <th>
                            ردیف
                        </th>
                        <th>
                            شماره رسید
                        </th>
                        <th>
                            ارسال کننده
                        </th>
                        <th>
                            شماره حواله
                        </th>
                        <th>
                            تاریخ حواله
                        </th>
                        <th>
                            تعداد کالا
                        </th>
                        <th>
                            تعداد مجموعه
                        </th>
                        <th>
                            نام راننده
                        </th>
                        <th>
                            شماره خودرو
                        </th>
                        <th>
                            نوع خودرو
                        </th>
                        <th>
                            ثبت کننده
                        </th>
                        <th>
                            توضیحات
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $ind = 1; ?>
                    @foreach ($temp_reciept as $item)
                        <tr>
                            <td>
                                {{ $ind++ }}
                            </td>
                            <td>
                                {{ $item->reciept_no }}
                            </td>
                            <td>
                                {{ $item->sender }}
                            </td>
                            <td>
                                {{ $item->referral_number }}
                            </td>
                            <td>
                                {{ $item->referral_date }}
                            </td>
                            <td>
                                @php
                                $temp_reciept_stuffs_count =
                                \App\Models\TempRecieptList::select()->where('reciept_id',$item->id)->where('stuff_id','<>',0);
                                    @endphp
                                    <span>
                                        {{ $temp_reciept_stuffs_count->count() }}
                                    </span>
                                    @if ($temp_reciept_stuffs_count->count() )
                                        <br />
                                        <span class="badge badge-pill badge-secondary">
                                            {{ $temp_reciept_stuffs_count->sum('count') }}
                                        </span>
                                    @endif
                            </td>
                            <td>
                                @php
                                $temp_reciept_stuffpacks_count = \App\Models\TempRecieptList::select()->where('reciept_id',$item->id)->where('stuffpack_id','<>',0);
                                    @endphp
                                    <span>
                                        {{ $temp_reciept_stuffpacks_count->count() }}
                                    </span>
                            </td>
                            <td>
                                {{ $item->driver }}
                            </td>
                            <td>
                                {{ $item->car_no }}
                            </td>
                            <td>
                                {{ $item->car_type }}
                            </td>
                            <td>
                                {{ '--- ' }}
                            </td>
                            <td>
                                {{ $item->description }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-primary">
                        <th>
                            ردیف
                        </th>
                        <th>
                            شماره رسید
                        </th>
                        <th>
                            ارسال کننده
                        </th>
                        <th>
                            شماره حواله
                        </th>
                        <th>
                            تاریخ حواله
                        </th>
                        <th>
                            تعداد کالا
                        </th>
                        <th>
                            تعداد مجموعه
                        </th>
                        <th>
                            نام راننده
                        </th>
                        <th>
                            شماره خودرو
                        </th>
                        <th>
                            نوع خودرو
                        </th>
                        <th>
                            ثبت کننده
                        </th>
                        <th>
                            توضیحات
                        </th>
                    </tr>
                </tfoot>
            </div>
        </table>
    </div>
@endif
@include('temp-reciept.footer')
