<html lang="en">
    <head>
        <title></title>
        <meta charset="utf-8" />
    </head>
<body class="margin-left:40px;" onload="window.print()">
    <table width="100%">
        <tr>
            <td width="34%" align="center">
            <h4>Laporan Transaksi Penjualan <br>
            Dari tanggal <?= indo_date($s); ?> sampai tanggal <?= indo_date($e); ?></h4></td>
        </tr>
    </table>
    <table width="100%" class="table" cellspacing="0" cellpading="0" style="font-size: 16px;" border="1">
        <thead style="background-color: yellowgreen;">
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Customer</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Discount</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; 
            $total =0;
            $discount =0;
            $subtotal =0;
            ?>
            <?php foreach($detailLaporan as $row) {
                $total +=$row->total_price;
                $discount +=$row->discount;
                $subtotal +=$row->final_price;
                ?>
            <tr>
                <td style="text-align: center;"><?= $no++; ?></td>
                <td style="text-align: center;"><?= $row->invoice_no; ?></td>
                <?php if($row->customer_id == null){
                    $cust = 'Umum';
                }else{
                    $cust = $row->customer;
                }?>
                <td style="text-align: center;"><?= $cust; ?></td>
                <td style="text-align: center;"><?= indo_date($row->date)?></td>
                <td style="text-align: right;"><?= indo_currency($row->total_price); ?></td>
                <td style="text-align: right;"><?= indo_currency($row->discount);?></td>
                <td style="text-align: right;"><?= indo_currency($row->final_price);?></td>
            </tr>
                            <tr style="background-color:cadetblue;font-style: italic;">
                                        <th colspan="2">Barcode</th>
                                        <th>Product Item</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th width="10%">Discount Item</th>
                                        <th width="15%">Total</th>
                                    </tr>
                                    <tbody id="cart_table_del">
                                    <?php
                                    // $no =1;
                                    $delivery = $this->sale_m->get_delivery($row->sale_id)->result();
        
                                        foreach ($delivery as $c){?>
                                        <tr style="background-color:cadetblue;font-style: italic;font-size:12px;">
                                            <td colspan="2" align="center"><?= $c->barcode; ?></td>
                                            <td><?= $c->item_name; ?></td>
                                            <td align="center"><?= $c->qty; ?></td>
                                            <td align="right"><?= indo_currency($c->cart_price); ?></td>
                                            <td align="right"><?php if ($c->discount_item != 0) {
                                                    $uang = indo_currency($c->discount_item);
                                                } else {
                                                    $uang = $c->discount_item;
                                                } ?>
                                                <?= $uang; ?>
                                            </td>
                                            <td align="right"><?= indo_currency($c->total); ?></td>
                                            
                                        </tr>

                                                <?php }
                
                                    ?>
                                </tbody>
            <?php }?>
            <tr><td colspan="4" style="text-align: right;"><b>Sub Total</b></td>
            <td style="text-align: right;"><?= indo_currency($total); ?></td>
            <td style="text-align: right;"><?= indo_currency($discount); ?></td>
            <td style="text-align: right;"><?= indo_currency($subtotal); ?></td>
            </tr>
        </tbody>
    </table>
    </body>
</html>