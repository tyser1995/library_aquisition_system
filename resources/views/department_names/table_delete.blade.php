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
                defaultContent:'<button id="btnCanDelete" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>'
            }
        ],
    });

     //delete
     var tblDepartmentName = $('#tblDepartmentName').DataTable();
     $('#tblDepartmentName tbody').on('click', '#btnCanDelete', function() {
        // Swal.fire({
        //     // title: 'Error!',
        //     text: 'Do you want to remove ' + tblDepartmentName.row($(this).parents()).data().department_name + ' department?',
        //     icon: 'question',
        //     allowOutsideClick:false,
        //     confirmButtonText: 'Yes',
        //     showCancelButton: true,
        // }).then((result) => {
        //     // if (result.value) {
        //     //     form.submit();
        //     // }
        //     window.location.href = base_url + "/department_names/delete/" + tblDepartmentName.row($(this).parents()).data().id;
        //     Swal.fire({
        //         title: 'Deleted Successfully',
        //         icon: 'success',
        //         allowOutsideClick:false,
        //         confirmButtonText: 'Close',
        //     }).then(()=>{
        //         $('#tblDepartmentName').DataTable().ajax.reload();
        //     });
        // });
    });

    $('#tblDepartmentName').DataTable().buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
