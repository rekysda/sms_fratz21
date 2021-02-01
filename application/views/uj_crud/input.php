<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h4 class="h4 text-gray-900"><b><u><?= $kelas['sk_nama'] ?></u></b></h4>
              <h4 class="h4 text-gray-900"><b><u>UTS and UAS <?= $kelas['kelas_nama'] ?></u></b></h4>
              <h4 class="h4 text-gray-900 mb-4"><u><?= $mapel['mapel_nama'] ?></u></h4>
            </div>

            <?php echo '<div class="alert alert-danger alert-dismissible fade show">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>ALERT:</strong> No grade found, use SAVE BUTTON below to save grade
                </div>'; ?>


            <form class="" action="<?= base_url('Uj_CRUD/save_input'); ?>" method="post" id="sub_uj" >
              <input type="hidden" value="<?= $kelas_id ?>" name="kelas_id">
              <input type="hidden" value="<?= $mapel_id ?>" name="mapel_id">
              <table class="table table-hover table-bordered table-sm" style="font-size:12px;">
                <thead>
                  <tr>
                    <th rowspan="3">No</th>
                    <th rowspan="3">Name</th>
                    <th colspan="4">Semester 1</th>
                    <th colspan="4">Semester 2</th>
                  </tr>
                  <tr>
                    <td colspan="2">Pengetahuan</td>
                    <td colspan="2">Keterampilan</td>
                    <td colspan="2">Pengetahuan</td>
                    <td colspan="2">Keterampilan</td>
                  </tr>
                  <tr>
                    <td>UTS</td>
                    <td>UAS</td>
                    <td>UTS</td>
                    <td>UAS</td>
                    <td>UTS</td>
                    <td>UAS</td>
                    <td>UTS</td>
                    <td>UAS</td>
                  </tr>
                </thead>
                <tbody>

                  <?php
                    foreach ($siswa_all as $m) :

                  ?>

                    <tr>
                      <td>
                        <input type="hidden" value="<?= $m['d_s_id']; ?>" name="d_s_id[]">
                        <?= $m['sis_no_induk']; ?>
                      </td>
                      <td>
                        <?php
                          echo $m['sis_nama_depan']." ".$m['sis_nama_bel'];
                        ?>
                      </td>
                      <td><input type="number" onfocus='this.select();' required class='kin' style='width: 47px;' name="uj_mid1_kog[]" value="0" max="100"></td>
                      <td><input type="number" onfocus='this.select();' required class='kin2' style='width: 47px;' name="uj_fin1_kog[]" value="0" max="100"></td>
                      <td><input type="number" onfocus='this.select();' required class='kin3' style='width: 47px;' name="uj_mid1_psi[]" value="0" max="100"></td>
                      <td><input type="number" onfocus='this.select();' required class='kin4' style='width: 47px;' name="uj_fin1_psi[]" value="0" max="100"></td>

                      <td><input type="number" onfocus='this.select();' required class='kin5' style='width: 47px;' name="uj_mid2_kog[]" value="0" max="100"></td>
                      <td><input type="number" onfocus='this.select();' required class='kin6' style='width: 47px;' name="uj_fin2_kog[]" value="0" max="100"></td>
                      <td><input type="number" onfocus='this.select();' required class='kin7' style='width: 47px;' name="uj_mid2_psi[]" value="0" max="100"></td>
                      <td><input type="number" onfocus='this.select();' required class='kin8' style='width: 47px;' name="uj_fin2_psi[]" value="0" max="100"></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
              <button type="submit" class="btn btn-success mt-2">
                  <i class="fa fa-save"></i>
                  Save All
              </button>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
