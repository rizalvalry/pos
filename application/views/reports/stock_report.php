<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Report Stock</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Report Stock</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan') ?>">
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table id="myTables" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th>Barcode</th>
                            <th>Item Name</th>
                            <th>Detail</th>
                            <th>Qty</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($stock as $s) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $s->barcode; ?></td>
                                <td><?= $s->item_name ?></td>
                                <td><?= $s->detail; ?></td>
                                <td style="text-align: right;"><?= $s->qty ?></td>
                                <td style="text-align: center;"><?= indo_date($s->date) ?></td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal-detail">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <div class="container-fluid">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>Barcode</th>
                                <td>:</td>
                                <td>
                                    <span id="barcode">&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Item Name</th>
                                <td>:</td>
                                <td>
                                    <span id="item_name">&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Supplier</th>
                                <td>:</td>
                                <td>
                                    <span id="supplier">&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Qty</th>
                                <td>:</td>
                                <td>
                                    <span id="qty">&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Date </th>
                                <td>:</td>
                                <td>
                                    <span id="date">&nbsp;</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '#select-detail', function() {
            var item_id = $(this).data('id');
            var barcode = $(this).data('barcode');
            var itemname = $(this).data('itemname');
            var suppliername = $(this).data('suppliername');
            var qty = $(this).data('qty');
            var date = $(this).data('date');
            $('#item_id').val(item_id);
            $('#barcode').text(barcode);
            $('#item_name').text(itemname);
            $('#supplier').text(suppliername);
            $('#qty').text(qty);
            $('#date').text(date);
            $('#modal-item').modal('hide');
        })
    });

    $(document).ready(function(){
    
$('#myTables').DataTable( {
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );
});

</script>