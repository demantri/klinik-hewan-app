<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Pembayaran
<?= $this->endSection();?>

<?= $this->section('content');?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <table class="table table-bordered" id="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">ID Rekam Medis</th>
                                <th class="text-center">ID Transaksi</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Nama Customer</th>
                                <th class="text-center">Nama Dokter</th>
                                <th class="text-center">Jasa Dokter</th>
                                <th class="text-center">Total Transaksi</th>
                                <th class="text-center">Grand Total</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($trx as $row) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row->kode_rm ?></td>
                                <td><?= $row->id_trx ?></td>
                                <td><?= date('d-m-Y', strtotime($row->tgl_trx)) ?></td>
                                <td><?= $row->nama_customer ?></td>
                                <td><?= $row->nama_dokter ?></td>
                                <td class="text-right"><?= number_format($row->jasa_dokter, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($row->total_transaksi, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($row->grand_total, 0, ',', '.') ?></td>
                                <td>
                                    <?php if ($row->status == 0) { ?>
                                        <button 
                                            class="btn-bayar btn btn-sm btn-outline-success"
                                            data-id="<?= $row->id_trx ?>"    
                                        >Bayar</button>
                                    <?php } else { ?>
                                        <button class="btn btn-success btn-sm" type="button">Terbayar</button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>
    function prosesSimpan(id_trx) {
        $.ajax({
            url: '<?= base_url('rekam-medis/pembayaran/bayar')?>',
            type: 'post',
            dataType: 'json',
            data: {
                id_trx : id_trx
            },
            success: function(response) {
                swal({
                    title: 'Berhasil!',
                    text: response.msg,
                    icon: 'success',
                }).then(function() {
                    location.reload();
                    // window.location.href = '<?= base_url('rekam-medis/view') ?>';
                })
            }  
        });
    }

    $(document).on("click", ".btn-bayar", function(e) {
        e.preventDefault();
        let id_trx = $(this).data('id');
        swal({
            text: "Apakah anda yakin?",
            icon: "info",
            buttons: {
                confirm: {
                    text: 'Bayar',
                    value: 'selesai',
                },
                // print: {
                //     text: 'Bayar & print',
                //     value: 'selesai_print',
                // }
            },
        }).then((value) => {
            if (value == 'selesai') {
                prosesSimpan(id_trx);
            } 
            // else if (value == 'selesai_print') {
            //     prosesSimpanPrint();
            // }
        });
    });

    $(document).ready(function() {
        $("#table").DataTable();
    });
</script>
<?= $this->endSection();?>