function openModal(e, targetModal, msg) {
    e.preventDefault();
    $('#response').addClass('hidden');
    $('#' + targetModal[0].id).modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text(msg);
    $('#' + targetModal[0].id).on('hidden.bs.modal', function () {
        let active_item = $('.side-menu a.active');
        $('#' + active_item[0].id)[0].click();

    })
}

// insert new user

$(document).on('click', '#insert-new-user-save-btn', function (e) {
    e.preventDefault();
    console.log('save user clicked.');
    /* $.ajax({
        url:'addUser',
        type: 'post',
        data: $('#insert-new-user-form').serialize();
        success: function(data){
            $('#content-box').html(data);
        }
    }) */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#content-box').load('addUser', {
            data: $('#insert-new-user-form').serialize(),
        },
        function (statusTxt) {
            console.log(statusTxt);
            if (statusTxt.errors) {
                let response = JSON.parse(statusTxt.errors)
                $.each(response, function (ind, vl) {
                    $('#response ul').append(
                        `<li>
                            ${vl}
                        </li>`
                    ).removeClass('alert-success').addClass('alert-danger');
                })
            }
        }
    )

})

$(document).on('click', '#newUserBtn', function (e) {
    console.log('new user btn is clicked');
    openModal(e, $('#create'), 'کاربر جدید')

    //function add user
    $('button#add').on('click', function () {
        $('#response').html("");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'addUser',
            data: {
                '_token': $('input[name="_token"]').val(),
                'username': $('input[name="username"]').val(),
                'password': $('input[name="password"]').val(),
                'role': $('#role').val(),
                'title': $('#role :selected').text(),
            },
            success: function (data) {
                $('#response').removeClass('hidden')
                if (data.errors) {
                    try {
                        if (data.errors.code == "23000") {
                            data.errors.message = "کاربری با این نام قبلا ثبت شده است"
                            $('#response').append('<li>' + data.errors.message + '</li>')
                            return
                        }
                        else {
                            $.each(data.errors, function (keyobj, valueobj) {
                                $('#response').append('<li>' + valueobj + '</li>')
                                return
                            })
                        }
                    } catch (e) {
                        $('#response').append('<li>' + data.errors + '</li>')
                    }
                }
                else {
                    $('#response').text('کاربر جدید ثبت شد')
                    $('#insert-user-form input[type="text"]').val("")
                    $('#response').removeClass('alert-danger', 'hidden').addClass('alert-success')


                }
            }
        })
    })
})


//select user

$(document).on('click', '#btnEdit', function (e) {

    e.preventDefault();
    id = $(e.currentTarget).attr('data-id');
    if (id == 1)
        return;
    $('#selectResponse').addClass('hidden');
    $('#edit').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('ویرایش کاربر');
    $('#edit').on('hidden.bs.modal', function () {
        $('#side-menu-users-btn')[0].click();
    })

    $('.preloader').addClass('hidden');
    id = $(e.currentTarget).attr('data-id');

    $.ajax({
        type: 'GET',
        url: 'selectUser',
        data: {
            'id': id,
        },
        success: function (data) {
            $('#selectResponse').text("")
            $('#selectResponse').removeClass('hidden')
            if (!data.user) {
                console.log('user does not exist.')
                try {
                    if (data.errors.code == "23000") {
                        data.errors.message = "کاربری با این نام قبلا ثبت شده است"
                        $('#selectResponse').append('<li>' + data.errors.message + '</li>')
                        return
                    } else {
                        $.each(data.errors, function (keyobj, valueobj) {
                            $('#selectResponse').append('<li>' + valueobj + '</li>')
                            return
                        })
                    }

                } catch (e) {
                    $('#selectResponse').append('<li>' + data.errors + '</li>')
                }


            } else {
                try {
                    $('input#editUsername').val(data.user[0]['username']).attr('placeholder', 'نام کاربری جدید')
                    $('input#editPassword').val("").attr('placeholder', 'رمزعبور جدید')
                    $('select#editRole').val(data.user[0]['role'])

                } catch (error) {
                    // console.log(error)
                }

            }
        }
    })

    /**
     * ********************
     * UPDATE SQL USER
     * ********************
     */
    $('button#edit').on('click', function (e) {
        console.log(e);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'editUser',
            data: {
                '_token': $('input[name="_token"]').val(),
                'username': ($('#editUsername').val()),
                'password': ($('#editPassword').val()),
                'role': $('#editRole').val(),
                'title': $('#editRole :selected').text(),
                'id': id,
            },
            success: function (data) {

                if (data.errors) {
                    try {

                        $('#selectResponse').removeClass('hidden').text("")
                        if (data.errors.code == "23000") {
                            data.errors.message = "کاربری با این نام قبلا ثبت شده است"
                            $('#selectResponse').append('<li>' + data.errors.message + '</li>')
                            return
                        } else {
                            $.each(data.errors, function (keyobj, valueobj) {
                                $('#selectResponse').append('<li>' + valueobj + '</li>')
                                return
                            })
                        }

                    } catch (e) {
                        $('#selectResponse').append('<li>' + data.errors + '</li>')
                    }


                } else {
                    $('#selectResponse').text('تغییرات جدید ثبت شد')
                    $('#selectResponse').removeClass('alert-danger', 'hidden').addClass('alert-success')
                }
            }

        })

    })
    /**
     * END OF UPDATE

    */


})


/**
 * START OF DELETE USER
 *
 */

$(document).on('click', '#btnDelete', function (e) {

    //select user

    e.preventDefault();
    id = $(e.currentTarget).attr('data-id');
    if (id == 1)
        return;
    $('#deleteResponse').addClass('hidden');
    $('#deleteModal').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('حذف کاربر');
    $('#deleteModal').on('hidden.bs.modal', function () {
        $('#side-menu-users-btn')[0].click();
    })

    del_id = $(e.currentTarget).attr('data-id');
    var del_role;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        url: 'selectUser',
        data: {
            'id': del_id,
        },
        success: function (data) {
            console.log(data.user[0]['username']);
            if (data.user) {
                $('#deleteResponse').removeClass('hidden');
                $('#sureDeleteUsername').text(" " + data.user[0]['username'] + " ")
                $('#sureDeleteRole').text(" " + data.user[0]['title'] + " ")
                del_role = data.user[0]['role'];
            } else {
                $('#deleteResponse').removeClass('hidden');
                $('#selectResponse').val(data.errors['message'])
            }
        }
    })

    $('#modalBtnDelete').on('click', function (e) {

        console.log(del_id);
        $.ajax({
            type: 'POST',
            url: 'deleteUser',
            data: {
                'id': del_id,
                'role': del_role
            },
            success: function (d) {
                if (d.errors) {
                    console.log(d);

                } else {
                    $('#deleteResponse').text('کاربر حذف شد.');
                    $('#modalBtnDelete').fadeOut(300);
                    $('#deleteCancel').text('بستن');
                }
            }
        })
    })

})

// Insert new workshop

$(document).on('click', '#insert-new-workshop-modal-btn', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: 'insertNewWorkshopForm',
        data: {
            r: Math.random()
        },
        success: function (d) {
            $('.ajax-content').css('opacity', '0');
            $('#preloader').show();
            $('.ajax-content').first().html(d);
            $('.ajax-content').css('opacity', '1');;
        }
    });

})

// Insert new contractor

$(document).on('click', '#new-temp-modal-opener-btn', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: 'insert_new_contractor_form',
        data: {
            r: Math.random()
        },
        success: function (d) {
            $('.ajax-content').css('opacity', '0');
            $('#preloader').show();
            $('.ajax-content').first().html(d);
            $('.ajax-content').css('opacity', '1');;
        }
    });

})


// insert new contractor
$(document).on('click', '#insert-new-contractor-form-show-btn', function (e) {
    e.preventDefault();

})
