<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quotation</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Quotation Form</li>
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
                    Update Quotation
                </h3>
                <div class="float-sm-right">
                    <a href="<?= site_url('quotation') ?>" class="btn btn-info btn-sm"><i class="fa fa-undo"> Back</i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form action="<?= site_url('quotation/save_update'); ?>" method="post">
                        <input type="hidden" name="id" id="id"  value="<?= $quotation_m[0]->id ?>" readonly class="form-control" aria-describedby="basic" autofocus>
                                    
                            <div class="form-group">
                                <label for="date" class="col-form-label">Date  <font color="#f00">*</font></label>
                                <input type="date" name="date" class="form-control" value="<?= $quotation_m[0]->date ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="quotation" class="col-form-label">Quotation No <font color="#f00">*</font></label>
                                <div class="input-group">
                                    <input type="text" name="quotation_no" id="quotation_no"  value="<?= $quotation_m[0]->quotation_no ?>" readonly class="form-control" aria-describedby="basic" autofocus>
                                    
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label for="date" class="col-form-label">Expired Date <font color="#f00">*</font></label>
                                <input type="date" name="expired_date" class="form-control" value="<?= $quotation_m[0]->expired_date ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="customer" class="col-form-label">Customer <span>(Optional)</span></label>
                                <select name="customer_id" id="customer_id" class="form-control" disabled autofocus>
                                    <?php foreach ($customer as $s) { 
                                        if($quotation_m[0]->customer_id == $s->customer_id){ ?>
                                            <option value="<?= $s->customer_id; ?>" selected><?= $s->name; ?></option>
                                    <?php }
                                        else{ ?>                                    
                                            <option value="<?= $s->customer_id; ?>"><?= $s->name; ?></option>
                                    <?php }
                                } ?>
                                </select>
                            </div>
                        
                    </div>
                </div>
            </div>
        
            <div class="card-header">
            
                <div class="float-sm-right">
                    <a href="<?= site_url('quotation/add_quotation_detail/'.$quotation_m[0]->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"> Add Detail</i></a>
                    <!-- <button type="button" class="input-group-text btn btn-info btn-flat form-control" data-toggle="modal" data-target="#modal-item" id="add_cart">Add Detail</button> -->
                </div>
            </div>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan') ?>">
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th>Items</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Picture</th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($quotation_detail as $rd) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td id="quotation_no"><?= $rd->item; ?></td>
                                <td><?= $rd->price ?></td>
                                <td><?= $rd->qty." ".$rd->ukuran ?></td>
                                <td><?= $rd->amount ?></td>
                                <td><img src="<?= base_url()."/uploads/quotation/".$rd->gambar;?>" style="width:200px;height:100px"></td>
                                <td><?= $rd->note ?></td>
                                <td>
                                    <a href="<?= site_url('quotation/update_quotation_detail/' . $rd->id.'/'.$rd->id_quotation); ?>" title="Detail" class="btn btn-peimary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="<?= site_url('quotation/delete_detail/' . $rd->id.'/'.$rd->id_quotation."/".$rd->gambar); ?>" title="Detail" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
