<!-- Modal -->
<?php 
    $validation = \Config\Services::validation();
?>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('masterdata/user/update')?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id_edit" name="id">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" id="username_edit" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : ''?>" placeholder="Masukan username" value="<?= set_value('username') ?>">
                        <?php if ($validation->getError('username')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password_edit" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : ''?>" placeholder="Masukan password" value="<?= set_value('password') ?>">
                        <?php if ($validation->getError('password')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" name="role" id="role_edit" class="form-control <?= $validation->hasError('role') ? 'is-invalid' : ''?>" placeholder="Masukan role" value="<?= set_value('role') ?>">
                        <?php if ($validation->getError('role')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('role'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>