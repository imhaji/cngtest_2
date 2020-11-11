@guest

    <script>
        window.location('login')

    </script> ;
@endguest

@include('stuff-pack.header')

@if (App\Models\StuffPack::all()->count())
    @php $ind = 1 @endphp
    <table class="table table-striped table-bordered " id="stuff-packs-table">
        <thead>
            <tr class="table-primary">
                <th>ردیف</th>
                <th>کد مجموعه کالا</th>
                <th>نام مجموعه کالا</th>
                <th>تعداد اقلام</th>
                <th>تعداد کل</th>
                <th>شماره سریال</th>
                <th>توضیحات</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>

            @foreach (\App\Models\StuffPack::all() as $stuff_pack)
                @php
                $unit = \App\Models\Unit::where('id',$stuff_pack->unit_id)->first();
                $user = \App\Models\User::where('id',$stuff_pack->creator_user_id)->first();
                $stuffpack_list = \App\Models\StuffpackList::where('stuffpack_id',$stuff_pack->id);
                @endphp

                <tr id="{{ $stuff_pack->id }}">
                    <td>{{ $ind++ }}</td>
                    <td>{{ $stuff_pack->code }}</td>
                    <td>{{ $stuff_pack->name }}</td>
                    <td>{{ $stuffpack_list->count() }}</td>
                    <td>{{ $stuffpack_list->sum('stuff_count') }}</td>
                    <td>{{ $stuff_pack->serial  }}</td>
                    <td>
                        <p>
                            {{ $stuff_pack->description ?? 'ندارد' }}
                        </p>
                        {{--<div>
                            <i class="fas fa-calendar-check text-success"></i>
                            <small class="text-secondary font-weight-lighter font-italic">
                                ثبت شده توسط : {{ $user->username }} در
                                {{ \App\Http\Controllers\persianDateTimeController::gregorianToPersian($stuff_pack->created_at) }}</small>
                        </div>
                         <div>
                            <i class="fas fa-edit text-info"></i>
                            <small class="text-secondary font-weight-lighter font-italic">
                                @if ($stuff_pack->created_at == $stuff_pack->updated_at)
                                    {{ __('هنوز ویرایش نشده.') }}
                                @else
                                    {{ __('ویرایش شده توسط : ') }}
                                    {{ \App\Models\User::where('id', $stuff_pack->modifier_user_id)->get('username')->first()->username }}
                                    {{ __(' در ') }}
                                    {{ \App\Http\Controllers\persianDateTimeController::gregorianToPersian($stuff_pack->updated_at) }}
                                @endif
                            </small>
                        </div> --}}

                    </td>
                    <td id="operation">
                        <div class="btns" id="{{ $stuff_pack->id }}">
                            <button class="btn btn-info btn-sm m-0 my-1 d-inline-block w-100 text-center stuffpack-edit-modal-open"
                        id="btnStuff_packEdit-{{ $stuff_pack->id }}" data-id="{{ $stuff_pack->id }}" title="ویرایش" data-creator-user-id="{{ $stuff_pack->creator_user_id }}" data-user-id="{{ $user->id }}"><i
                                    class="fas fa-pencil-alt  m-0"></i></button>
                            <button class="btn btn-danger btn-sm m-0 my-1 d-inline-block w-100 text-center "
                                id="btn-stuff_pack-delete-modal-show" data-id="{{ $stuff_pack->id }}" title="حذف"><i
                                    class="fas fa-trash-alt m-0"></i></button>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="table-primary">
                <th>ردیف</th>
                <th>کد کالا</th>
                <th>نام کالا</th>
                <th>نام لاتین</th>
                <th>سریال منحصر بفرد</th>
                <th>واحد اندازه‌گیری</th>
                <th>توضیحات</th>
                <th>عملیات</th>
            </tr>
        </tfoot>
    </table>
@elseif( \App\Models\Stuff::all()->count() )
    <div class="mt-3 alert alert-info">
        هنوز هیچ مجموعه کالایی ثبت نشده است.
    </div>
@else
    <div class="mt-3 alert alert-info">
        ابتدا باید کالا ثبت کنید.
    </div>
    <script>
        var btn = document.getElementById('insert-new-stuff-pack-button');
        console.log(btn);
        btn.disabled = true;
    </script>
@endif
@include('stuff-pack.footer')
