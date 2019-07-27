<table cellspacing="6" cellpadding="6" border="0" class="table table-sm table-hover table-striped table-bordered table-borderless display">
    <tbody>
        <?php if(!empty($filters)) { ?>
        <tr>
            <td>Has Filter</td>
            <td>
                <select class="form-control form-control-sm">
                <?php foreach ($fields as $key => $value) {
                    echo "<option>".utf8_decode(str_replace(array('-','_'), ' ', ucfirst($value)))."</option>";
                } ?>
                </select>
            </td>
            <td>
                <select class="form-control form-control-sm">
                    <option>Opções</option>
                </select>
            </td>

        <?php } ?>
    <?php if(!empty($filters)) { ?>
         
                <td>
                    Idade:
                </td>
                <td>
                    <input class="form-control form-control-sm" type="number" id="age_min" name="minima" placeholder="De">
                </td>
                <td>
                    <input class="form-control form-control-sm" type="number" id="age_max" name="maxima" placeholder="Até">
                </td>
                <td colspan="3">
                </td>
            
    <?php } ?>
        </tr>
    </tbody>
</table>