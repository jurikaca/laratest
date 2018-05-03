$(document).ready(function(){
    $('#users_table').DataTable();
    $('.delete_user').click(function(){
        if(window.confirm('Are you sure to delete this user?')){
            $(this).parent().find('form').submit();
        }
    });
    $('.role_select').change(function(){
        var role = $(this).find('option:selected').val();
        var user_id = $(this).attr('data-user_id');
        $.post(
            'users/change_user_role',
            {
                role        :   role,
                user_id     :   user_id,
                _token      :   $('#csrf_token').val()
            },
            function(result){
                if(result.success){
                    swal({
                        title: result.msg,
                        type: "success",
                        html : true
                    });
                }
            });
    })
    $('.active_checkbox').change(function(){
        var active = $(this).is(':checked');
        var user_id = $(this).attr('data-user_id');
        if(active){
            active = 1;
        }
        $.post(
            'users/change_user_active',
            {
                active      :   active,
                user_id     :   user_id,
                _token      :   $('#csrf_token').val()
            },
            function(result){
                if(result.success){
                    swal({
                        title: result.msg,
                        type: "success",
                        html : true
                    });
                }
            });
    })
});