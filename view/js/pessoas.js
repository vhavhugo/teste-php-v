$(function () { 
    $("[data-mask='cpf']").mask("999.999.999-99");
    $("[data-mask='rg']").mask("99.999.999-9");
    $('.btn-remover').on('click', function () {
        var id = $(this).data('id');
        $('#modal-remove').modal('show');
        $('.btn-confirma-remove').on('click', function () {
            var url = $('#form-remove').attr('action');
            $.post(url, {id_pessoa: id}, function (rs) {
                $('#modal-remove').modal('hide');
                $('#tr-' + id).fadeOut();
                
        });
    });
});

});


