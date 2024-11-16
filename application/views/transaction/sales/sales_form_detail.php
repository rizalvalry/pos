<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sales</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Transaction</a></li>
                    <li class="breadcrumb-item active">Sales</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<?php
// var_dump($sale);
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" style="height: 300px; width:100%;">
                        <table>
                           
                        <input type="hidden" id="sale_id" name="sale_id" value="<?= $sale['sale_id'] ?>" class="form-control">
                                    
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="date">Date</label>
                                </td>
                                <td style="width:30%;">
                                    <div class="form-group">
                                        <input type="text" id="date" name="date" value="<?= date('Y-m-d') ?>" readonly class="form-control">
                                    </div>
                                </td>
                            <!-- </tr>
                            <tr> -->
                                <td style="vertical-align: top; width:5%;"></td>
                                <td style="vertical-align: top; width:20%;">
                                    <label for="user">Kasir</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="user" name="user" value="<?= $this->fungsi->user_login()->name ?>" readonly class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="user">Customer</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select name="customer" id="customer_id" class="form-control" disabled>
                                            <!-- <option value="" selected>Please Selected</option> -->
                                            <?php foreach ($customer as $c) { 
                                                if($sale['customer_id']==$c->customer_id){?>
                                                <option value="<?= $c->customer_id; ?>" selected><?= $c->name; ?></option>
                                            <?php }
                                        else{?>
                                        <option value="<?= $c->customer_id; ?>"><?= $c->name; ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </td>
                            <!-- </tr>
                            <tr> -->
                            <td style="vertical-align: top; width:5%;"></td>
                                
                                <td style="vertical-align: top;">
                                    <label for="user">No PO</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="no_po" id="no_po" value="<?=$sale['no_po'];?>" readonly class="form-control" required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="user">No Kendaraan</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="no_kendaraan" id="no_kendaraan" value="<?=$sale['no_kendaraan'];?>" readonly class="form-control">
                                    </div>
                                </td>
                            <!-- </tr> -->
                            <td style="vertical-align: top; width:5%;"></td>
                                
                                <td style="vertical-align: top;">
                                    <label for="user">No PR</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="no_pr" id="no_pr" value="<?=$sale['no_pr'];?>"  class="form-control" readonly required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="user">Delivery Order</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="do_no" id="do_no" value="<?=$sale['delivery_no'];?>" readonly class="form-control">
                                    </div>
                                </td>
                            <!-- </tr> -->
                            <td style="vertical-align: top; width:5%;"></td>
                                
                                <td style="vertical-align: top;">
                                    <label for="user">No Invoice</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="invoice_no" id="invoice_no" value="<?=$sale['invoice_no'];?>" readonly class="form-control" required>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Barcode</th>
                                        <th>Product Item</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th width="10%">Discount Item</th>
                                        <th width="15%">Total</th>
                                        <th width="15%">ACTION</th>
                                    </tr>
                                </thead>

                                <tbody id="cart_table_del">
                                    <?php
                                    $no =1;
                                        foreach ($delivery as $c){?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $c->barcode; ?></td>
                                            <td><?= $c->item_name; ?></td>
                                            <td><?= indo_currency($c->cart_price); ?></td>
                                            <td><?= $c->qty; ?></td>
                                            <td><?php if ($c->discount_item != 0) {
                                                    $uang = indo_currency($c->discount_item);
                                                } else {
                                                    $uang = $c->discount_item;
                                                } ?>
                                                <?= $uang; ?>
                                            </td>
                                            <td id="total_del"><?= indo_currency($c->total); ?></td>
                                            <td class="text-center" width="160px">
                                                <form action="<?= site_url('delivery_order/delivery_delete') ?>" method="POST" class="d-inline">
                                                    <input type="hidden" name="id" value="<?= $c->id; ?>">
                                                    <input type="hidden" name="sale_id" value="<?= $c->sale_id; ?>">
                                                    <button class="btn btn-danger btn-xs tombol-hapus" type="submit">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                        </tr>

                                                <?php }
                
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align:top;width:0%;">
                                    <label for="sub_total">Sub Total</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="sub_total" value="<?= $sale['total_price'];?>" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;">
                                    <label for="discount">Discount</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="discount" value="<?= $sale['discount'];?>" readonly class="form-control">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align:top;">
                                    <label for="pph21">Tax (11%)</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <?php
                                        if($sale['sts_tax']=='1'){?>
                                         <input type="checkbox" name="sts_tax" id="stsTax" value="1" checked disabled/> Y
                                        <?php
                                        }
                                        else{?>
                                            <input type="checkbox" name="sts_tax" id="stsTax" value="0"/> N
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="grand_tax" id="grand_tax" value="<?= $sale['grand_tax'];?>" readonly class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align:top;">
                                    <label for="grand_total">Grand Total</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="grand_total" id="grand_total" value="<?= $sale['final_price'];?>" readonly class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
           
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align:top;">
                                    <label for="note">Note</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <textarea id="note" rows="3" class="form-control"><?= $sale['note'];?></textarea>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div>
                   <?php
                   if($count == 0){?>
                   <a href="<?= site_url('delivery_order/delete_header/' . $sale['sale_id']); ?>" title="Delete" class="btn btn-flat btn-lg btn-danger"><i class="fas fa-trash"></i> Delete</a>
                    <?php
                   }
                    ?>
                    <a href="<?= site_url('delivery_order'); ?>" title="Back" class="btn btn-flat btn-lg btn-danger"><i class="fas fa-undo"></i> Back</a>
                    <a href="<?= site_url('sales/cetak/' . $sale['sale_id']); ?>" target="_blank" title="Print Delivery Order" class="btn btn-flat btn-lg btn-success"><i class="fas fa-shipping-fast"></i> Delivery Order</a>
                    <a href="<?= site_url('sales/invoice/' . $sale['sale_id']); ?>" target="_blank" title="Print Invoice Order" class="btn btn-flat btn-lg btn-success"><i class="fas fa-file-invoice-dollar"></i> Invoice</a>
                                

                </div>
            </div>
            
        </div>
    </div>
</section>


