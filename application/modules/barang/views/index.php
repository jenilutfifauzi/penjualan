<!-- Modal tambah-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('jenis/aksi_tambah_jenis_brg') ?>" class="needs-validation">
          <div class="form-group row">
            <label for="nama_barang" class="col-sm-2 col-form-label">Barang</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="nama_barang" class="col-sm-2 col-form-label">Jenis Barang</label>
            <div class="col-sm-10">
              <select name="jenis_barang" id="jenis_barang" class="form-control">
                <option value="" class="form-control"></option>
                <?php 
                foreach ($data_jenis_barang as $data) {
                  # code...
                }
                ?>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- akhir modal -->

<!-- Modal edit-->
<?php
$no = 1;
foreach ($data_jenis_barang as $data) { ?>
  <div class="modal fade" id="editModal<?= $data['id_jenis'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Jenis Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?= base_url('jenis/aksi_update_jenis_brg') ?>" class="needs-validation">
            <div class="form-group row">
              <label for="jenis_brg" class="col-sm-2 col-form-label">Jenis Barang</label>
              <div class="col-sm-10">
                <input type="hidden" class="form-control" id="id_jenis" name="id_jenis" value="<?= $data['id_jenis'] ?>" required>

                <input type="text" class="form-control" id="jenis_brg" name="jenis_brg" value="<?= $data['nama_jenis_barang'] ?>" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<!-- akhir modal -->



<div class="main-content">
  <section class="section">
    <div class="section-header">
      <div class="col-12">
        <h1><?= $title ?></h1><br>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">&nbsp;</h2>
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Daftar <?= $title ?></h4>
                  <div class="card-header-form">

                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <?= $this->session->flashdata('message') ?>
                    <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">
                      Tambah
                    </button>
                    <table class="table table-striped table-bordered display nowrap" id="test">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Jenis Barang</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_jenis_barang as $data) : ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama_jenis_barang'] ?></td>
                            <td>
                              <div class="">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $data['id_jenis'] ?>">
                                  Edit</button>
                                  <a href="<?php echo base_url(); ?>jenis/aksi_delete_data/<?php echo $data['id_jenis']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>