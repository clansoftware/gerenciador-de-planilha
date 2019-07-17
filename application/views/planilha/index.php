<div class="table-responsive-sm">
<?php if(!empty($filters)) { ?>
    <table cellspacing="5" cellpadding="5" border="0" class="table table-sm table-hover table-striped table-bordered table-borderless display"class="table table-sm table-hover table-striped table-bordered table-borderless display">
        <tbody>
            <tr class="<?php echo !isset($filters['needAge'])?'d-none':'';?>" >
                <td>
                    Idade:
                    <input type="text" id="age_min" name="minima" placeholder="De">
                    <input type="text" id="age_max" name="maxima" placeholder="Até">
                </td>
            </tr>
        </tbody>
    </table>
<?php } ?>
    <table id="example" class="table table-sm table-hover table-striped table-bordered table-borderless display" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <?php foreach ($fields as $key => $value) {
                    echo "<th>".utf8_decode(str_replace(array('-','_'), ' ', ucfirst($value)))."</th>";
                } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['data'] as $key => $value) { ?>
            <tr>
                <?php foreach ($fields as $i => $val) {
                    if (strtolower($fields[$i]) == "celular") {
                        echo "<td>";
                        echo $value[$i];
                        $number = MY_Controller::isWhattsapp($value[$i]);
                        if($number!=false) {
                            echo "<a href='https://api.whatsapp.com/send?phone=$number&text=Ol%c3%a1%2c%20meu%20amigo%21&source=&data=' target='_blank'>";
                                echo "<img src='".base_url('assets/img/whats.png')."' />";
                            echo "</a>";
                        }
                        echo "</td>";
                    } else if (str_replace('-', '', strtolower($fields[$i])) == "email") {
                        echo "<td>";
                            echo $value[$i];
                            echo "<img src='".base_url('assets/img/mail.png')."' />";
                        echo "</td>";
                    } else {

                        echo "<td>".utf8_decode($value[$i])."</td>";
                    }
                } ?>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <?php foreach ($fields as $key => $value) {
                    echo "<th>".utf8_decode(str_replace(array('-','_'), ' ', ucfirst($value)))."</th>";
                } ?>
            </tr>
        </tfoot>
    </table>
</div>

<script type="text/javascript">
<?php if (!empty($filters)) { 
        if (isset($filters['needAge'])) { ?>
            /* Custom filtering function which will search data in column four between two values */
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min = parseInt( $('#age_min').val(), 10 );
                    var max = parseInt( $('#age_max').val(), 10 );
                    var age = parseFloat( data[<?php echo $filters['needAge'] ?>] ) || 0; // use data for the age column
             
                    if ( ( isNaN( min ) && isNaN( max ) ) ||
                         ( isNaN( min ) && age <= max ) ||
                         ( min <= age   && isNaN( max ) ) ||
                         ( min <= age   && age <= max ) )
                    {
                        return true;
                    }
                    return false;
                }
            );
    <?php } ?>
<?php } ?>
$(document).ready(function() {
    var table = $('#example').DataTable({
        "language": {
            "url": "<?php echo base_url('assets/json/Portuguese-Brasil.json'); ?>"
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'colvis',
                text: 'Colunas Visíveis',
            },
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
    
    <?php { ?>
        // Event listener to the two range filtering inputs to redraw on input
        $('#age_min, #age_max').keyup( function() {
            table.draw();
        } );
    <?php } ?>

} );
</script>