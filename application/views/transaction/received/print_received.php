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
	@media print {
            @page {
                /* width: 80mm; */
                margin: 0mm;
				padding-top:0mm;
            }
        }
</style>			
<title>::Received::</title>
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
			
			<table border="0">
				  <tr><td style="padding-left:5px;width:15%" valign='top' rowspan="2"><b>Nama Pengirim </b></td><td valign='top' rowspan="3" style="width:15%">: <?php echo $received_m[0]->pengirim; ?>
				  <td style="padding-left:20px;width:20%" valign='top'><b>Nama Penerima </b></td><td> : <?php echo $received_m[0]->customer_name; ?>
                    
					<td style="padding-left:20px;width:20%" valign='top'><b>PIECES/SATUAN </b></td>
                    <tr><td style="padding-left:20px;width:10%" valign='top'><b>Alamat </b></td><td> : <?php echo $received_m[0]->address; ?>
					<td style="padding-left:20px;width:20%">JENIS PENGIRIMAN</td>
					</tr>
					<tr><td class="table-box-paraf" valign='top'>Paraf Pengirim</td>
					<td style="padding-left:20px;width:10%" valign='top'><b>Attn </b></td><td valign='top'> : <?php echo $received_m[0]->customer_pic; ?>
						<td style="padding-left:10px;width:20%"><input type="checkbox">DOKUMEN <br> 
							<input type="checkbox">PARSEL/ PAKET <br>
							<input type="checkbox">BARANG <br>
							<input type="checkbox">LAINNYA <br></td>
					</tr>
					<tr><td valign='top'><td><td style="padding-left:20px;width:10%" valign='top'><b>Telephone</td><td valign='top'> : <?php echo $received_m[0]->customer_pic; ?>
					<tr><td valign='top'><td><td style="padding-left:20px;width:10%" valign='top'><b>Tanggal Kirim</td><td valign='top'> : <?php echo indo_date($received_m[0]->date_kirim); ?>
					
					
					
					
                </td>
	</tr>
	
	</table>

		<table style="width:100%;height:10%;text-align:center;font-size:22px;font-weight:bold;" border="1">
		<tr><td style="background-color:#00BFFF;">TANDA TERIMA</td></tr>
	</table>
	</table>
	<!-- <div class='table-wrapper'> -->
	<table style="width:100%" border="1" cellpadding='5' cellspacing='0'>
			<tr >
				<th class="border-bottom border-top border-left" style="font-size:12px;" height="10">NO</th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">Invoice No</th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">PR No</th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">Surat jalan No </th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">PO No </th>
			</tr>
			<tbody>
			<?php $i=1; $total=0; foreach($received_detail as $sd){ ?>
			
			<tr class="tbl-resi">
                <td style="width: 10px;text-align:center;font-size:12px;"><?= $i; ?></td>
                <td style="width: 165px;font-size:12px;"><?= $sd->invoice_no; ?></td>
                <td style="width: 10px;font-size:12px;text-align:center"><?= $sd->no_pr; ?></td>
                <td style="width: 10px;font-size:12px;text-align:center"><?= $sd->delivery_no; ?></td>
                <td style="width: 10px;font-size:12px;text-align:center"><?= $sd->no_po; ?></td>
			</tr>
			<?php $i++; 
             } ?>
			 </table>
			 
		</tbody>
		</table>
<br>
		<table style="width:100%;" border="1" cellpadding='5' cellspacing='0'>
			<tr ><td colspan="4" class="border-bottom border-top border-left" style="width:100%;height:10%;text-align:center;font-size:22px;font-weight:bold;" height="10">DITERIMA</td></tr>
			
			<tr>
			<td style="width: 10px;text-align:center;font-size:12px;">TGL <br><br><br><br><br><br></td>
			<td style="width: 10px;text-align:center;font-size:12px;">NAMA <br><br><br><br><br><br></td>
			<td style="width: 10px;text-align:center;font-size:12px;">TANDA TANGAN <br><br><br><br><br><br></td>
			<td style="width: 10px;text-align:center;font-size:12px;">STEMPEL PERUSAHAAN <br><br><br><br><br><br></td>
			    
			
			 </table>
			 
		</tbody>
		</table>
		