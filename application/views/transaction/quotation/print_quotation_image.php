<style>
	/* @media print {
		@page {
		  size: 8.267in 5.5in;
		  margin: 0;
		}
		.header-pt
		{
			font-size:14px;
            font-weight:bold;
		}
	} */
    .header-pt
		{
			font-size:18px;
            font-weight:bold;
		}
        .address-pt
		{
			font-size:18px;
		}
	.tbl-resi
	{
		font-size:11px;
	}
	.table-wrapper
	{
		border:2px solid black;
        border-bottom:2px solid black;
        border-top:2px solid black;
        border-left:2px solid black;
		padding-top:0px;
		width:100%;
	}

    .table-footer
	{
		padding-top:20px;
		width:100%;
	}


    .table-box-address
	{
		border:2px solid black;
        border-bottom:2px solid black;
        border-top:2px solid black;
        border-left:2px solid black;
		padding-top:0px;
		width:35%;
	}
    .table-box-po
	{
		border:2px solid black;
        border-bottom:2px solid black;
        border-top:2px solid black;
        border-left:2px solid black;
		padding-top:0px;
		width:35%;
	}
	.table-box-paraf
	{
		border:2px solid black;
        border-bottom:2px solid black;
        border-top:2px solid black;
        border-left:2px solid black;
		padding-top:0px;
		width:20%;
		height:20%;
	}
    .table-box
	{
		border:2px solid black;
        border-bottom:2px solid black;
        border-top:2px solid black;
        border-left:2px solid black;
		padding-top:0px;
		width:60%;
	}
	.border-bottom
	{
		border-bottom:1px solid gray;
	}
	.border-top
	{
		border-top:1px solid gray;
	}
	.border-left
	{
		border-left:1px solid gray;
	}
	.img-qrcode
	{
		position:absolute;
		top:0;
		right:0;
	}
	.img-logo
	{
		left:20px;
	}
	.img-logo2
	{
		left:20px;
	}
	.center {
  margin-left: auto;
  margin-right: auto;
}
	@media print {
            @page {
                /* width: 80mm; */
                margin: 0mm;
				padding-top:0mm;
            }
        }
</style>			
<title>::Quotation::</title>
<body>           
<div class="content-wrapper">
    <div class="table-wrapper">
	<table border="0" style="width:100%;height:20%;" class="table-box-po">
			    <tr><td style="width:25%;">
                    <img class="img-logo" src="<?php echo base_url("assets/images")."/logo.jpg"; ?>" width="200" height="120" />
                    </td>
                <td style="width:45%;padding-left:40px;" align="left">
                    <div class='header-pt'>PT. OPHELA SEJAHTERA UNGGUL</div>
                    <div class='address-pt'>General Suplier,Konveksi  & Stationary</div>
                    <div class='header-address'>JL.S.Halmahera Rt .06/01 Blok A7 no 11B</div>
                    <div class='header-address'>SKU - Mekarsari -Tambun Selatan -Bekasi</div>
                    <div class='header-address'>Telp 021-89530557</div>
                </td>
                <td style="width:15%;">
                    <img class="img-logo2" src="<?php echo base_url("assets/images")."/logos.jpg"; ?>" width="200" height="120" />
                    </td>
                </tr>
				
            </table>
			<?php
			?>
			<table style="width:100%;height:10%;text-align:center;font-size:22px;font-weight:bold;" border="1">
				<tr><td style="background-color:#00BFFF;">QUOTATION</td></tr>
			</table>
			<table border="0">
			<tr><td style="width:10%;text-align:right;" valign="top">To </td><td colspan="2">: <?php echo $quotation_m[0]->customer_name; ?> <br>
									<br>&nbsp;&nbsp;<?php echo $quotation_m[0]->address; ?></td></tr>
			<tr><td style="width:10%;text-align:right;" valign="top">Attn </td><td colspan="2">: <u> <?php echo $quotation_m[0]->customer_pic; ?></u>
					<br>&nbsp;&nbsp;<code><i><?php echo $quotation_m[0]->divisi; ?></i></code></td></tr>
			<tr><td style="width:10%;text-align:right;" valign="top"></td><td>&nbsp;&nbsp;Date </td><td> : <?php echo $quotation_m[0]->date; ?></td></tr>
			<tr><td style="width:10%;text-align:right;" valign="top"></td><td>&nbsp;&nbsp;Quo Num </td><td> : <?php echo $quotation_m[0]->quotation_no; ?></td></tr>
			<tr><td style="width:10%;text-align:right;" valign="top"></td><td>&nbsp;&nbsp;Expired Date </td><td> : <?php echo $quotation_m[0]->expired_date; ?></td></tr>
				
	
	</table>
	<table style="width:95%;" class="center" border="1" cellpadding='5' cellspacing='0'>
			<tr >
				<th class="border-bottom border-top border-left" style="font-size:12px;" height="10">NO</th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">ITEMS</th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">PICTURE</th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">UNIT PRICE</th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">QTY </th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">AMOUNT </th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">NOTE/DESCRIPTION </th>
			</tr>
			<tbody>
			<?php $i=1; $total=0; foreach($quotation_detail as $sd){ ?>
			
			<tr class="tbl-resi">
                <td style="width: 10px;text-align:center;font-size:12px;" valign="top"><?= $i; ?></td>
                <td style="width: 165px;font-size:12px;" valign="top"><?= $sd->item; ?>
				<td style="width: 20%;font-size:12px;"><img src="<?= base_url()."/uploads/quotation/".$sd->gambar;?>" style="width:305px;height:200px"></td>
                <td style="width: 10px;font-size:12px;text-align:center" valign="top"><?= indo_currency($sd->price); ?></td>
                <td style="width: 10px;font-size:12px;text-align:center" valign="top"><?= $sd->qty ." ".$sd->ukuran; ?></td>
                <td style="width: 10px;font-size:12px;text-align:center" valign="top"><?= indo_currency($sd->amount); ?></td>
                <td style="width: 150px;font-size:12px;text-align:left" valign="top"><?= $sd->note; ?></td>
			</tr>
			<?php $i++; 
             } ?>
			 </table>
			 
		</tbody>
		</table>
		<br><br><br><table style="width:90%;" class="center" border="0" cellpadding='5' cellspacing='0'>
		<tr><td><code>Note
			<br>Harga sewaktu waktu dapat berubah
			<br>Harga belum termasuk Ppn 11% </td></tr>
			</table>
			<hr></hr>
		<table style="width:90%;" class="center" border="0" cellpadding='5' cellspacing='0'>
			<tr>
			<td style="width: 10px;text-align:left;font-size:12px;">Proposed by <br>PT. OPHELA SEJAHTERA UNGGUL <br>
			<img class="img-logo" src="<?php echo base_url("assets/images")."/ttd_ophela.jpg"; ?>" width="200" height="120" /><br><br>
			<u>Dede Remiyanto</u><br><code><i>Direktur Utama</i></code> </td>
			<td style="width: 10px;text-align:center;font-size:12px;"></td>
			<td style="width: 10px;text-align:center;font-size:12px;"></td>
			<td style="width: 10px;text-align:left;font-size:12px;">Approved By <br><?php echo $quotation_m[0]->customer_name; ?> <br><br><br><br><br><br><br><br><br><br>
			<u><?php echo $quotation_m[0]->customer_pic; ?></u><br><code><i><?php echo $quotation_m[0]->divisi; ?></i></code> </td>
			    
			
			 </table>
			 
		</tbody>
		</table>
		