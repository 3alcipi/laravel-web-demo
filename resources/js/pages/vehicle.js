var divLoading = document.getElementById('divLoading');
document.addEventListener("DOMContentLoaded", function () {

    // CSRF token para AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // GUARDAR / ACTUALIZAR
    $('#vehicleForm').on('submit', function (e) {
        e.preventDefault();
        divLoading.style.display = "flex"; // Mostrar el loading
        const $form = $(this);
        const id = $form.attr('data-id'); 
 
        let url = '';
        let type = '';
        //importante para subir imagenes/ eliminar el serializador de datos
        const formData = new FormData(this);
        if (id) {
            url = "/admin/vehicles/" + id;
            type = 'POST';
            formData.append('_method', 'PUT'); // Laravel necesita esto
        } else {
            url = window.routes.storeVehicle;
            type = 'POST';
        }

        

        $.ajax({
            url: url,
            type: type,
            data: formData,
            processData: false, // necesario para enviar FormData
            contentType: false, // necesario para enviar FormData
            success: function (response) {
                divLoading.style.display = "none"; // Ocultar el loading
                $('#vehicleModal').modal('hide');
                tableVehicle.ajax.reload(null, false);
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
     // CARGAR DATOS PARA VER 
     $(document).on('click', '.viewVehicle', function () {
        const rawData = $(this).attr('data-vehicle');      
        const vehicle = JSON.parse(rawData);       
        $('#plate1').text(vehicle.plate);
        $('#brand1').text(vehicle.brand_name);
        $('#model1').text(vehicle.model);
        $('#type1').text(vehicle.type_name);
        $('#color1').text(vehicle.color);
        $('#year1').text(vehicle.year);
        $('#engine_number1').text(vehicle.engine_number);
        $('#chassis_number1').text(vehicle.chassis_number);
        $('#description1').html(vehicle.description);
        const defaultImage = 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg';
        const isValidImage = vehicle.image_patch && /\.(jpg|jpeg|png|gif|webp)$/i.test(vehicle.image_patch);
        const validImage = isValidImage ? vehicle.image_patch : defaultImage;
        $('#imgPreview1').attr('src', validImage);
        $('#status1').html(vehicle.status);

        $('#vehicleModalView').modal('show');
    });
    // CARGAR DATOS PARA EDITAR
    $(document).on('click', '.editVehicle', function () {
        const id = $(this).data('id');
        const plate = $(this).data('plate');
        const model = $(this).data('model');
        const type_id = $(this).data('type_id');
        const brand_id = $(this).data('brand_id');
        const year = $(this).data('year');
        const color = $(this).data('color');
        const engine_number = $(this).data('engine_number');
        const chassis_number = $(this).data('chassis_number');
        const description = $(this).data('description');
        const status = $(this).data('status');
        const image_patch = $(this).data('image_patch');
        

        const defaultImage = 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg';
        const isValidImage = image_patch && /\.(jpg|jpeg|png|gif|webp)$/i.test(image_patch);
        const validImage = isValidImage ? image_patch : defaultImage;
 
        $('#vehicleForm').attr('data-id', id);
        $('#plate').val(plate);
        $('#model').val(model);
        $('select[name="type_id"]').val(type_id);
        $('select[name="brand_id"]').val(brand_id);
        $('#color').val(color);
        $('#year').val(year);
        $('#engine_number').val(engine_number);
        $('#chassis_number').val(chassis_number);
        $('#description').val(description);
       $('select[name="status"]').val(status);
       $('#imgPreview').attr('src', validImage);
        $('#exampleModalLabel').text('Editar Vehículo');
        $('#vehicleModal').modal('show'); 
    });

    // LIMPIAR AL CERRAR MODAL
    $('#vehicleModal').on('hidden.bs.modal', function () {
        const $form = $('#vehicleForm');
        $form[0].reset();
        $form.removeAttr('data-id');
        $('#exampleModalLabel').text('Nuevo Vehículo');
        $('#error-messages').addClass('d-none').empty();

        const defaultImage = 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg';
        $('#imgPreview').attr('src', defaultImage);
        $('#image').val('');
    });

    // CARGAR SELECT2 EN EL MODAL
    $('#vehicleModal').on('shown.bs.modal', function () {
        $(this).find('.select2bs4').each(function () {
            if ($(this).hasClass("select2-hidden-accessible")) {
                $(this).select2('destroy');
            }
            $(this).select2({
                theme: 'bootstrap4',
                dropdownParent: $('#vehicleModal')
            });
        });
    });
});

// Cargar el DataTable
let tableVehicle;

$(document).ready(function () {
    tableVehicle = $('#tableVehicle').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.routes.vehiclesList,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'id', name: 'id' },
            { data: 'plate', name: 'plate' },
            { data: 'model', name: 'model' },
            { data: 'type_name', name: 'type_name' },
            { data: 'brand_name', name: 'brand_name' },
            { data: 'color', name: 'color' },
            { data: 'year', name: 'year' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'acciones', name: 'acciones', orderable: false, searchable: false }            
           
        ],
        responsive: true
    });
});

// Eliminar vEHICULO
$(document).on('click', '.deleteVehicle', function () {
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
                url: `${window.routes.deleteVehicle}/${id}`,
                type: 'DELETE',
                success: function (response) {
                    tableVehicle.ajax.reload(null, false);
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
                    Swal.fire('Error', 'Ocurrió un error al eliminar el Tipo', 'error');
                }
            });
        }
    });
});

