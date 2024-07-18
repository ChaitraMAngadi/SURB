<!-- Mainly scripts -->

<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/bootstrap.min.js"></script>
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/inspinia.js"></script>
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/plugins/pace/pace.min.js"></script>

<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                //{extend: 'copy'},
                {extend: 'csv',
                    title: 'Absolutemens-Data',
                    text: 'CSV',
                    className: 'btn btn-default',
                    exportOptions: {
                        columns: ':not(.notexport)'
                    }},
                {extend: 'excel',
                    title: 'Absolutemens-Data',
                    text: 'Excel',
                    className: 'btn btn-default',
                    exportOptions: {
                        columns: ':not(.notexport)'
                    }},
                //{extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                    title: 'Absolutemens-Data',
                    text: 'Print',
                    className: 'btn btn-default',
                    exportOptions: {
                        columns: ':not(.notexport)'
                    },
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });



</script>
<script src="<?= base_url() ?>admin_assets/assets/js/chosen.jquery.min.js"></script>
<script src="<?= base_url() ?>admin_assets/assets/js/chosen.jquery.js"></script>

<link href="<?= ADMIN_ASSETS_PATH ?>assets/js/select2.min.css" rel="stylesheet" /> 
<script src="<?= ADMIN_ASSETS_PATH ?>assets/js/select2.min.js"></script>
<script>
        $(document).ready(function() {
           $('.js-example-basic-multiple').select2({
            placeholder : "Select"
           });
        });
</script> 
<script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
     <script>
    setTimeout(function () {
        var editors = document.getElementsByClassName("ckeditor-desc");
        for (var i = 0; i < editors.length; i++) {
            CKEDITOR.replace(editors[i]);
        }
    }, 200);
</script>
<script type="text/javascript">
  setTimeout(function() {
    $('.alert-success').fadeOut('fast');
}, 3000);
setTimeout(function(){
        $('.alert-danger').fadeOut('fast');
    },4000);
</script>
</body>
</html>



