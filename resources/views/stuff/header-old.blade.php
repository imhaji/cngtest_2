<div class="stuff-header">
    <div>
        <a href="#"
        class="btn btn-success"
        id="insert-new-stuff-button"
        data-user-id="{{ Auth::id() }}">
            <i class="fas fa-plus"></i>
            کالای جدید
        </a>
        <a href="#"
        class="btn btn-info text-light"
        id="insert-new-stuff-file-button"
        data-user-id="{{ Auth::id() }}">
            <i class="fas fa-file-upload "></i>
            ارسال از طریق فایل
        </a>
    </div>

    {{-- <table class="table table-striped table-bordered " id="stuffs-table">
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
        </thead> --}}
</div>
