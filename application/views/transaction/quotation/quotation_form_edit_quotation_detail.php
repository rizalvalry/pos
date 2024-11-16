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
                    Edit Quotation Invoice
                </h3>
                <div class="float-sm-right">
                    <a href="<?= site_url('quotation') ?>" class="btn btn-info btn-sm"><i class="fa fa-undo"> Back</i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form id="formD" name="formD" action="<?= site_url('quotation/save_update_detail'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id"  value="<?= $quotation_m[0]->id ?>" readonly class="form-control" aria-describedby="basic" autofocus>
                        <input type="hidden" name="id_quotation" id="id_quotation"  value="<?= $quotation_m[0]->id_quotation ?>" readonly class="form-control" aria-describedby="basic" autofocus>
                                    
                        <div class="form-group">
                                <label for="item" class="col-form-label">Item <font color="#f00">*</font></label>
                                <input type="text" name="item" id="item" class="form-control" value="<?= $quotation_m[0]->item ?>" autofocus>
                            </div>
                        <div class="form-group">
                                <label for="price" class="col-form-label">Price <font color="#f00">*</font></label>
                                <input type="text" name="price" id="price" value="<?= $quotation_m[0]->price ?>" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)" class="form-control" autofocus>
                            </div>   
                        <div class="form-group">
                                <label for="qty" class="col-form-label">Qty <font color="#f00">*</font></label>
                                <input type="text" name="qty" id="qty" value="<?= $quotation_m[0]->qty ?>" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)" class="form-control" autofocus>
                            </div>    
                        <div class="form-group">
                                <label for="ukuran" class="col-form-label">Ukuran </span></label>
                                <select name="ukuran" id="ukuran" class="form-control" autofocus>
                                    <?php foreach ($unit as $s) { 
                                         if($quotation_m[0]->ukuran == $s->name){?>                                    
                                            <option value="<?= $s->name; ?>" selected><?= $s->name; ?></option>
                                    <?php 
                                         }
                                         else{?>                                    
                                            <option value="<?= $s->name; ?>"><?= $s->name; ?></option>
                                    <?php 
                                         }
                                } ?>
                                </select>
                            </div>
                        <div class="form-group">
                                <label for="amount" class="col-form-label">Amount <font color="#f00">*</font></label>
                                <input type="text" name="amount" id="amount" value="<?= $quotation_m[0]->amount ?>" readonly="readonly" class="form-control" autofocus>
                            </div>   
                        <div class="form-group">
                                <label for="note" class="col-form-label">Note/ Deskripsi <font color="#f00">*</font></label>
                                <textarea name="note" id="note" rows="4" class="form-control" autofocus><?= $quotation_m[0]->note ?></textarea>
                            </div> 

                        <div class="form-group">
                            <div class="col-sm-3">
                                <label for="gambar">Gambar</label>
                            </div>
                            <div class="col-sm-8">
                                <br>
                                <img src="<?= base_url()."/uploads/quotation/".$quotation_m[0]->gambar;?>" style="width:200px;height:100px">
                                <input type="file" name="gambar" id="gambar" class="form-control">
                            </div>
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
<script type="text/javascript" language="Javascript">
     hargasatuan = document.formD.price.value;
        document.formD.amount.value = hargasatuan;

        jumlah = document.formD.qty.value;        
        document.formD.amount.value = jumlah;

        function OnChange(value){
            hargasatuan = document.formD.price.value;
            jumlah = document.formD.qty.value;
            total = hargasatuan * jumlah;
            document.formD.amount.value = total;
        }

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