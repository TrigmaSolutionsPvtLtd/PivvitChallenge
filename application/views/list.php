<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>List Purchases</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>
        <script src="<?php echo base_url(); ?>assets/script.js"></script>
        <link href="<?php echo base_url(); ?>assets/style.css" rel="stylesheet">
    </head>
    <body>

        <form method="post" name="offering" id="offering_frm">
            <table>
                <tr>
                    <th>Purchase ID</th>
                    <th>Offering title</th>
                    <th>Quantity</th>
                    <th>Unit price</th>
                    <th>Total</th>
                </tr>
                <?php
                if (!empty($lists)) {
                    foreach ($lists->response as $list) {
                        ?>
                        <tr>
                            <td><?php echo $list->id; ?></td>
                            <td><?php echo $list->title; ?></td>
                            <td><?php echo $list->quantity; ?></td>
                            <td><?php echo $list->price; ?></td>
                            <td><?php echo ($list->quantity * $list->price); ?></td>
                        </tr><?php
                    }
                }else{
                  echo '<tr><td align="center" colspan="5">No result found..</td></tr>';
                }
                ?>
            </table>
        </form>
    </body>
</html>