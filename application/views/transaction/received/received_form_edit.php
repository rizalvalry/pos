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
                    Update Received
                </h3>
                <div class="float-sm-right">
                    <a href="<?= site_url('received') ?>" class="btn btn-info btn-sm"><i class="fa fa-undo"> Back</i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form action="<?= site_url('received/save_update'); ?>" method="post">
                        <input type="hidden" name="id" id="id"  value="<?= $received_m[0]->id ?>" readonly class="form-control" aria-describedby="basic" autofocus>
                                    
                            <div class="form-group">
                                <label for="date" class="col-form-label">Tanggal Terima <font color="#f00">*</font></label>
                                <input type="date" name="date" class="form-control" value="<?= $received_m[0]->date ?>">
                            </div>
                            <div class="form-group">
                                <label for="received" class="col-form-label">Received No <font color="#f00">*</font></label>
                                <div class="input-group">
                                    <input type="text" name="received_no" id="received_no"  value="<?= $received_m[0]->received_no ?>" readonly class="form-control" aria-describedby="basic" autofocus>
                                    
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label for="pengirim" class="col-form-label">Pengirim <font color="#f00">*</font></label>
                                <input type="text" name="pengirim" id="pengirim"  value="<?= $received_m[0]->pengirim ?>" class="form-control" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="date_kirim" class="col-form-label">Tanggal Kirim <font color="#f00">*</font></label>
                                <input type="date" name="date_kirim" class="form-control" value="<?= $received_m[0]->date_kirim ?>">
                            </div>

                            <div class="form-group">
                                <label for="customer" class="col-form-label">Customer <span>(Optional)</span></label>
                                <select name="customer_id" id="customer_id" class="form-control" autofocus>
                                    <?php foreach ($customer as $s) { 
                                        if($received_m[0]->customer_id == $s->customer_id){ ?>
                                            <option value="<?= $s->customer_id; ?>" selected><?= $s->name; ?></option>
                                    <?php }
                                        else{ ?>                                    
                                            <option value="<?= $s->customer_id; ?>"><?= $s->name; ?></option>
                                    <?php }
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
                <h4 class="modal-title">Select Product Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Name</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($item as $i) { ?>
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
                            <?php } ?>
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
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('d4392a044ecee1cce52a', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        alert(JSON.stringify(data));
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var item_id = $(this).data('id');
            var barcode = $(this).data('barcode');
            var name = $(this).data('name');
            var unit_name = $(this).data('unit');
            var stock = $(this).data('stock');
            $('#item_id').val(item_id);
            $('#barcode').val(barcode);
            $('#item_name').val(name);
            $('#unit_name').val(unit_name);
            $('#stock').val(stock);
            $('#modal-item').modal('hide');
        })
    });
</script>