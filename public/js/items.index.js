$(document).ready(function(){
    $('#items_table').DataTable();
    $('.delete_item').click(function(){
        if(window.confirm('Are you sure to delete this item?')){
            $(this).parent().find('form').submit();
        }
    });
});