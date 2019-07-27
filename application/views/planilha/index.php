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
            <?php 
                $map = array(
                    'key_email' => null,
                    'key_nome' => null,
                    'key_cartao' => null,
                    'key_bandeira' => null,
                    'key_validade' => null
                    );
                foreach ($data['data'] as $key => $value) { ?>
            <tr>
                <td></td>
                <?php foreach ($fields as $i => $val) {
                    $value[$i]=utf8_decode($value[$i]);
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
                        $map['key_email'] = $i+1;
                        if($email) {
                            echo "<td data-toggle='modal' data-target='#sendEmail'>$value[$i]</td>";
                        } else {
                            echo "<td>$value[$i]</td>";
                        }
                    } else if (str_replace('-', '', strtolower($fields[$i])) == "nome" || strstr(strtolower($fields[$i]), "nome") ) { 
                        $map['key_nome'] = $i+1;
                        echo "<td>".$value[$i]."</td>";
                    } else if (str_replace('-', '', strtolower($fields[$i])) == "cartao" || strstr(strtolower($fields[$i]), "cartao") ) { 
                        $map['key_cartao'] = $i+1;
                        echo "<td>".$value[$i]."</td>";
                    } else if (str_replace('-', '', strtolower($fields[$i])) == "bandeira" || strstr(strtolower($fields[$i]), "bandeira") ) { 
                        $map['key_bandeira'] = $i+1;
                        echo "<td>".$value[$i]."</td>";
                    } else if (str_replace('-', '', strtolower($fields[$i])) == "validade" || strstr(strtolower($fields[$i]), "validade") ) { 
                        $map['key_validade'] = $i+1;
                        echo "<td>".$value[$i]."</td>";
                    } else {

                        echo "<td>".$value[$i]."</td>";
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
        lengthMenu: [
            [ 25, 50, 100, 150, -1 ],
            [ '25 linhas', '50 linhas', '100 linhas', '150 linhas', 'Todas linhas' ]
        ],
        buttons: [
            'pageLength',
            {
                extend: 'colvis',
                text: 'Col Visíveis',
            },
            {
                text: 'Sel Tudo',
                action: function () {
                    table.rows().select();
                }
            },
            {
                text: 'Deselecionar',
                action: function () {
                    table.rows().deselect();
                }
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
            <?php if (isset($_SESSION['email']) && !is_null($map['key_email']) && !is_null($map['key_nome'])) { ?>
            {
                text: 'Email',
                action: function ( e, dt, node, config) {                    
                    $(".list_seleted_mail").html('');
                    $('.total_row').html('0');

                    var rowData = table.rows( { selected: true } ).data().toArray();
                    var data = JSON.stringify( rowData );
                    console.log(rowData);
                    for (var i = rowData.length - 1; i >= 0; i--) {
                        $(".list_seleted_mail").prepend( '<tr><td>'+(i+1)+'</td><td>'+rowData[i][<?php echo is_null($map['key_nome'])?1:$map['key_nome']; ?>]+'</td><td>'+rowData[i][<?php echo $map['key_email']; ?>]+'</td></tr>' );
                    };
                    $('.total_row').html(rowData.length);
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
            <?php if (isset($_SESSION['pagamento']) && !is_null($map['key_cartao']) && !is_null($map['key_bandeira']) && !is_null($map['key_validade'])) { ?>
            {
                text: 'Pagamentos',
                action: function ( e, dt, node, config ) {
                    $(".list_seleted_pag").html('');
                    $('.total_row').html('0');

                    var rowData = table.rows( { selected: true } ).data().toArray();
                    var data = JSON.stringify( rowData );
                    console.log(rowData);
                    for (var i = rowData.length - 1; i >= 0; i--) {
                        $(".list_seleted_pag").prepend( '<tr><td>'+(i+1)+'</td><td>'+rowData[i][<?php echo is_null($map['key_cartao'])?1:$map['key_cartao']; ?>]+'</td><td>'+rowData[i][<?php echo $map['key_bandeira']; ?>]+'</td><td>'+rowData[i][<?php echo $map['key_validade']; ?>]+'</td></tr>' );
                    };
                    $('.total_row').html(rowData.length);
                    $("#sendPag").modal('show');
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