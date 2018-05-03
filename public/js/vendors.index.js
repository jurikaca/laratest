$(document).ready(function(){
    $('#vendors_table').DataTable();
    $('.delete_vendor').click(function(){
        if(window.confirm('Are you sure to delete this vendor?')){
            $(this).parent().find('form').submit();
        }
    });
});