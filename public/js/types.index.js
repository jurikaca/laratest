$(document).ready(function(){
    $('#types_table').DataTable();
    $('.delete_type').click(function(){
        if(window.confirm('All the items using this type will be deleted to. Are you sure to delete this type?')){
            $(this).parent().find('form').submit();
        }
    });
});