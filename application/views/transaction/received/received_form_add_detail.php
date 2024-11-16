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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" target="_self" name="formku" id="formku" class="eventInsForm">
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="name" class="col-form-label">Category Name <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="text" name="name" id="name" class="form-control" style="margin-bottom: 5px;" maxlength="100" autofocus>
                                            <input type="hidden" name="category_id" id="category_id">
                                            <div class="invalid-feedback nama-ada inv-nama">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                <button type="button" class="btn btn-primary" onclick="simpandata()"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <input type="date" name="date" class="form-control" value="<?= $received_m[0]->date ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="received" class="col-form-label">Received No <font color="#f00">*</font></label>
                                <div class="input-group">
                                    <input type="text" name="received_no" id="received_no"  value="<?= $received_m[0]->received_no ?>" readonly class="form-control" aria-describedby="basic" autofocus>
                                    
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label for="pengirim" class="col-form-label">Pengirim <font color="#f00">*</font></label>
                                <input type="text" name="pengirim" id="pengirim"  value="<?= $received_m[0]->pengirim ?>" readonly class="form-control" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="date" class="col-form-label">Tanggal Kirim <font color="#f00">*</font></label>
                                <input type="date" name="date" class="form-control" value="<?= $received_m[0]->date_kirim ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="customer" class="col-form-label">Customer <span>(Optional)</span></label>
                                <select name="customer_id" id="customer_id" class="form-control" disabled autofocus>
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
                        
                    </div>
                </div>
            </div>
        
            <div class="card-header">
            
                <div class="float-sm-right">
                    <a href="<?= site_url('received/add_received_detail/'.$received_m[0]->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"> Add Detail</i></a>
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
                            <th>Invoice No</th>
                            <th>Delivery No</th>
                            <th>PO No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($received_detail as $rd) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td id="received_no"><?= $rd->invoice_no; ?></td>
                                <td><?= $rd->delivery_no ?></td>
                                <td><?= $rd->no_po ?></td>
                                <td>
                                    <!-- <a class="btn btn-default btn-sm" onclick="showDetail(<?= $rd->sale_id; ?>)"><i class=" fa fa-eye"></i> -->
                                    </a>
                                    <a href="<?= site_url('received/delete_detail/' . $rd->id.'/'.$rd->id_terima.'/'.$rd->sale_id); ?>" title="Detail" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
