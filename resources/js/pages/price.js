var divLoading = document.getElementById('divLoading');
document.addEventListener("DOMContentLoaded", function () {

    // CSRF token para AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // GUARDAR / ACTUALIZAR
    $('#priceForm').on('submit', function (e) {
        e.preventDefault();
        divLoading.style.display = "flex"; // Mostrar el loading
        const $form = $(this);
        const id = $form.attr('data-id'); 
        let url = '';
        let type = '';

        if (id) {
            url = "/admin/prices/" + id;
            type = 'PUT';
        } else {
            url = window.routes.storePrice;
            type = 'POST';
        }

        const formData = $form.serialize();

        $.ajax({
            url: url,
            type: type,
            data: formData,
            success: function (response) {
                divLoading.style.display = "none"; // Ocultar el loading
                $('#priceModal').modal('hide');
                tablePrice.ajax.reload(null, false);
                Swal.fire({
                    title: response.message,
                    icon: "success", // o "error", según el contexto
                    toast: true,
                    position: "top-end", // puedes cambiar a "bottom-end", "top-start", etc.
                    showConfirmButton: false,
                    timer: 3000, // duración en milisegundos
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });

            },
            error: function (xhr) {
                divLoading.style.display = "none"; // Ocultar el loading
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorList = '<ul>';
                    $.each(errors, function (key, messages) {
                        errorList += `<li>${messages[0]}</li>`;
                    });
                    errorList += '</ul>';
                    $('#error-messages').removeClass('d-none').html(errorList);
                }
            }
        });
    });

    // CARGAR DATOS PARA EDITAR
    $(document).on('click', '.editPrice', function () {
        const id = $(this).data('id');
        const vehicle_id = $(this).data('vehicle_id');
        const price_day = $(this).data('price_day');
        const status = $(this).data('status');

        $('#priceForm').attr('data-id', id);
        $('select[name="vehicle_id"]').val(vehicle_id);
        $('#price_day').val(price_day);
        $('select[name="status"]').val(status);
        $('#exampleModalLabel').text('Editar Precio');
        $('#priceModal').modal('show');
    });

    // LIMPIAR AL CERRAR MODAL
    $('#priceModal').on('hidden.bs.modal', function () {
        const $form = $('#priceForm');
        $form[0].reset();
        $form.removeAttr('data-id');
        $('#exampleModalLabel').text('Nueva Precio');
        $('#error-messages').addClass('d-none').empty();
    });

});
  // CARGAR SELECT2 EN EL MODAL
   $('#priceModal').on('shown.bs.modal', function () {
    $(this).find('.select2bs4').each(function () {
        if ($(this).hasClass("select2-hidden-accessible")) {
            $(this).select2('destroy');
        }
        $(this).select2({
            theme: 'bootstrap4',
            dropdownParent: $('#priceModal')
        });
    });
});

// Cargar el DataTable
let tablePrice;

$(document).ready(function () {
    tablePrice = $('#tablePrice').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.routes.pricesList,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'id', name: 'id' },
            { data: 'vehicle_plate', name: 'vehicle_plate' },
            { data: 'vehicle_model', name: 'vehicle_model' },
            { data: 'price_day', name: 'price_day' },
            { data: 'created_at', name: 'created_at' },
            { data: 'used', name: 'used' },
            { data: 'status', name: 'status' }
        ],
        responsive: true,
        language:{
            emptyTable: "No hay datos disponibles en la tabla",
        }
    });
})