<div class="table-responsive-sm">
    <table id="example" class="table table-sm table-hover table-striped table-bordered table-borderless display" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <?php foreach ($fields as $key => $value) {
                    echo "<th>$value</th>";
                } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['data'] as $key => $value) { ?>
            <tr>
                <?php foreach ($fields as $i => $val) {
                    echo "<td>$value[$i]</td>";
                } ?>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <?php foreach ($fields as $key => $value) {
                    echo "<th>$value</th>";
                } ?>
            </tr>
        </tfoot>
    </table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            }
    });
} );
</script>