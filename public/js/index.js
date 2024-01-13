$(function () {
    $(document).on('click', '.addAtribute', function (e) {
        e.preventDefault();

        let addAttributeElement = '<div class="mb-3 attributeElement" style="display: flex;">' +
            '<input type="text" class="form-control" style="width: 250px" name="nameData[]">' +
            '<input type="text" class="form-control" style="width: 250px; margin-left: 20px" name="valueData[]">' +
            '<i class="gg-trash deleteAddAttributeElement" style="margin: 20px 5px 20px 20px; color: #4b4e57"></i></div>';

        $('#attributeDiv').removeAttr('hidden');
        $('.addAttributeDiv').before(addAttributeElement);

        $(document).on('click', '.deleteAddAttributeElement', function () {
            deleteAddAttributeElement(this)
        });

    });
    $('.addProduct').on('click', function (e) {
        e.preventDefault();

        let form = $(this).closest('form').serialize();

        $.ajax({
            url: '/addEditProduct',
            method: 'POST',
            data: form,
            success: function (resp) {
                if (resp === 'success')
                    location.reload();
                else {
                    $('.forValidationErrors').html('<div class="alert alert-danger" role="alert">'+resp+'</div>');
                }
            }
        })
    });
    $('.table-light').on('click', function () {
        let id = $(this).attr('data-id');

        $.ajax({
            url: '/getProduct',
            method: 'POST',
            data: {
                id: id
            },
            dataType: 'JSON',
            success: function (product) {
                let productHtml = '<div class="mb-3" style="display: flex; justify-content: space-between">\n' +
                    '<h1 class="modal-title fs-5">' + product['name'] + '</h1>\n' +
                    '<div style="display: flex; justify-content: space-between; width: 90px">' +
                    '<i class="fa fa-edit" id="productEdit" style="color: #999a9d"></i>' +
                    '<i class="gg-trash" id="productDelete" style="color: #999a9d; height: 9px"></i>' +
                    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>' +
                    '</div>' +
                    '<br>' +
                    '<div class="mb-3 productsCard">' +
                    '<label class="col-form-label">Артикул: ' + product['article'] + '</label><br>' +
                    '<label class="col-form-label">Название: ' + product['name'] + '</label><br>' +
                    '<label class="col-form-label">Статус: ' + product['status'] + '</label><br>' +
                    '<label class="col-form-label">Атрибуты: ' + product['attributes'] + '</label></div>';

                $('.productsCard').html(productHtml);

                $('.productsId').val(product['id']);

                $(document).off('click', '#productEdit');
                $(document).on('click', '#productEdit', function () {
                    $('#productsCardModal').modal('hide');
                    $('#addProductModal').modal('show');

                    $('#addEditProduct').text('Редактировать продукт');
                    $('.addProduct').text("Сохранить");

                    $('input[name="article"]').val(product['article']);
                    $('input[name="name"]').val(product['name']);

                    if (product['status'] == 'Доступен')
                        $('select option[value="available"]').attr('selected', 'true');
                    else
                        $('select option[value="unavailable"]').attr('selected', 'true');

                    product['attributes'] = product['attributes'].split(',');

                    let attributesHtml = '';

                    for (let attribute of product['attributes']) {
                        attribute = attribute.split(':')

                        attributesHtml += '<div class="mb-3 attributeElement" style="display: flex;">' +
                            '<input type="text" class="form-control" style="width: 250px" name="nameData[]" value="' + attribute[0] + '">' +
                            '<input type="text" class="form-control" style="width: 250px; margin-left: 20px" name="valueData[]" value="' + attribute[1] + '">' +
                            '<i class="gg-trash deleteAddAttributeElement" style="margin: 20px 5px 20px 20px; color: #4b4e57"></i></div>';
                    }

                    $('#attributeDiv').removeAttr('hidden');
                    $('.addAttributeDiv').before(attributesHtml);

                    if(product['manager_role'] == 'ADMIN')
                        $('input[name="article"]').prop('readonly', true);

                    $(document).on('click', '.deleteAddAttributeElement', function () {
                        deleteAddAttributeElement(this)
                    });
                });

                $(document).off('click', '#productDelete');
                $(document).on('click', '#productDelete', function () {

                    let productId = $('.productsId').val();

                    $.ajax({
                        url: '/deleteProduct',
                        method: 'POST',
                        data: {
                            id: productId
                        },
                        success: function () {
                            location.reload();
                        }
                    })
                });
            }
        });
    });
    $('.addProductModal').on('click', function () {
        $('#addEditProduct').text('Добавить продукт');
        $('#attributeDiv').attr('hidden', 'true');
        $('.attributeElement').each(function (elem) {
            $(this).detach();
        })
        $('.addProduct').text("Добавить");
        $('.productsId').val(0);
        $('#addEditProductForm')[0].reset();
    })
});

function deleteAddAttributeElement(elem) {
    $(elem).closest('div').detach();

    if ($('.attributeElement').length === 0) {
        $('#attributeDiv').attr('hidden', 'true');
    }
}
