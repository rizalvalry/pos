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
		margin-left:30px;
		width:90%;
	}

    .table-footer
	{
		padding-top:20px;
		width:90%;
		margin-left:30px;
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
		position:absolute;
		top:20px;
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
<title>::Invoice::</title>
<body>           
<div class="content-wrapper">
    <div class="table-wrapper">
	<table border="0" style="width:100%;height:20%;" class="table-box-po">
	<tr><td style="width:25%;">
                    <img class="img-logo2" src="<?php echo base_url("assets/images")."/logo.jpg"; ?>" width="200" height="120" />
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
				  <tr><td style="padding-left:20px;width:10%" valign='top'><b>To :</b></td><td> <?php echo $sale->customer_name; ?>
                    </div>
                    <div class='mt10'>
                        <?php echo $sale->address; ?>
                    </div>
					</tr>
					<tr><td style="padding-left:20px;width:10%" valign='top'><b>Attn :</b></td><td> <?php echo $sale->pic; ?>
						</div>
						<div class='mt10'>
							<?php echo $sale->divisi; ?>
						</div>
					</tr>
                   
                </td>
	</tr>
	
	</table>
	<table style="width:100%;" border="0"><br>
	<?php
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
echo '<td style="width:60%;"><td colspan="2"><img src="data:image/png;base64,' . base64_encode($generator->getBarcode($sale->invoice_no, $generator::TYPE_CODE_128)) . '" class="barcode" size="3" width="60%" height="30" >';

	?>
                <tr><td style="width:60%;">
				<td style="width:10%;">PR No </td><td>  :  <?php echo $sale->no_pr; ?></td>
                <tr><td style="width:60%;">
				<td style="width:10%;">INV No </td><td>  :  <?php echo $sale->invoice_no; ?></td>
                <tr><td style="width:60%;">
				<td style="width:10%;">PO No </td><td>  :  <?php echo $sale->no_po; ?></td>
                </tr>
				<tr><td style="width:60%;">
				<td style="width:10%;">DO No </td><td>  :  <?php echo $sale->delivery_no; ?></td>
                </tr>
			   
            </table>
		<br>
		<table style="width:100%;height:5%;text-align:center;font-size:22px;font-weight:bold;" border="0">
		<tr><td style="background-color:#00BFFF;">INVOICE</td></tr>
	</table>
	</table>
	<!-- <div class='table-wrapper'> -->
		<table style="width:100%" border="0" cellpadding='5' cellspacing='0'>
			<tr >
				<th class="border-bottom border-top border-left" style="font-size:12px;" height="10">NO</th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">DESCRIPTION</th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">QTY</th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">UNIT PRICE</th>
				<th class="border-bottom border-top border-left" style="font-size:12px;">AMOUNT</th>
			</tr>
			<tbody>
			<?php $i=1; $total=0; foreach($sale_detail as $sd){ 
				$total = $total + $sd->total; ?>
			
			<tr class="tbl-resi">
                <td style="width: 10px;text-align:center;font-size:12px;"><?= $i; ?></td>
                <td style="width: 165px;font-size:12px;"><?= $sd->item_name; ?></td>
                <td style="width: 10px;font-size:12px;text-align:center"><?= $sd->qty; ?></td>
                <td style="width: 165px;font-size:12px;text-align:right;"><?= indo_currency($sd->price_d); ?></td>
                <td style="width: 165px;font-size:12px;text-align:right"><?= indo_currency($sd->total); ?></td>
			</tr>
			<?php $i++; 
             } ?>
			 </table>
			 <table style="width:100%" border="1" cellpadding='5' cellspacing='0'>
			 <tr  class="tbl-resi">
			 <td style="text-align:right;font-size:14px;width:40%" colspan="2">SUB TOTAL</td><td style="text-align:right" colspan="3"><?= indo_currency($sale->total_price); ?>			</td>
			 <tr  class="tbl-resi">
			 <td style="text-align:right;font-size:14px;width:40%" colspan="2">Value Add Tax (VAT) 11% </td><td style="text-align:right" colspan="3"><?= indo_currency($sale->grand_tax); ?>			</td>
			 <tr  class="tbl-resi">
			 <td style="text-align:right;font-size:14px;width:40%" colspan="2">TOTAL</td><td style="text-align:right" colspan="3"><?= indo_currency($sale->final_price); ?>			</td>
			</tr>
		</tbody>
		</table>
		<table style="width:80%;height:60px;" border="0">
                <tr>
			    <td style="text-align:right;font-size:14px;width:10%">TERBILANG</td>
				<td style="text-align:right;font-size:14px;width:2%"></td>
				<td class="table-box-po" style="padding-left:10px;font-weight:bold;font-size:14px;"> <?php echo terbilang($sale->final_price); ?> Rupiah</td>
                </tr>
            </table>
            </div>
            <table class='table-footer' border="0" style="width:90%">
            <tr><td style="width:40%;font-size:14px;"><b>Note : 
            <br><br>Transfer to our account at:
			<br>Bank Mandiri Cabang tambun
			<br>An PT.OPHELA SEJAHTERA UNGGUL
			<br>A/C No. 156-00-1574629-2

			<br>NPWP: 83.429.833.3-435.001<br><br><br><br><br><br>
			</td>
			<td style="width:20%"></td>
            <td style="width:30%;font-size:12px;"><b> BEKASI, <?php echo date('d M Y',strtotime($sale->date)); ?> 
			<br> PT. OPHELA SEJAHTERA UNGGUL 
            <br><br><br><br><br><br><br><br><br><br><u>Dede Remiyanto</u>
			<br>Direktur utama</td></tr>
	
	
</div>	</div>	
			</body>
<script>
	$(function(){
		window.print();
	});
</script>
