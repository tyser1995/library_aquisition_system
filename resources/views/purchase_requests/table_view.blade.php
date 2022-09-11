<script>
    $(document).ready(function () {
        $('#tblPurchaseRequest').DataTable({
        deferRender: true,
        processing: true,
        // serverSide: true,
        // "dom": 'rtip',
        // paging: true,
        // pageLength: 5,
        // sDom:'lrtip',
        lengthChange: true, //show entries
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        ajax:base_url+"/purchase_requests/data",
        columns: [
            {
                data: 'id'
            },
            {
                data: 'name'
            },
            {
                data: 'title'
            },
            {
                data: 'author_name'
            },
            {
                data: 'edition'
            },
            {
                data: 'created_at'
            }
        ],
        columnDefs: [{
            targets: 6,
            data: null,
            className: 'text-center',
            defaultContent: '<a href="#!" class="btnCanDEdit btn btn-info btn-sm" ><i class="fa fa-pencil"></i></a>' +
                '<button class="btnCanDestroy btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>'
        }],
    });

    var tblPurchaseRequest = $('#tblPurchaseRequest').DataTable();
    $('#tblPurchaseRequest tbody').on('click', '.btnCanDEdit', function() {
        $('.btnCanDEdit').attr('href', '{{route("purchase_request.edit",":id")}}'.replace(":id",
        tblPurchaseRequest.row($(this).parents()).data().id));
    });
    //delete
    $('#tblPurchaseRequest tbody').on('click', '.btnCanDestroy', function() {
        Swal.fire({
            // title: 'Error!',
            text: 'Do you want to remove ' + tblPurchaseRequest.row($(this).parents()).data().title + ' title?',
            icon: 'question',
            allowOutsideClick:false,
            confirmButtonText: 'Yes',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                window.location.href = base_url + "/purchase_requests/delete/" + tblPurchaseRequest.row($(this).parents()).data().id;
                Swal.fire({
                    title: 'Deleted Successfully',
                    icon: 'success',
                    allowOutsideClick:false,
                    confirmButtonText: 'Close',
                }).then(()=>{
                    $('#tblPurchaseRequest').DataTable().ajax.reload();
                });
            }
        });
    });
    $('#tblPurchaseRequest').DataTable().buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
