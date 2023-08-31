<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Dokter
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
                            <th class="text-center">ID Dokter</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($dokter as $item) : ?>
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-light btn-edit mr-2" 
                                    data-toggle="modal" 
                                    data-target="#edit"
                                    data-id_dokter="<?= $item->id_dokter ?>"
                                    data-nama_lengkap="<?= $item->nama_lengkap ?>"
                                    data-jenis_kelamin="<?= $item->jenis_kelamin ?>"
                                    data-alamat="<?= $item->alamat ?>"
                                    ><i class="fa-solid fa-pencil"></i></button>

                                    <a href="<?= base_url('masterdata/dokter/hapus/' . $item->id)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-outline-danger"
                                    ><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                            <td><?= $no++ ?></td>
                            <td><?= $item->id_dokter ?></td>
                            <td><?= $item->nama_lengkap ?></td>
                            <td><?= $item->jenis_kelamin ?></td>
                            <td><?= $item->alamat ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card card-primary">
            <form action="<?= base_url('masterdata/dokter/simpan')?>" method="post">
                <div class="card-header">
                    <h4>Form Tambah</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>ID Dokter</label>
                        <input type="text" class="form-control" name="id_dokter" id="id_dokter" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input name="nama_lengkap" id="nama_lengkap" class="form-control <?= $validation->hasError('nama_lengkap') ? 'is-invalid' : ''?>" placeholder="Masukan nama_lengkap" value="<?= set_value('nama_lengkap') ?>">
                        <?php if ($validation->getError('nama_lengkap')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_lengkap'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?= $validation->hasError('jenis_kelamin') ? 'is-invalid' : ''?>">
                            <option value="" disabled selected>- Pilih -</option>
                            <option value="L" <?= set_select('jenis_kelamin', 'L')?>>Laki laki</option>
                            <option value="P" <?= set_select('jenis_kelamin', 'P')?>>Perempuan</option>
                        </select>
                        <?php if ($validation->getError('jenis_kelamin')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jenis_kelamin'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input name="alamat" id="alamat" class="form-control <?= $validation->hasError('alamat') ? 'is-invalid' : ''?>" placeholder="Masukan alamat" value="<?= set_value('alamat') ?>">
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
    <?= $this->include('masterdata/dokter/edit');?>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>

    $(document).on("click", ".btn-edit", function() {
        let id_dokter = $(this).data("id_dokter");
        let nama_lengkap = $(this).data("nama_lengkap");
        let jenis_kelamin = $(this).data("jenis_kelamin");
        let alamat = $(this).data("alamat");

        $("#id_dokter_edit").val(id_dokter);
        $("#nama_lengkap_edit").val(nama_lengkap);
        $("#jenis_kelamin_edit").val(jenis_kelamin);
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