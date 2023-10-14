<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Profile
<?= $this->endSection();?>

<?= $this->section('content');?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">                     
                    <img alt="image" src="<?= $profile->img == null ? base_url('assets/img/avatar/avatar-1.png') : base_url('uploads/image/' . $profile->img )?>" class="rounded-circle profile-widget-picture">
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name">
                        <?= $profile->nama_lengkap ?> 
                        <div class="text-muted d-inline font-weight-normal">
                            <div class="slash"></div> 
                            <?= '@'. $profile->username ?>
                        </div>
                    </div>
                    <?= $profile->alamat ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form method="post" class="needs-validation" novalidate="" action="<?= base_url('setting/profile/update')?>" enctype="multipart/form-data">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <input type="hidden" value="<?= $profile->id ?>" name="id">
                        <input type="hidden" value="<?= $profile->id_ref_akun ?>" name="id_pemilik">
                        <input type="hidden" value="<?= $profile->id_user?>" name="id_user">
                        <div class="row">                               
                            <div class="form-group col-md-6 col-12">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" value="<?= $profile->nama_lengkap ?>" required="" name="nama_lengkap">
                                <div class="invalid-feedback">
                                    Please fill in the first name
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Username</label>
                                <input type="text" class="form-control" value="<?= $profile->username ?>" required="" name="username" readonly>
                                <div class="invalid-feedback">
                                    Please fill in the last name
                                </div>
                            </div>
                        </div>
                        <div class="row">                               
                            <div class="form-group col-md-6 col-12">
                                <label>Alamat</label>
                                <input type="text" class="form-control" value="<?= $profile->alamat ?>" required="" name="alamat">
                                <div class="invalid-feedback">
                                    Please fill in the first name
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>No Telp</label>
                                <input type="text" class="form-control telp" name="no_telp" value="<?= $profile->no_telp ?>">
                                <div class="invalid-feedback">
                                    Please fill in the last name
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="foto">
                            <div class="invalid-feedback">
                                Please fill in the last name
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Update Data</button>
                        <?php if ($profile->img != null) { ?>
                            <a href="<?= base_url('setting/profile/delete-img/' . $profile->id_user)?>" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin?')">Hapus Foto</a>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>
</script>
<?= $this->endSection();?>