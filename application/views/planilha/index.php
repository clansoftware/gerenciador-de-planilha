<div class="table-responsive-sm">
    <?php $this->load->view('modals/filters'); ?>
    <table id="example" class="table table-sm table-hover table-striped table-bordered table-borderless display" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th>
                    <input type="checkbox" class="form-control" onclick="marc_all_check_page()"/>
                </th>
                <?php foreach ($fields as $key => $value) {
                    echo "<th>".utf8_decode(str_replace(array('-','_'), ' ', ucfirst($value)))."</th>";
                } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['data'] as $key => $value) { ?>
            <tr>
                <td></td>
                <?php foreach ($fields as $i => $val) {
                    if (strtolower($fields[$i]) == "celular") {
                        $number = MY_Controller::isWhattsapp($value[$i]);
                        if($number!=false) {
                            echo "<td data-toggle='modal' data-target='#sendWhats' data-whats='https://api.whatsapp.com/send?phone=$number&text=Ol%c3%a1%2c%20meu%20amigo%21&source=&data=' target='modal'>";
                                echo $value[$i];
                            echo "</td>";
                        } else {
                            echo "<td>$value[$i]</td>";
                        }
                    } else if (str_replace('-', '', strtolower($fields[$i])) == "email") {
                        $email = MY_Controller::isEmail($value[$i]);
                        if($email) {
                            echo "<td data-toggle='modal' data-target='#sendEmail'>$value[$i]</td>";
                        } else {
                            echo "<td>$value[$i]</td>";
                        }
                    } else {

                        echo "<td>".utf8_decode($value[$i])."</td>";
                    }
                } ?>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>
                    <input type="checkbox" class="form-control" onclick="marc_all_check_page()"/>
                </th>
                <?php foreach ($fields as $key => $value) {
                    echo "<th>".utf8_decode(str_replace(array('-','_'), ' ', ucfirst($value)))."</th>";
                } ?>
            </tr>
        </tfoot>
    </table>
</div>
<?php $this->load->view('modals/cad_op'); ?>
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
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]],
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
            <?php if (isset($_SESSION['sms'])) { ?>
            {
                text: 'SMS',
                action: function ( e, dt, node, config ) {
                    $("#sendSMS").modal("show");
                }
            },
            <?php } ?>
            <?php if (isset($_SESSION['email'])) { ?>
            {
                text: 'Email',
                action: function ( e, dt, node, config ) {
                    $("#sendEmail").modal('show');
                }
            },
            <?php } ?>
            <?php if (isset($_SESSION['sendWhattsapp'])) { ?>
            {
                text: 'Whattsapp',
                action: function ( e, dt, node, config ) {
                    $("#sendWhats").modal('show');
                }
            },
            <?php } ?>
            <?php if (isset($_SESSION['pagamento'])) { ?>
            {
                text: 'Cielo',
                action: function ( e, dt, node, config ) {
                    $("#sendCielo").modal('show');
                }
            },
            <?php } ?>
            <?php if (isset($_SESSION['pagamento'])) { ?>
            {
                text: 'Pagseguro',
                action: function ( e, dt, node, config ) {
                    $("#sendPagSeguro").modal('show');
                }
            },
            <?php } ?>
            <?php if (isset($_SESSION['pagamento'])) { ?>
            {
                text: 'Paypal',
                action: function ( e, dt, node, config ) {
                    $("#sendPaypal").modal('show');
                }
            },
            <?php } ?>
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