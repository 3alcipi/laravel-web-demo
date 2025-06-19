var divLoading = document.getElementById('divLoading');
document.addEventListener("DOMContentLoaded", function () {

    // CSRF token para AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // GUARDAR / ACTUALIZAR
    $('#brandForm').on('submit', function (e) {
        e.preventDefault();
        divLoading.style.display = "flex"; // Mostrar el loading
        const $form = $(this);
        const id = $form.attr('data-id'); 
        let url = '';
        let type = '';

        if (id) {
            url = "/admin/brands/" + id;
            type = 'PUT';
        } else {
            url = window.routes.storeBrand;
            type = 'POST';
        }

        const formData = $form.serialize();

        $.ajax({
            url: url,
            type: type,
            data: formData,
            success: function (response) {
                divLoading.style.display = "none"; // Ocultar el loading
                $('#brandModal').modal('hide');
                tableBrand.ajax.reload(null, false);
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
    $(document).on('click', '.editBrand', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const status = $(this).data('status');

        $('#brandForm').attr('data-id', id);
        $('#name').val(name);
        $('select[name="status"]').val(status);
        $('#exampleModalLabel').text('Editar Marca');
        $('#brandModal').modal('show');
    });

    // LIMPIAR AL CERRAR MODAL
    $('#brandModal').on('hidden.bs.modal', function () {
        const $form = $('#brandForm');
        $form[0].reset();
        $form.removeAttr('data-id');
        $('#exampleModalLabel').text('Nueva Marca');
        $('#error-messages').addClass('d-none').empty();
    });

});

// Cargar el DataTable
let tableBrand;

$(document).ready(function () {
    tableBrand = $('#tabelBrand').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.routes.brandsList,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
        ],
        responsive: true
    });
});

// Eliminar marca
$(document).on('click', '.deleteBrand', function () {
    const id = $(this).data('id');
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `${window.routes.deleteBrand}/${id}`,
                type: 'DELETE',
                success: function (response) {
                    tableBrand.ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                },
                error: function () {
                    Swal.fire('Error', 'Ocurrió un error al eliminar la marca', 'error');
                }
            });
        }
    });
});
