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
        columnDefs:
        [
            {
                targets:5,
                data:null,
                className:'text-center',
                defaultContent:'<button class=" btn btn-info btn-sm"><i class="fa fa-pencil"></i></button>'
            }
        ],
    });

    var tblDepartmentName = $('#tblDepartmentName').DataTable();
    // $('#tblDepartmentName tbody').on('click', '.btnCanDEdit', function() {
    //     $('.btnCanDEdit').attr('href', '{{route("department_name.edit",":id")}}'.replace(":id",
    //         tblDepartmentName.row($(this).parents()).data().id));
    // });
    // $('#tblDepartmentName').DataTable().buttons().container()
    //     .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
