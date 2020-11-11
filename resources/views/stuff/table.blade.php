@guest

    <script>
        window.location('login')

    </script> ;
@endguest

@include('stuff.header')

<?php

use \App\Http\Controllers\stuff\StuffController;
use \App\Models\Stuff;
    $stuff = \App\Models\Stuff::all();

    if ( $stuff->isEmpty() )
        {
            ?>
            <div class="row">
                <div class="alert alert-info">
                    هنوز هیچ کالایی ثبت نشده است.
                </div>
            </div>

            <?php

        }else{
?>
    @php
    $ind = 1 @endphp
        {{-- TODO: Create pagination --}}
        <table class="table table-striped table-bordered " id="stuffs-table">
            <thead>
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
            </thead>
        <tbody>

            @foreach (\App\Models\Stuff::all() as $stuff)
                @php
                $unit = \App\Models\Unit::where('id',$stuff->unit_id)->first();
                $user = \App\Models\User::where('id',$stuff->creator_user_id)->first();
                @endphp

                <tr id="{{ $stuff->id }}">
                    <td>{{ $ind++ }}</td>
                    <td>{{ $stuff->code }}</td>
                    <td>{{ $stuff->name }}</td>
                    <td class="eng">{{ $stuff->latin_name ?? '-' }}</td>
                    <td>{{ $stuff->has_unique_serial ? 'دارد' : 'ندارد' }}</td>
                    <td>{{ $unit->name }}</td>
                    <td>
                        <p>
                            {{ $stuff->description ?? 'ندارد' }}
                        </p>
                        {{--<div>
                            <i class="fas fa-calendar-check text-success"></i>
                            <small class="text-secondary font-weight-lighter font-italic">
                                ثبت شده توسط : {{ $user->username }} در
                                @php
                                    if ( $stuff->created_at )
                                    \App\Http\Controllers\persianDateTimeController::gregorianToPersian($stuff->created_at)
                                @endphp
                            </small>
                        </div>
                        <div>
                             <i class="fas fa-edit text-info"></i>
                            <small class="text-secondary font-weight-lighter font-italic">
                                @if ($stuff->created_at == $stuff->updated_at)
                                    {{ __('هنوز ویرایش نشده.') }}
                                @else
                                    {{ __('ویرایش شده توسط : ') }}
                                    {{ \App\Models\User::where('id', $stuff->modifier_user_id)->get('username')->first()->username }}
                                    {{ __(' در ') }}
                                    {{ \App\Http\Controllers\persianDateTimeController::gregorianToPersian($stuff->updated_at) }}
                                @endif
                            </small>
                        </div> --}}
                    </td>
                    <td id="" style="width: 4rem;">
                        <div class="" id="{{ $stuff->id }}">
                            <button class="btn btn-info btn-sm m-0 my-1 d-inline-block w-100 text-center edit-stuff-modal-open-btn"
                        id="" data-stuff-id="{{ $stuff->id }}" title="ویرایش" data-creator-user-id="{{ $stuff->creator_user_id }}" data-user-id="{{ $user->id }}"><i
                                    class="fas fa-pencil-alt  m-0"></i></button>
                            <button class="btn btn-danger btn-sm m-0 my-1 d-inline-block w-100 text-center delete-stuff-modal-open-btn"
                                id="" data-stuff-id="{{ $stuff->id }}" title="حذف"><i
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
<?php } ?>
@include('stuff.footer')
