<html lang="en">
    <head>
        <title></title>
        <meta charset="utf-8" />
    </head>
<body class="margin-left:40px;" onload="window.print()">
    <table width="100%">
        <tr>
            <td width="34%" align="center">
            <h4>Laporan Rekap Penjualan <br>
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
                <td style="text-align: left;"><?= $cust; ?></td>
                <td style="text-align: center;"><?= indo_date($row->date)?></td>
                <td style="text-align: right;"><?= indo_currency($row->total_price); ?></td>
                <td style="text-align: right;"><?= indo_currency($row->discount);?></td>
                <td style="text-align: right;"><?= indo_currency($row->final_price);?></td>
            </tr>
                            
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