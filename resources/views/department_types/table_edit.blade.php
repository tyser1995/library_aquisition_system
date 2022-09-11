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
        columnDefs: [{
            targets: 3,
            data: null,
            className: 'text-center',
            defaultContent: '<a href="#!" class="btnCanDEdit btn btn-info btn-sm" ><i class="fa fa-pencil"></i></a>'
        }],
    });

    var tblDepartmentType = $('#tblDepartmentType').DataTable();
    $('#tblDepartmentType tbody').on('click', '.btnCanDEdit', function() {
        $('.btnCanDEdit').attr('href', '{{route("department_type.edit",":id")}}'.replace(":id",
        tblDepartmentType.row($(this).parents()).data().id));
    });
    // $('#tblDepartmentType').DataTable().buttons().container()
    //     .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
