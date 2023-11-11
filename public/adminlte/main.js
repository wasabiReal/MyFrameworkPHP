$(function (){

    $('.delete').click(function (){
        let res = confirm('Підтверження');
        if(!res) return false;
    })

    $("#is_download").select2({
        placeholder: "Позначення товару",
        minimumInputLength: 1,
        cache: true,
        ajax: {
            url: ADMIN + "/product/get-download",
            delay: 250,
            dataType: 'json',
            data: function (params){
                return{
                    q: params.term,
                    page: params.page,
                };
            },
            processResults: function (data){
                return {
                    results: data.items
                };
            },
        },
    });

    $('#is_download').on('select2:open', function () {
        document.querySelector('.select2-search__field').focus();
    });

    $('#is_download').on('select2:select', function () {
        $('.clear-download').remove();
        $('#is_download').before('<p class="clear-download"><span class="btn btn-danger">Зробити товар не цифровим</span></p>');
    });

    $('body').on('click', '.clear-download span', function () {
        $('#is_download').val(null).trigger('change');
        $('.clear-download').remove();
    });

    $('.card-body').on('click', '.del-img', function () {
        const parentDiv = $(this).closest('.product-img-upload').remove();
        return false;
    });

    bsCustomFileInput.init();


});