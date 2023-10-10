<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
List Booking
<?= $this->endSection();?>

<?= $this->section('content');?>

<?php 
    $validation = \Config\Services::validation();
?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-sm-12">
        <div class="card card-primary">
            <div class="card-body">
                <table class="table table-bordered" id="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Kode Booking</th>
                            <th class="text-center">Tgl Booking</th>
                            <th class="text-center">ID Pemilik</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($booking as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item->kode_booking ?></td>
                            <td><?= $item->tgl_booking ?></td>
                            <td><?= $item->id_pemilik ?></td>
                            <td><?= $item->nama_lengkap ?></td>
                            <td class="text-center">
                                <?php if ($item->status == 0) { ?>
                                    <a href="<?= base_url('rekam-medis/input/' . $item->kode_booking)?>" class="btn btn-sm btn-outline-info">Proses</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>

    $(document).on("click", ".btn-edit", function() {
        let id_obat = $(this).data("id_obat");
        let nama_obat = $(this).data("nama_obat");
        let harga = $(this).data("harga");
        let stok = $(this).data("stok");
        let tgl_expired = $(this).data("tgl_expired");

        $("#id_obat_edit").val(id_obat);
        $("#nama_obat_edit").val(nama_obat);
        $("#harga_edit").val(numerFormat(harga));
        $("#stok_edit").val(stok);
        $("#tgl_expired_edit").val(tgl_expired);
    });
    
    $(document).ready(function() {
        $("#table").DataTable({
            destroy: true,
            scrollX: true,
            columnDefs: [{
                orderable: false,
                // className: 'select-checkbox',
                targets:   0
            }],
            order: [[ 1, "asc" ]],
        });
    });
</script>
<?= $this->endSection();?>