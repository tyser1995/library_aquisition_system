<script>
    $(document).ready(function () {
        $('#tblDepartmentName').DataTable({
        deferRender: true,
        processing: true,
        // serverSide: true,
        // "dom": 'rtip',
        // paging: true,
        // pageLength: 5,
        // sDom:'lrtip',
        lengthChange: true, //show entries
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        ajax:base_url+"/department_names/data",
        columns: [
            {
                data: 'id'
            },
            {
                data: 'department_type'
            },
            {
                data: 'department_code'
            },
            {
                data: 'department_name'
            },
            {
                data: 'created_at'
            }
        ],
    });
    $('#tblDepartmentName').DataTable().buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
