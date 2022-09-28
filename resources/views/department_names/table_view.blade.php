<script>
$(document).ready(function() {
    $('#tblDepartmentName').DataTable({
        deferRender: true,
        processing: true,
        // serverSide: true,
        // "dom": 'rtip',
        // paging: true,
        // pageLength: 5,
        // sDom:'lrtip',
        // "dom": 'Btipr', //for buttons
        lengthChange: true, //show entries
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        ajax: base_url + "/department_names/data",
        columns: [{
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
        columnDefs: [{
            targets: 5,
            data: null,
            className: 'text-center',
            defaultContent: '<a href="#!" class="btn btn-info btn-sm" ><i class="fa fa-pencil"></i></a>' +
                '<button class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>'
        }],
    });

    var tblDepartmentName = $('#tblDepartmentName').DataTable();
    $('#tblDepartmentName tbody').on('click', '.btnCanDEdit', function() {
        $('.btnCanDEdit').attr('href', '{{route("department_name.edit",":id")}}'.replace(":id",
            tblDepartmentName.row($(this).parents()).data().id));
    });
    //delete
    // $('#tblDepartmentName tbody').on('click', '.btnCanDestroy', function() {
    //     Swal.fire({
    //         // title: 'Error!',
    //         text: 'Do you want to remove ' + tblDepartmentName.row($(this).parents()).data().department_name + ' department?',
    //         icon: 'question',
    //         allowOutsideClick:false,
    //         confirmButtonText: 'Yes',
    //         showCancelButton: true,
    //     }).then((result) => {
    //         if (result.value) {
    //             window.location.href = base_url + "/department_names/delete/" + tblDepartmentName.row($(this).parents()).data().id;
    //             Swal.fire({
    //                 title: 'Deleted Successfully',
    //                 icon: 'success',
    //                 allowOutsideClick:false,
    //                 confirmButtonText: 'Close',
    //             }).then(()=>{
    //                 $('#tblDepartmentName').DataTable().ajax.reload();
    //             });
    //         }
    //     });
    // });

    tblDepartmentName.buttons().container().appendTo('#tblDepartmentName_wrapper .col-md-6:eq(0)');
});
</script>