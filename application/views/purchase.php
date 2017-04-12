<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Make a Purchase</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>
        <script src="<?php echo base_url(); ?>assets/script.js"></script>
        <link href="<?php echo base_url(); ?>assets/style.css" rel="stylesheet">
    </head>
    <body>
        <form method="post" name="offering" id="offering_frm">
            <table>
                <tr>
                    <td>Offering: </td>
                    <td>
                        <select name="offering" id="offering">
                            <option data-price="0" value="">Please Select</option>
                            <?php foreach ($offers as $offer): ?>
                                <option data-price="<?php echo $offer['price']; ?>" value="<?php echo $offer['id']; ?>"><?php echo $offer['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="error"><?php echo form_error('offering'); ?></label>
                    </td>
                </tr>
                <tr>
                    <td>Customer name: </td><td><input type="" name="customer_name"><label class="error"><?php echo form_error('customer_name'); ?></label></td>
                </tr>
                <tr>
                    <td>Quantity: </td><td><input id="qty" type="number" name="quantity"><label class="error"><?php echo form_error('quantity'); ?></label></td>
                </tr>
                <tr>
                    <td id="grandtotal"></td><td><input type="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
    </body>
</html>