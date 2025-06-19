// Cargar el DataTable
let tableUser;

$(document).ready(function () {
    tableUser = $('#tableUser').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.routes.usersList,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
        ],
        responsive: true
    });
});