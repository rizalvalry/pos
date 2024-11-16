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
                    Detail Received
                </h3>
                <div class="float-sm-right">
                    <?php
                    if($count == 0){?>
                    <a href="<?= site_url('received/delete_header/'.$received_m[0]->id); ?>" title="Detail" class="btn btn-danger btn-sm"><i class="fa fa-trash"> Delete</i></a>
                    <?php } ?>
                    <a href="<?= site_url('received') ?>" class="btn btn-info btn-sm"><i class="fa fa-undo"> Back</i></a>
                    <a href="<?= site_url('received/cetak/'.$received_m[0]->id) ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-print"> Cetak</i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form action="<?= site_url('received/save_update_upload'); ?>" method="post" enctype="multipart/form-data">
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

                            <div class="form-group">
                                <label for="date" class="col-form-label">Tangal Received <font color="#f00">*</font></label>
                                <input type="date" name="date_received" class="form-control" value="<?= $received_m[0]->date_received ?>">
                            </div>

                            <div class="form-group">
                                <?php 
                                
                                if($received_m[0]->file_upload){?>
                                    <br>
                                    <iframe src="<?= base_url('/uploads/files/' . $received_m[0]->file_upload) ?>" style="width: 250px; height:250px;"></iframe>
                                    <?php
                                }
                                ?>
                                <br>
                                <?=$received_m[0]->file_upload;?>
                                <br>
                                <label for="date" class="col-form-label">Upload File <font color="#f00">*</font></label>
                                <input type="file" name="file_upload" class="form-control"  size="20" />
                            </div>
                            <div class="modal-footer">
                            <button class="btn btn-success btn-flat" type="submit"><i class="fa fa-paper-plane"></i> Save</button>
                                <button type="reset" class="btn btn-default btn-flat">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="card-header">
            
                
            </div>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan') ?>">
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th>Invoice Noo</th>
                            <th>Delivery No</th>
                            <th>PO No</th>
                            <th>ACTION</th>
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
                                <td align="center"><a href="<?= site_url('received/delete_detail2/' . $rd->id.'/'.$rd->id_terima.'/'.$rd->sale_id); ?>" title="Detail" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>