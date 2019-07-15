<div class="table-responsive-sm">
    <table id="example" class="table table-sm table-hover table-striped table-bordered table-borderless display" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <?php foreach ($fields as $key => $value) {
                    echo "<th>".utf8_decode($value)."</th>";
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
                    echo "<th>".utf8_decode($value)."</th>";
                } ?>
            </tr>
        </tfoot>
    </table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable({
            "language": {
                "url": "<?php echo base_url('assets/json/Portuguese-Brasil.json'); ?>"
            }
    });
} );
</script>