<style>
	@media print {
		@page {
		  size: 8.267in 5.5in;
		  margin: 0;
		}
		.header-pt
		{
			font-weight:bold;
		}
	}
	.tbl-resi
	{
		font-size:11px;
	}
	.table-wrapper
	{
		border:1px solid gray;
		border-top:4px solid gray;
		height:180px;
		padding-top:5px;
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
		top:10px;
		left:20px;
	}
</style>			
<div class="content-wrapper print resi">
	<table border="1" style="width:90%">
		<tr>
            <td style="width:5%">
                <img class="img-logo" src="<?php echo base_url("assets/images")."/logo.jpg"; ?>" width="100" height="80" />
				</td>
			<td align="center" valign='top'>
				<div class='header-pt'>PT. OPHELA SEJAHTERA UNGGUL</div>
				<div class='header-address'>General Suplier,Konveksi  & Stationary</div>
				<div class='header-address'>JL.S.Halmahera Rt .06/01 Blok A7 no 11B</div>
				<div class='header-address'>SKU - Mekarsari -Tambun Selatan -Bekasi</div>
				<div class='header-address'>Telp 021-89530557</div>
			</td>
			<td valign='top'>
				<!-- <img class="img-qrcode" src="<?php echo base_url("export")."/".$data->id_pengiriman.".png"?>" width="90" height="90" /> -->
				<div >
					BEKASI, <?php echo date('d M Y',strtotime($sale->date)); ?>
				</div>
				<div class='mt10'>
					KEPADA Yth.
				</div>
				<div>
					<?php echo $sale->customer_name; ?>
				</div>
				<div class='mt10'>
					<?php echo $sale->address; ?>
				</div>
			</td>
		</tr>
		<tr>
			<td rowspan="2">
				<div class='header-pt'>SURAT JALAN NO. : <?php echo $sale->delivery_no; ?></div>
				<div class='header-pt'>NO KENDARAAN. : <?php echo $sale->no_kendaraan; ?></div>
			</td>
		<tr>
	</table>
	<div class='table-wrapper'>
		<table style="width:100%"  border="1" style="mt10"  cellpadding='5' cellspacing='0'>
			<tr >
				<th class="border-bottom border-top " height="10">No</th>
				<th class="border-bottom border-top">ITEM CODE</th>
				<th class="border-bottom border-top">UM</th>
				<th class="border-bottom border-top">QTY</th>
				<th class="border-bottom border-top">PART NO</th>
				<th class="border-bottom border-top">NAME</th>
				<th class="border-bottom border-top">DESCRIPTION</th>
			</tr>
			<tbody>
			<?php $i=1; foreach($sale_detail as $sd){ ?>
			
			<tr  class="tbl-resi">
                <td style="width: 10px;text-align:center"><?= $i; ?></td>
                <td style="width: 165px;"><?= $sd->barcode; ?></td>
                <td style="width: 165px;"><?= $sd->name; ?></td>
                <td style="width: 10px;text-align:center"><?= $sd->qty; ?></td>
                <td style="width: 165px;"><?= $sd->item_name; ?></td>
                        <td style="text-align: right;width:60px;"><?= indo_currency($sd->price); ?></td>
                        <td style="text-align: right;width:60px;">
                            <?= indo_currency(($sd->price - $sd->discount_item) * $sd->qty); ?>
                        </td>
			</tr>
			<?php $i++; 
             } ?>
		</tbody>
		</table>
	</div>
	<table style="width:100%">
		<tr>
			<td valign='top' style="width:55%" >
				<div class='mt10'>
					Kendaraan No. <?php echo $data->no_kendaraan; ?>
				</div>
				<div class='mt10'>
					PO No. <?php echo $data->no_po; ?>
				</div>
			</td>
			<td valign='top' style="width:30%">
				<div class='mt10'>
					Diterima Oleh: 
				</div>
			</td>
			<td valign='top' style="width:15%">
				<div class='mt10'>
					Terima Kasih <br> Hormat Kami
				</div>
			</td>
		</tr>
	</table>
	
</div>
<script>
	$(function(){
		window.print();
	});
</script>
