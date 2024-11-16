<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Received</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Received</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="float-sm-right">
                    <a href="<?= site_url('received/add') ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"> Add Received</i></a>
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
                            <th>Received No</th>
                            <th>Tanggal Received</th>
                            <th>Pengirim</th>
                            <th>Customer</th>
                            <th>PIC</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($received as $s) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td id="received_no"><?= $s->received_no; ?></td>
                                <td><?= indo_date($s->date) ?></td>
                                <td><?= $s->pengirim ?></td>
                                <td><?= $s->customer_name ?></td>
                                <td><?= $s->customer_pic ?></td>
                                <td>
                                    <!-- <a class="btn btn-default btn-sm" onclick="showDetail(<?= $s->sale_id; ?>)"><i class=" fa fa-eye"></i> -->
                                    </a>
                                    <a href="<?= site_url('received/detail/' . $s->id); ?>" title="Detail" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
                                    <!-- <a href="javascript:;" onclick="printSale(<?= $s->id; ?>)" style="text-decoration: none;" class="btn btn-danger btn-sm"><i class="fa fa-print"></i></a> -->
                                    <a href="<?= site_url('received/edit/' . $s->id); ?>" title="Update" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="<?= site_url('received/add_detail/' . $s->id); ?>" title="Add Detail" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                    <a href="<?= site_url('received/upload_file/' . $s->id); ?>" title="Upload File" class="btn btn-default btn-sm"><i class="fa fa-upload"></i></a>
                                    <!-- <a href="<?= site_url('sales/cetak/' . $s->id); ?>" target="_blank" title="Print Delivery Order" class="btn btn-danger btn-sm"><i class="fas fa-shipping-fast"></i></a>
                                    <a href="<?= site_url('sales/invoice/' . $s->id); ?>" target="_blank" title="Print Invoice Order" class="btn btn-danger btn-sm"><i class="fas fa-file-invoice-dollar"></i></a> -->
                                </td>
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
                                <th>Item Name</th>
                                <td>:</td>
                                <td>
                                    <span id="item_name">&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>:</td>
                                <td>
                                    <span id="price">&nbsp;</span>
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
                                <th>Discount Item </th>
                                <td>:</td>
                                <td>
                                    <span id="disc">&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <th>total </th>
                                <td>:</td>
                                <td>
                                    <span id="total">&nbsp;</span>
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
    function showDetail(sale_id) {
        $.ajax({
            type: "POST",
            url: "<?= site_url('reports/detail'); ?>",
            data: {
                sale_id: sale_id
            },
            dataType: "json",
            success: function(result) {
                // console.log(result)
                $('#item_name').text(result['item_name']);
                $('#price').text(result['price']);
                $('#qty').text(result['qty']);
                $('#disc').text(result['discount_item']);
                $('#total').text(result['total']);
                $('#sale_id').val(result['sale_id']);

                $('#modal-detail').modal('show')
            }
        });
    }

    function printSale(sale_id) {

    }
</script>