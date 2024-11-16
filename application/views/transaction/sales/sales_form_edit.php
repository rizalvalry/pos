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
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body" style="height: 300px; width:100%;">
                    <form method="post" action="<?= base_url('delivery_order/update_header')?>">
                        <table>
                        <input type="hidden" id="sale_id" name="sale_id" value="<?= $sale['sale_id'] ?>" class="form-control">
                                    
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="date">Date</label>
                                </td>
                                <td style="width:30%;">
                                    <div class="form-group">
                                        <input type="date" id="date" name="date" value="<?= date('Y-m-d') ?>" class="form-control">
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
                                        <input type="text" id="user" name="user" value="<?= $this->fungsi->user_login()->name ?>" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="user">Customer</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select name="customer" id="customer_id" class="form-control">
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
                                        <input type="text" name="no_po" id="no_po" value="<?=$sale['no_po'];?>" class="form-control" required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="user">No Kendaraan</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="no_kendaraan" id="no_kendaraan" value="<?=$sale['no_kendaraan'];?>" class="form-control">
                                    </div>
                                </td>
                            <!-- </tr> -->
                            <td style="vertical-align: top; width:5%;"></td>
                                
                                <td style="vertical-align: top;">
                                    <label for="user">No PR</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="no_pr" id="no_pr" value="<?=$sale['no_pr'];?>"  class="form-control" required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="user">Delivery Order</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="do_no" id="do_no" value="<?=$sale['delivery_no'];?>" class="form-control">
                                    </div>
                                </td>
                            <!-- </tr> -->
                            <td style="vertical-align: top; width:5%;"></td>
                                
                                <td style="vertical-align: top;">
                                    <label for="user">No Invoice</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="invoice_no" id="invoice_no" value="<?=$sale['invoice_no'];?>" class="form-control" required>
                                    </div>
                                </td>
                            </tr>

                        </table><input type="submit" class="btn btn-primary" value="save">
                    </div>
                </div>
            </div>    </form>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body" style="height: 300px;">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align: top; width:30%;">
                                    <label for="barcode">Barcode</label>
                                </td>
                                <td>
                                    <div class="form-group input-group">
                                        <input type="hidden" id="item_id">
                                        <input type="hidden" id="price">
                                        <input type="hidden" id="stock">
                                        <input type="text" name="barcode" id="barcode" class="form-control" aria-describedby="basic">
                                        <div class="input-group-append">
                                            <span>
                                                <button type="button" class="input-group-text btn btn-info btn-flat form-control" data-toggle="modal" data-target="#modal-item"><i class="fa fa-search" id="basic"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; width:30%;">
                                    <label for="qty">Qty</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="qty" value="1" min="1" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div>
                                        <button type="button" id="add_cart" class="btn btn-primary">
                                            <i class="fa fa-cart-plus"> Add</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body" style="height: 300px;">
                        <div align="right">
                            <h1><b><span id="grand_total2" style="font-size:50pt;">0</span></b></h1>
                        </div>
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
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody id="cart_tabel">
                                    <?php $this->view('transaction/sales/cart_data_del') ?>

                                </tbody>
                            </table>
                        </div>
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
                                        <th>Actions</th>
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
                                            <td id="total_del"><?= $c->total; ?></td>
                                            <td class="text-center" width="160px">
                                                <!-- <a onclick="editDataDel(<?= $c->id; ?>)" class="btn btn-xs btn-primary" style="color: white;">
                                                    <i class="fa fa-edit"></i> Update
                                                </a> -->
                                                <form action="<?= site_url('delivery_order/cart_del') ?>" method="POST" class="d-inline">
                                                    <input type="hidden" name="id" value="<?= $c->id; ?>">
                                                    <input type="hidden" name="sale_id" value="<?= $c->sale_id; ?>">
                                                    <button class="btn btn-danger btn-xs tombol-hapus" type="submit">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
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
                                <td style="vertical-align:top;width:30%;">
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
                                        <input type="number" id="discount" value="0" class="form-control">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align:top;">
                                    <label for="pph21">Tax (11%)</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="checkbox" name="sts_tax" id="stsTax" onchange="calculate();"  value="1"/> Y
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="grand_tax" id="grand_tax" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align:top;">
                                    <label for="grand_total">Grand Total</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="grand_total" id="grand_total" class="form-control" readonly>
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
                                        <textarea id="note" rows="3" class="form-control"></textarea>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div>
                    <button id="cancel_payment" class="btn btn-flat btn-lg btn-danger" style="color: white;">
                        <i class="fa fa-recycle"></i> Cancel
                    </button>
                    <button id="process_payment" name="process_payment" class="btn btn-flat btn-lg btn-success">
                        <i class="fa fa-paper-plane"></i> Process Payment
                    </button>
                </div>
            </div>
            
        </div>
    </div>
</section>
<div class="modal fade" id="itemEditDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" target="_self" name="formku" id="formku" class="eventInsForm">
                    <div class="form-row">
                        <label for="barcode_name" class="col-form-label">Product Item</label>
                        <input type="text" id="barcode_name" name="barcode_name" class="form-control" readonly>
                        <br><br>
                        <input type="text" id="product_name" class="form-control" readonly>
                        <input type="text" name="id" id="id">
                        <input type="text" name="item_id" id="item_id">
                        <input type="text" name="old_qty" id="old_qty">
                    </div>
                    <div class="form-row">
                        <label for="item_price">Price</label>
                        <input type="text" id="price" name="price" class="form-control">
                        <div class="invalid-feedback inv-price">
                            &nbsp;
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="item_qty">Qty</label>
                        <input type="text" id="item_qty" name="item_qty" class="form-control">
                    </div>

                    <div class="form-row">
                        <label for="item_discount">Discount Item</label>
                        <input type="text" id="discount" name="discount" class="form-control">
                        <div class="invalid-feedback inv-discount">
                            &nbsp;
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="item_total">Total</label>
                        <input type="text" id="item_total" name="item_total" class="form-control" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button type="button" class="btn btn-success" onclick="simpandata()"><i class="fa fa-paper-plane"></i> Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Product Item</h4>
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
                        <tbody id="tblItem">
                           <!--  <?php foreach ($item as $i) { ?>
                                <tr>
                                    <td><?= $i->barcode; ?></td>
                                    <td><?= $i->name; ?></td>
                                    <td style="text-align: center;"><?= $i->name_unit; ?></td>
                                    <td style="text-align: center;"><?= indo_currency($i->price); ?></td>
                                    <td><?= $i->stock; ?></td>
                                    <td align="center">
                                        <button class="btn btn-xs btn-info" id="select" data-id="<?= $i->item_id; ?>" data-barcode="<?= $i->barcode; ?>" data-price="<?= $i->price; ?>" data-stock="<?= $i->stock; ?>">
                                            <i class="fa fa-check"></i> Select
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
    $(document).ready(function() {
        
        calculate()
        loadItem()
    });

    $(document).on('click', '#select', function() {
        $('#item_id').val($(this).data('id'))
        $('#barcode').val($(this).data('barcode'))
        $('#price').val($(this).data('price'))
        $('#stock').val($(this).data('stock'))
        $('#modal-item').modal('hide')
    });

    function cek_qty(val)
    {
        if(val > $('#stock').val()){
            alert('Stock tidak mencukupi');
            $('#item_id').val('');
            $('#barcode').val('');
            $('#barcode').focus();
            $('#qty').val(1);
        }
    }

    $(document).on('click', '#add_cart', function() {
        var item_id = $('#item_id').val();
        var price = $('#price').val();
        var stock = $('#stock').val();
        var qty = $('#qty').val();
        if (item_id == '') {
            alert('Product belum dipilih');
            $('#barcode').focus();
        } else if (parseInt(qty) > parseInt(stock)) {
            alert('Stock tidak mencukupi');
            $('#item_id').val('');
            $('#barcode').val('');
            $('#barcode').focus();
        } else {
            $.ajax({
                type: "POST",
                url: "<?= site_url('delivery_order/process') ?>",
                data: {
                    'add_cart': true,
                    'item_id': item_id,
                    'price': price,
                    'qty': qty
                },
                dataType: "json",
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_tabel').load('<?= site_url('sales/cart_data'); ?>', function() {
                            calculate()
                        });
                        $('#item_id').val('');
                        $('#barcode').val('');
                        $('#qty').val(1);
                        $('#barcode').focus();
                        loadItem()
                    } else {
                        alert('Gagal tambah item cart');
                    }
                }
            });
        }
    })

    $(document).on('click', '#del_cart', function() {
        if (confirm('apakah anda yakin?')) {
            var cart_id = $(this).data('cartid');
            $.ajax({
                type: "POST",
                url: "<?= site_url('sales/cart_del') ?>",
                data: {
                    'cart_id': cart_id
                },
                dataType: "json",
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_tabel').load('<?= site_url('sales/cart_data'); ?>', function() {

                        });
                    } else {
                        alert('Gagal hapus item cart');
                    }
                }
            });

        }
    });

    $(document).on('click', '#process_payment', function() {
        // alert("test");
        var sale_id = $('#sale_id').val();
        var subtotal = $('#sub_total').val();
        var customer = $('#customer_id').val();
        var nopo = $('#no_po').val();
        var nokendaraan = $('#no_kendaraan').val();
        var invoiceno = $('#invoice_no').val();
        var nopr = $('#no_pr').val();
        var discount = $('#discount').val();
        var grandtotal = $('#grand_total').val();
        var ststax = $('#stsTax').val();
        var grandtax = $('#grand_tax').val();
        var note = $('#note').val();
        var date = $('#date').val();

        if (nopo == "") {
            alert('No Po masih kosong');
            $('#nopo').focus();
        }
        else if (nokendaraan < 1) {
            alert('No Kendaraan masih kosong');
            $('#nokendaraan').focus();
        }
        else if (subtotal < 1) {
            alert('Product belum dipilih');
            $('#barcode').focus();
        } else {
            if (confirm('Ingin memproses transaksi ini?')) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('delivery_order/process') ?>",
                    data: {
                        'process_payment': true,
                        'sale_id': sale_id,
                        'customer_id': customer,
                        'no_po': nopo,
                        'no_kendaraan': nokendaraan,
                        'invoice_no': invoiceno,
                        'no_pr': nopr,
                        'sub_total': subtotal,
                        'discount': discount,
                        'grand_total': grandtotal,
                        'sts_tax': ststax,
                        'grand_tax': grandtax,
                        'note': note,
                        'date': date
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.success == true) {
                            console.log('Print.......')

                            alert('Berhasil melakukan transaksi')
                            window.open('<?= site_url('sales/cetak/') ?>' + result.sale_id,
                                '_blank')
                            location.reload();
                        } else {
                            alert('gagal melakukan transaksi');
                        }
                    }
                });
            }
        }
    });

    $(document).on('click', '#cancel_payment', function() {
        if (confirm('Ingin membatalkan pesanan?')) {
            $.ajax({
                type: "POST",
                url: "<?= site_url('sales/reset') ?>",
                data: {
                    'cancel_payment': true
                },
                dataType: "json",
                success: function(result) {
                    if (result.success == true) {
                        console.log('terhapus')
                        $('#cart_tabel').load('<?= site_url('sales/cart_data'); ?>', function() {
                            calculate()
                        });
                    }
                }
            })
            $('#discount').val(0)
            $('#stsTax').val(0)
            $('#customer').val(0).change()
            $('#barcode').val('')
            $('#barcode').focus()

        }
    });

    function loadItem()
    {
         $.ajax({
            url: "<?= site_url('item/get_data')?>",
            type: "GET",
            dataType: "json",
            success: function(result) {
                console.log(result)
                // var final = JSON.parse(result);
                $("#tblItem").html(result)
            }
        })
    }

    function calculate() {
        var subtotal = 0;
        
        $('#cart_tabel tr').each(function() {
            var total = parseInt($(this).find('#total').text(), 10);
            // alert(total);
            if (isNaN(total)){
                $('#cart_table_del tr').each(function() {
                    subtotal += parseInt($(this).find('#total_del').text(), 10)
                })
            }
            else{
                subtotal += total
                $('#cart_table_del tr').each(function() {
                // subtotal += parseInt($(this).find('#total').text(), 10)
                subtotal += parseInt($(this).find('#total_del').text(), 10)
                // var total_del = total_del;
            })
            }
            // var total = total;
        })
        
            // $allTotal = total + total_del;
            // subtotal += allTotal;
        isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

        var discount = $('#discount').val()

        // var ststax = $("input[type='checkbox']").val();   
        var sts_tax  = document.querySelector('input[type="checkbox"]');
        sts_tax .addEventListener('change', function (e) {
            // alert(this.checked);
            if(this.checked == true){
            var tax = (subtotal - discount) * 0.11;
        }
        else {
            var tax = 0;
        }
            $('#grand_tax').val(tax)
        
        // alert(ststax);
        // var taxx = $('#grand_tax').val()
// alert(taxx);
        var grand_total = subtotal - discount + tax
        // var grand_total = grand_totalll.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        
        //console.log(subtotal);
        if (isNaN(grand_total)) {
            $('#grand_total').val(0)
            $('#grand_total2').text(0)
        } else {
            $('#grand_total').val(grand_total)
            $('#grand_total2').text(grand_total)
        }

        //hitung kembalian
        // var cash = $('#cash').val();
        // cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0);
    });
    }

    $(document).on('keyup mouseup', '#discount, #cash', function() {
        calculate()
    })

    
    function editDataDel(id) {
        $.ajax({
            type: "POST",
            url: "<?= site_url('delivery_order/edit_del'); ?>",
            data: {
                id: id
            },
            success: function(result) {
                $('#barcode_name').val(result['barcode']);
                $('#product_name').val(result['item_name']);
                $('#price').val(result['price']);
                $('#qty').val(result['qty']);
                $('#discount').val(result['discount_item']);
                $('#total').val(result['total']);
                $('#id').val(result['id']);
                $('#item_id').val(result['item_id']);
                $('#qty').val(result['qty']);
                $('#old_qty').val(result['qty']);

                $("#itemEditDel").modal('show', {
                    backdrop: 'true'
                });
            }
        })
    }

    function simpandata() {
        $('#formku').attr("action", "<?= site_url('sales/update') ?>");
        $('#formku').submit();
        calculate()
        loadItem()
    }
</script>