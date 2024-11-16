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
		margin-left:10px;
		width:98%;
	}

    .table-footer
	{
		padding-top:20px;
		margin-left:10px;
		width:98%;
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
                width: 80mm;
                margin: 0mm;
            }
        }
</style>			
<title>::Delivery Order::</title>
<body onload="window.print()">           
<div class="content-wrapper">
    <div class="table-wrapper">
	<table border="0" style="width:100%;height:20%;">
		<tr>
               <tr><td width="15%">
                    <img class="img-logo" src="<?php echo base_url("assets/images")."/logo.jpg"; ?>" width="200" height="120" />
                    </td>
                <td style="padding-left:80px;" align="left" valign='top'>
                    <div class='header-pt'>PT. OPHELA SEJAHTERA UNGGUL</div>
                    <div class='address-pt'>General Suplier,Konveksi  & Stationary</div>
                    <div class='header-address'>JL.S.Halmahera Rt .06/01 Blok A7 no 11B</div>
                    <div class='header-address'>SKU - Mekarsari -Tambun Selatan -Bekasi</div>
                    <div class='header-address'>Telp 021-89530557</div>
                </td>
                <td class="table-box-address" style="padding-left:10px;" valign='top'>
                    <!-- <img class="img-qrcode" src="<?php echo base_url("export")."/".$data->id_pengiriman.".png"?>" width="90" height="90" /> -->
                    <div class='address-pt'>
                        BEKASI, <?php echo date('d M Y',strtotime($sale->date)); ?>
                    </div><br>
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
            </table>
                <table style="width:100%;">
                <tr>
			    <td class="table-box">
				<div class='header-pt'>SURAT JALAN NO. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?php echo $sale->delivery_no; ?></td></div>
                <tr>
			    <td class="table-box"><div class='header-pt'>NO KENDARAAN. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <?php echo $sale->no_kendaraan; ?></td></div>
                <td><td class="table-box-po"><div class='header-pt'>PO NO.  :  <?php echo $sale->no_po; ?></td></div>
                </tr>
            </table>
		<br>
	</table>
	<!-- <div class='table-wrapper'> -->
		<table style="width:100%" border="1" style="mt10"  cellpadding='5' cellspacing='0'>
			<tr >
				<th class="border-bottom border-top" height="10">No</th>
				<th class="border-bottom border-top">ITEM CODE</th>
				<th class="border-bottom border-top">Uom</th>
				<th class="border-bottom border-top">QTY</th>
				<th class="border-bottom border-top">NAME</th>
				<th class="border-bottom border-top">DESCRIPTION</th>
			</tr>
			<tbody>
			<?php $i=1; foreach($sale_detail as $sd){ ?>
			
			<tr  class="tbl-resi">
                <td style="width: 10px;text-align:center"><b><?= $i; ?></b></td>
                <td style="width: 165px;"><b><?= $sd->barcode; ?></b></td>
                <td style="width: 165px;"><b><?= $sd->name_unit; ?></b></td>
                <td style="width: 10px;text-align:center"><b><?= $sd->qty; ?></b></td>
                <td style="width: 165px;"><b><?= $sd->item_name; ?></b></td>
                <td style="width: 165px;"><b><?= $sd->description; ?></b></td>
			</tr>
			<?php $i++; 
             } ?>
		</tbody>
		</table>
            </div>
            <table class='table-footer' style="width:90%">
            <tr><td style="width:40%"><b>Terima kasih <br><br><br><br><br><br><br><br><br><br>( ........................... )</td>
            <td style="width:20%"></td>
            <td style="width:30%"><b> Hormat kami <br> PT. OPHELA SEJAHTERA UNGGUL 
            <br><br><br><br><br><br><br><br><br><br>( ........................... )</td></tr>
	
	
</div>	</div>	
			</body>
<script>
	$(function(){
		window.print();
	});
</script>
