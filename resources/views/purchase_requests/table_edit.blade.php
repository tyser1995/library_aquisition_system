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
        columnDefs:
        [
            {
                targets:6,
                data:null,
                className:'text-center',
                defaultContent:'<button class="btnCanDEdit btn btn-info btn-sm"><i class="fa fa-pencil"></i></button>'
            }
        ],
    });
    // $('#tblPurchaseRequest').DataTable().buttons().container()
    //     .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
