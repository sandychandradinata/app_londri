<?php 
include '../layouts/header.php';
include '../layouts/navbar.php';
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Paket</h1>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container">
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Paket</h3>

              <div class="card-tools">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Data</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php 
              if(isset($_GET['info'])){
                if($_GET['info'] == "hapus"){ ?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-trash"></i> Sukses</h5>
                    Data berhasil di hapus
                  </div>
                <?php } else if($_GET['info'] == "simpan"){ ?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Sukses</h5>
                    Data berhasil di simpan
                  </div>
                <?php }else if($_GET['info'] == "update"){ ?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-edit"></i> Sukses</h5>
                    Data berhasil di update
                  </div>
                <?php } } ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Outlet</th>
                      <th>Jenis</th>
                      <th>Nama Paket</th>
                      <th>Harga</th>
                      <th style="width: 200px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    include "../koneksi.php";
                    $tb_paket    =mysqli_query($koneksi, "SELECT * FROM tb_paket");
                    while($d_tb_paket = mysqli_fetch_array($tb_paket)){
                      $tb_outlet_d    =mysqli_query($koneksi, "SELECT * FROM tb_outlet where id='$d_tb_paket[id_outlet]'");
                      while($d_tb_outlet_d = mysqli_fetch_array($tb_outlet_d)){
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?=$d_tb_outlet_d['nama']?></td>
                          <td><?=$d_tb_paket['jenis']?></td>
                          <td><?=$d_tb_paket['nama_paket']?></td>
                          <td>Rp. <?=number_format($d_tb_paket['harga'])?></td>
                          <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $d_tb_paket['id']; ?>"><i class="fas fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?php echo $d_tb_paket['id']; ?>"><i class="fas fa-trash"></i> Hapus</button>
                          </td>
                        </tr>

                        <div class="modal fade" id="modal-hapus<?php echo $d_tb_paket['id']; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Hapus Data Paket</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">                          
                                <p>Apakah anda yakin akan menghapus data <b><?php echo $d_tb_paket['nama_paket']; ?></b>...?</p>                           
                              </div>                        
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                <a href="hapus_paket.php?id=<?php echo $d_tb_paket['id']; ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="modal-edit<?php echo $d_tb_paket['id']; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Data Paket</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form method="post" action="update_paket.php">                              
                                <div class="modal-body">                          
                                  <div class="form-group">
                                    <label>Nama Outlet</label>
                                    <input type="text" name="id" value="<?php echo $d_tb_paket['id']; ?>" hidden>
                                    <select class="form-control" name="id_outlet">
                                      <option>--- Pilih Nama Outlet ---</option>
                                      <?php
                                      include "../koneksi.php";
                                      $tb_outlet    =mysqli_query($koneksi, "SELECT * FROM tb_outlet");
                                      while($d_tb_outlet = mysqli_fetch_array($tb_outlet)){
                                        ?>
                                        <option value="<?=$d_tb_outlet['id']?>" <?php if($d_tb_outlet['id'] == $d_tb_paket['id_outlet']){ echo 'selected'; } ?>><?=$d_tb_outlet['nama']?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label>Jenis</label>
                                    <select class="form-control" name="jenis">
                                      <option>--- Silahkan Pilih Jenis ---</option>
                                      <option value="kiloan" <?php if('kiloan' == $d_tb_paket['jenis']){ echo 'selected'; } ?>>Kiloan</option>
                                      <option value="selimut" <?php if('selimut' == $d_tb_paket['jenis']){ echo 'selected'; } ?>>Selimut</option>
                                      <option value="bed_cover" <?php if('bed_cover' == $d_tb_paket['jenis']){ echo 'selected'; } ?>>Bed Cover</option>
                                      <option value="kaos" <?php if('kaos' == $d_tb_paket['jenis']){ echo 'selected'; } ?>>Kaos</option>
                                      <option value="lain" <?php if('lain' == $d_tb_paket['jenis']){ echo 'selected'; } ?>>Lain - Lain</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label>Nama Paket</label>
                                    <input type="text" name="nama_paket" value="<?php echo $d_tb_paket['nama_paket']; ?>" class="form-control" placeholder="Masukan Nama Peket">
                                  </div>
                                  <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="harga" value="<?php echo $d_tb_paket['harga']; ?>" class="form-control" placeholder="Masukan Harga">
                                  </div>                            
                                </div>                            
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                  <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      <?php }} ?>
                      <div class="modal fade" id="modal-tambah">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Tambah Data Paket</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form method="post" action="simpan_paket.php">
                             <div class="modal-body">                          
                              <div class="form-group">
                                <label>Nama Outlet</label>
                                <select class="form-control" name="id_outlet">
                                  <option>--- Pilih Nama Outlet ---</option>
                                  <?php
                                  include "../koneksi.php";
                                  $tb_outlet    =mysqli_query($koneksi, "SELECT * FROM tb_outlet");
                                  while($d_tb_outlet = mysqli_fetch_array($tb_outlet)){
                                    ?>
                                    <option value="<?=$d_tb_outlet['id']?>"><?=$d_tb_outlet['nama']?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Jenis</label>
                                <select class="form-control" name="jenis">
                                  <option>--- Silahkan Pilih Jenis ---</option>
                                  <option value="kiloan">Kiloan</option>
                                  <option value="selimut">Selimut</option>
                                  <option value="bed_cover">Bed Cover</option>
                                  <option value="kaos">Kaos</option>
                                  <option value="lain">Lain - Lain</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Nama Paket</label>
                                <input type="text" name="nama_paket" class="form-control" placeholder="Masukan Nama Peket">
                              </div>
                              <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control" placeholder="Masukan Harga">
                              </div>                            
                            </div>                            
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <?php 
  include '../layouts/footer.php';
  ?>