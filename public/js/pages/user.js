function clear(){
    $('#inputUsername').val('');
    $('#inputName').val('');
    $('#inputEmail').val('');
    $('#inputPassword').val('');
    $('#selectAuthority').val('0');
}

$('#user__modal--close').on('click', function(){
    if ($('.success').is(":visible")){
        window.location.href = "/users";
    }

    $('.alert').hide();
    clear();
});


$('#userFormButtonSave').on('click', function () {
    const inputUsername = $('#inputUsername').val();
    const inputName = $('#inputName').val();
    const inputEmail = $('#inputEmail').val();
    const inputPassword = $('#inputPassword').val();
    const selectAuthority = $('#selectAuthority').val();

    $.ajax({
        url: "/user/save",
        type: "POST",
        data: {
            username: inputUsername,
            name: inputName,
            email: inputEmail,
            password: inputPassword,
            authority: selectAuthority,
        },
        success: function(res){
            const obj = $.parseJSON(res);
            if (obj.success == false){
                $('.success').hide();
                $('.error').show();
                $('.error').html(obj.error);
            }else{
                $('.error').hide();
                $('.success').show();
                $('.success').html(obj.success);
            }
        }
    });
})