<script>
    $(document).ready(function () {
        $('#tblDepartmentType').DataTable({
        deferRender: true,
        processing: true,
        // serverSide: true,
        // "dom": 'rtip',
        // paging: true,
        // pageLength: 5,
        // sDom:'lrtip',
        lengthChange: true, //show entries
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        ajax:base_url+"/department_types/data",
        columns: [
            {
                data: 'id'
            },
            {
                data: 'department_type'
            },
            {
                data: 'created_at'
            }
        ],
    });
    $('#tblDepartmentType').DataTable().buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
