$(document).ready(function () {
    $(".form_contato").on("submit", function (e) {
        let clienteId = $('#cliente_id').val();

        if (!clienteId) {
            e.preventDefault();
            alert('Por favor, selecione um cliente antes de enviar o formulário.');
        }
    })

    $('#cliente').on('input', function () {
        const termo = $(this).val();

        if (termo.length >= 3) {
            $.ajax({
                url: "/clientes/search",
                type: 'GET',
                data: {
                    search: termo
                },
                success: function (data) {
                    $('#suggestions').empty().show();

                    if (data.length > 0) {
                        data.forEach(cliente => {
                            $('#suggestions').append(`
                                <li style="padding: 5px; cursor: pointer;" data-id="${cliente.id}">${cliente.nome}</li>
                            `);
                        });
                    } else {
                        $('#suggestions').append(
                            '<li style="padding: 5px;">Nenhum cliente encontrado</li>'
                        );
                    }
                }
            });
        } else {
            $('#suggestions').hide();
        }
    });


    $(document).on('click', '#suggestions li', function () {
        const clienteId = $(this).data('id');
        const clienteNome = $(this).text();

        $('#cliente').val(clienteNome);
        $('#cliente_id').val(clienteId);

        $('#suggestions').hide();
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#cliente, #suggestions').length) {
            $('#suggestions').hide();
        }
    });
});