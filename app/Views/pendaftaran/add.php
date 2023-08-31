<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Tambah Data Peliharaan
<?= $this->endSection();?>

<?= $this->section('content');?>
    <?php 
        $validation = \Config\Services::validation();
    ?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="card card-primary">
                <form action="<?= base_url('pendaftaran/simpan')?>" method="post">
                <div class="card-body">
                    <a href="<?= base_url('pendaftaran') ?>" class="btn btn-secondary mb-4">
                        Kembali
                    </a>
                    <div class="form-group">
                        <label>ID Pendaftaran</label>
                        <input type="text" name="id_pendaftaran" class="form-control" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Pemilik</label>
                        <select name="pemilik" id="pemilik" class="form-control <?= $validation->hasError('pemilik') ? 'is-invalid' : ''?>">
                            <option value="" selected disabled>- Pilih -</option>
                            <?php foreach($pemilik as $item) : ?>
                            <option value="<?= $item->id_pemilik ?>" <?= set_select('pemilik', $item->id_pemilik)?>><?= $item->id_pemilik . '/' . $item->nama_lengkap ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ($validation->getError('pemilik')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('pemilik'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Nama Peliharaan</label>
                        <input type="text" name="nama_peliharaan" class="form-control <?= $validation->hasError('nama_peliharaan') ? 'is-invalid' : ''?>" placeholder="Masukan nama peliharaan" value="<?= set_value('nama_peliharaan')?>">
                        <?php if ($validation->getError('nama_peliharaan')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_peliharaan'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Tgl. Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control <?= $validation->hasError('tgl_lahir') ? 'is-invalid' : ''?>" value="<?= set_value('tgl_lahir')?>">
                        <?php if ($validation->getError('tgl_lahir')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('tgl_lahir'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?= $validation->hasError('jenis_kelamin') ? 'is-invalid' : ''?>">
                            <option value="" selected disabled>- Pilih -</option>
                            <option value="b" <?= set_select('jenis_kelamin', 'b')?>>Betina</option>
                            <option value="j" <?= set_select('jenis_kelamin', 'j')?>>Jantan</option>
                        </select>
                        <?php if ($validation->getError('jenis_kelamin')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jenis_kelamin'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Spesies</label>
                                <select name="spesies" id="spesies" class="form-control <?= $validation->hasError('spesies') ? 'is-invalid' : ''?>">
                                    <option value="" selected disabled>- Pilih -</option>
                                    <?php foreach($spesies as $item) : ?>
                                    <option value="<?= $item->deskripsi ?>" <?= set_select('spesies', $item->deskripsi)?>><?= $item->deskripsi ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($validation->getError('spesies')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('spesies'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label>Warna Rambut </label>
                                <input type="text" class="form-control <?= $validation->hasError('warna_rambut') ? 'is-invalid' : ''?>" name="warna_rambut" id="warna_rambut" value="<?= set_value('warna_rambut')?>">
                                <?php if ($validation->getError('warna_rambut')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('warna_rambut'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Ras</label>
                                <select name="ras" id="ras" class="form-control <?= $validation->hasError('ras') ? 'is-invalid' : ''?>">
                                    <option value="" selected disabled>- Pilih -</option>
                                    <?php foreach($ras as $item) : ?>
                                    <option value="<?= $item->deskripsi ?>" <?= set_select('ras', $item->deskripsi)?>><?= $item->deskripsi ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($validation->getError('ras')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('ras'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label>Postur Tubuh</label>
                                <input type="text" class="form-control <?= $validation->hasError('postur_tubuh') ? 'is-invalid' : ''?>" name="postur_tubuh" id="postur_tubuh" value="<?= set_value('postur_tubuh')?>">
                                <?php if ($validation->getError('postur_tubuh')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('postur_tubuh'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            
                        </div>
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

<?= $this->section('script');?>
<script>
    $(document).ready(function() {
        $("#table").DataTable();
    });
</script>
<?= $this->endSection();?>