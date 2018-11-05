$(document).ready( function () {
    $('#membership_table').dataTable();

    $('.btn-approve').onclick(function(){
        console.log($('.btn-approve').val());
    });
});