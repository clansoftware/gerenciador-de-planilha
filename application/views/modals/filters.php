<?php if(!empty($filters)) { ?>
    <table cellspacing="5" cellpadding="5" border="0" class="table table-sm table-hover table-striped table-bordered table-borderless display">
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