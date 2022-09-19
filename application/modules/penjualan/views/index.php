<!-- Modal tambah-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('penjualan/aksi_tambah_penjualan') ?>" class="needs-validation">

          <div class="form-group row">
            <label for="nama_barang" class="col-sm-2 col-form-label">Jenis Barang</label>
            <div class="col-sm-10">
              <select name="id_barang" id="id_barang" class="form-control">
                <option value="#" class="form-control">Pilih</option>
                <?php foreach ($data_barang as $data) { ?>
                  <option value="<?= $data['id_barang'] ?>" class="form-control"><?= $data['nama_barang'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="jml_terjual" class="col-sm-2 col-form-label">Jumlah Terjual</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="jml_terjual" name="jml_terjual" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="tgl_transaksi" class="col-sm-2 col-form-label">Tanggal Transaksi</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
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
foreach ($data_penjualan as $data) { ?>
  <div class="modal fade" id="editModal<?= $data['id_penjualan'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Penjualan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?= base_url('penjualan/aksi_update_penjualan') ?>" class="needs-validation">

          <input type="hidden" class="form-control" id="id_penjualan" name="id_penjualan" value="<?= $data['id_penjualan'] ?>" required>

            <div class="form-group row">
              <label for="nama_barang" class="col-sm-2 col-form-label">Jenis Barang</label>
              <div class="col-sm-10">
                <select name="id_barang" id="id_barang" class="form-control">
                  <option value="<?= $data['id_barang'] ?>" class="form-control"><?= $data['nama_barang'] ?></option>
                  <?php foreach ($data_barang as $data2) { ?>
                    <option value="<?= $data2['id_barang'] ?>" class="form-control"><?= $data2['nama_barang'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="jml_terjual" class="col-sm-2 col-form-label">Jumlah Terjual</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="jml_terjual" name="jml_terjual" value="<?= $data['jml_terjual'] ?>" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="tgl_transaksi" class="col-sm-2 col-form-label">Tanggal Transaksi</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" value="<?= $data['tgl_transaksi'] ?>" required>
              </div>
            </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

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

                    <!-- //filter -->
                    <form action="<?= base_url('penjualan/filter') ?>" method="POST">
                      <div class="form-row align-items-center mb-3">
                        <div class="col-auto my-1">
                          <div class="custom-control mr-sm-2">
                            <label class="  control-label"></label>
                          </div>
                        </div>

                        <div class="col-auto my-1">
                          <label class="mr-sm-2 " for="inlineFormCustomSelect">Jenis Barang</label>
                          <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="id_jenis">
                            <option selected>Pilih...</option>
                            <?php foreach ($data_jenis as $data) { ?>
                              <option value="<?= $data['id_jenis'] ?>"><?= $data['nama_jenis_barang'] ?></option>
                            <?php } ?>
                          </select>
                        </div>

                        <div class="col-auto my-1">
                          <label class="mr-sm-2 " for="inlineFormCustomSelect">Filter Jumlah Terjual</label>
                          <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="filter_jml_terjual">
                            <option selected>Pilih...</option>
                              <option value="desc">Terbanyak</option>
                              <option value="asc">Terendah</option>
                          </select>
                        </div>

                        <div class="col-auto my-1">
                          <label class="mr-sm-2 " for="inlineFormCustomSelect">Tanggal awal</label>
                          <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" required>
                        </div>

                        <div class="col-auto my-1">
                          <label class="mr-sm-2 " for="inlineFormCustomSelect">Tanggal akhir</label>
                          <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" required>
                        </div>

                        <div class="col-auto mt-4">
                          <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                      </div>
                    </form>

                    
                    <!-- end  -->
             
                    <table class="table table-striped table-bordered display nowrap" id="test">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Barang</th>
                          <th>Stok</th>
                          <th>Jumlah Terjual</th>
                          <th>Tanggal Transaksi</th>
                          <th>Jenis Barang</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_penjualan as $data) : ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama_barang'] ?></td>
                            <td><?= $data['stok'] ?></td>
                            <td><?= $data['jml_terjual'] ?></td>
                            <td><?= date("d-m-Y", strtotime($data['tgl_transaksi'])) ?>
                            </td>
                            <td><?= $data['nama_jenis_barang'] ?></td>
                            <td>
                              <div class="">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $data['id_penjualan'] ?>">
                                  Edit</button>
                                <a href="<?php echo base_url(); ?>penjualan/aksi_delete_data/<?php echo $data['id_penjualan']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
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