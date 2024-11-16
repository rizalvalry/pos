<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Received</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Received Form</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
   
                
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    Add Received Invoice
                </h3>
                <div class="float-sm-right">
                    <a href="<?= site_url('received') ?>" class="btn btn-info btn-sm"><i class="fa fa-undo"> Back</i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form action="<?= site_url('received/save_add_detail'); ?>" method="post">
                        <input type="hidden" name="id" id="id"  value="<?= $received_m[0]->id ?>" readonly class="form-control" aria-describedby="basic" autofocus>
                                    
                           
                            <div class="form-group">
                                <label for="invoice" class="col-form-label">Invoice No <span>(Optional)</span></label>
                                <select name="sale_id" id="sale_id" class="form-control" autofocus>
                                <option value="" selected>SIlahkan Pilih No Invoice</option>
                                    <?php foreach ($sale as $s) { 
                                       ?>                                    
                                            <option value="<?= $s->sale_id; ?>"><?= $s->invoice_no; ?></option>
                                    <?php 
                                } ?>
                                </select>
                            </div>
                     
        
                    <div class="form-group">
                                <button class="btn btn-success btn-flat" type="submit"><i class="fa fa-paper-plane"></i> Save</button>
                                <button type="reset" class="btn btn-default btn-flat">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modal-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select Invoice</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Invoice No</th>
                                <th>Delivery No</th>
                                <th>Po No</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tblItem">
                            <!-- <?php foreach ($item as $i) { ?>
                                <tr>
                                    <td><?= $i->barcode; ?></td>
                                    <td><?= $i->name; ?></td>
                                    <td style="text-align: center;"><?= $i->name_unit; ?></td>
                                    <td style="text-align: center;"><?= indo_currency($i->price); ?></td>
                                    <td><?= $i->stock; ?></td>
                                    <td align="center">
                                        <button class="btn btn-xs btn-info" id="select" data-id="<?= $i->item_id; ?>" data-barcode="<?= $i->barcode; ?>" data-name="<?= $i->name; ?>" data-unit="<?= $i->name_unit; ?>" data-stock="<?= $i->stock; ?>">
                                            <i class="fa fa-check"></i> Select
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?> -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    
    $(document).ready(function() {
        loadItem()
    });

    $(document).on('click', '#select', function() {
        $('#sale_id').val($(this).data('id'))
        $('#invoice_no').val($(this).data('invoice_no'))
        $('#delivery_no').val($(this).data('delivery_no'))
        $('#no_po').val($(this).data('no_po'))
        $('#modal-item').modal('hide')
    });

    function loadItem()
    {
         $.ajax({
            url: "<?= site_url('sales/get_data')?>",
            type: "GET",
            dataType: "json",
            success: function(result) {
                console.log(result)
                // var final = JSON.parse(result);
                $("#tblItem").html(result)
            }
        })
    }
    $(document).on('click', '#add_cart', function() {
        var sale_id = $('#sale_id').val();
        var invoice_no = $('#invoice_no').val();
        var delivery_no = $('#delivery_no').val();
        var no_po = $('#no_po').val();
       
            $.ajax({
                type: "POST",
                url: "<?= site_url('sales/process') ?>",
                data: {
                    'add_cart': true,
                    'sale_id': sale_id,
                    'invoice_no': invoice_no,
                    'delivery_no': delivery_no,
                    'no_po': no_po
                },
                dataType: "json",
                success: function(result) {
                    if (result.success == true) {
                        
                        $('#sale_id').val('');
                        $('#invoice_no').val('');
                        $('#delivery_no').val(1);
                        $('#no_po').focus();
                        loadItem()
                    } else {
                        alert('Gagal tambah item cart');
                    }
                }
            });
        
    })
</script>