<div class="table-responsive-sm">
    <table id="example" class="table table-sm table-hover table-striped table-bordered table-borderless display" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <?php foreach ($fields as $key => $value) {
                    echo "<th>".utf8_decode(str_replace(array('-','_'), ' ', $value))."</th>";
                } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['data'] as $key => $value) { ?>
            <tr>
                <?php foreach ($fields as $i => $val) {
                    echo "<td>".utf8_decode($value[$i])."</td>";
                } ?>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <?php foreach ($fields as $key => $value) {
                    echo "<th>".utf8_decode(str_replace(array('-','_'), ' ', $value))."</th>";
                } ?>
            </tr>
        </tfoot>
    </table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // $.fn.dataTable.Buttons.swfPath = '../../swf/flashExport.swf';

    $('#example').DataTable({
        "language": {
            "url": "<?php echo base_url('assets/json/Portuguese-Brasil.json'); ?>"
        },
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Cadastrar',
                action: function ( e, dt, node, config ) {
                    window.location.href = "<?php echo base_url('planilha/add'); ?>";
                }
            },
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF'
            }
        ]
    });
} );
</script>