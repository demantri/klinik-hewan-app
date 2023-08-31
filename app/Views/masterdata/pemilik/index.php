<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Pemilik
<?= $this->endSection();?>

<?= $this->section('content');?>

<?php 
    $validation = \Config\Services::validation();
?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-sm-8">
        <div class="card card-primary">
            <div class="card-body">
                <table class="table table-bordered" id="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">#</th>
                            <th class="text-center">ID Pemilik</th>
                            <th class="text-center">Nama Pemilik</th>
                            <th class="text-center">No Telfon</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($pemilik as $item) : ?>
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-light btn-edit mr-2" 
                                    data-toggle="modal" 
                                    data-target="#edit"
                                    data-id_pemilik="<?= $item->id_pemilik?>"
                                    data-nama_lengkap="<?= $item->nama_lengkap?>"
                                    data-no_telp="<?= $item->no_telp?>"
                                    data-alamat="<?= $item->alamat?>"
                                    ><i class="fa-solid fa-pencil"></i></button>

                                    <a href="<?= base_url('masterdata/pemilik/hapus/' . $item->id_pemilik)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-outline-danger"
                                    ><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                            <td><?= $no++ ?></td>
                            <td><?= $item->id_pemilik ?></td>
                            <td><?= $item->nama_lengkap ?></td>
                            <td><?= $item->no_telp ?></td>
                            <td><?= $item->alamat ?></td>
                            <td><?= $item->created_at?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card card-primary">
            <form action="<?= base_url('masterdata/pemilik/simpan')?>" method="post">
                <div class="card-header">
                    <h4>Form Tambah</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>ID Pemilik</label>
                        <input type="text" name="id_pemilik" class="form-control" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Pemilik</label>
                        <input type="text" name="nama" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : ''?>" placeholder="Masukan Nama Pemilik" value="<?= set_value('nama') ?>">
                        <?php if ($validation->getError('nama')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>No Telfon</label>
                        <input type="text" name="no_telp" class="form-control telp <?= $validation->hasError('no_telp') ? 'is-invalid' : ''?>" placeholder="Masukan No Telfon" value="<?= set_value('no_telp') ?>">
                        <?php if ($validation->getError('no_telp')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_telp'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="alamat" cols="10" rows="5" class="form-control <?= $validation->hasError('alamat') ? 'is-invalid' : ''?>" placeholder="Masukan Alamat" value="<?= set_value('alamat') ?>"></textarea>
                        <?php if ($validation->getError('alamat')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection();?>

<?= $this->section('modal');?>
    <?= $this->include('masterdata/pemilik/edit');?>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>

    $(document).on("click", ".btn-edit", function() {
        let id_pemilik = $(this).data("id_pemilik");
        let nama_lengkap = $(this).data("nama_lengkap");
        let no_telp = $(this).data("no_telp");
        let alamat = $(this).data("alamat");

        $("#id_pemilik_edit").val(id_pemilik);
        $("#nama_edit").val(nama_lengkap);
        $("#no_telp_edit").val(no_telp);
        $("#alamat_edit").val(alamat);
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