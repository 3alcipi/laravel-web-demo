// Cargar el DataTable
let tableReservation;

$(document).ready(function () {
    tableReservation = $('#tableReservation').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.routes.reservationsList,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'id', name: 'id' },
            { data: 'user_id', name: 'user_id' },
            { data: 'document_number', name: 'document_number' },
            { data: 'phone', name: 'phone' },
            { data: 'vehicle_id', name: 'vehicle_id' },
            { data: 'vehicle_id', name: 'vehicle_id' },
            { data: 'start_date', name: 'start_date' },
            { data: 'end_date', name: 'end_date' },
            { data: 'status', name: 'status' },
            { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
        ],
        responsive: true
    });
});