<style>
.grid-container {
  display: grid;
  grid-template-columns: auto;
  /* background-color: #2196F3; */
  padding: 10px;
  margin: 20px;
  box-shadow: 5px 5px 5px 5px;
}
.grid-container-tabel {
  display: grid;
  grid-template-columns: 50% 50%;
}

.grid-container-ttd {
  display: grid;
  grid-template-columns: 70% 30%;
  font-family:Cambria;
  font-size:12px;
  margin-top: 20px;
}
.grid-item {
  /* background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 20px;
  font-size: 30px;
  text-align: center; */
  margin: 10px;
  padding: 10px;
  overflow: auto;
}

.grid-container-inside {
  display: grid;
  grid-template-columns: 25px 200px auto;
  font-family:Cambria;
  font-size:12px;
}
.grid-item-inside {
  /* background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 20px;
  font-size: 30px;
  text-align: center; */
  grid-column:1/4;
  padding-top: 10px;
}

.grid-item-inside-center {
  /* background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 20px;
  font-size: 30px;*/
  text-align: center;
  grid-column:1/4;
}
</style>

<div class="grid-container">
  <div class="grid-item" id="print_area">

    <?php
      $tgl = explode("-",$tgl_cetak);

      $t = return_nama_tahun($t_id);

      for($i=0;$i<count($sis_arr);$i++):
        $mapel_detail = mapel_urutan_by_kelas($kelas_id);

    ?>
<?php
$sis_no_induk = return_sis_no_induk_from_d_s_id( $sis_arr[$i]);
$jsonsister = return_jsonsister($sis_no_induk);
//echo "siswa : $sis_arr[$i]<br>";   
//echo "sis_no_induk : $sis_no_induk<br>";   
?>
<?php
// Sister Presensi SMT 1
$jsontahunakademiksister1 = return_jsontahunakademiksister($t['t_nama'],1);
$tahunakademik_id1 = $jsontahunakademiksister1[0]['tahunakademik_id'];
$nis = $sis_no_induk;
$data1 = file_get_contents("http://sisterv4.frateran.sch.id/sisterv4fratz/api/siswapresensitahunakademik?nis=".$nis."&tahunakademik=".$tahunakademik_id1."");
$json1 = json_decode($data1, TRUE);
$sakit1 =  $json1['sakit'];
$ijin1 =  $json1['ijin'];
$alpa1 =  $json1['alpa'];
// Sister Presensi SMT 2
$jsontahunakademiksister2 = return_jsontahunakademiksister($t['t_nama'],2);
$tahunakademik_id2 = $jsontahunakademiksister2[0]['tahunakademik_id'];
$nis = $detail_siswa['sis_no_induk'];
$data2 = file_get_contents("http://sisterv4.frateran.sch.id/sisterv4fratz/api/siswapresensitahunakademik?nis=".$nis."&tahunakademik=".$tahunakademik_id2."");
$json2 = json_decode($data2, TRUE);
$sakit2 =  $json2['sakit'];
$ijin2 =  $json2['ijin'];
$alpa2 =  $json2['alpa'];
// Sister Presensi
?>

        <div class="grid-container-inside">
          <div class="grid-item-inside-center">
            <div><b>LEMBAR BUKU INDUK PESERTA DIDIK SMA</b></div>
            <div>NOMOR INDUK PESERTA DIDIK: <?= $sis_no_induk; ?></div>
          </div>
          <br>
          <div class="grid-item-inside"><b>A. KETERANGAN DIRI PESERTA DIDIK</b></div>
          <div>1.</div> <div>Nama Lengkap</div> <div>: <?php echo strtoupper($jsonsister[0]['namasiswa']);?></div>
          <div></div> <div>Nama Panggilan</div> <div>: <?php echo strtoupper($jsonsister[0]['panggilansiswa']);?></div>
          <div>2.</div> <div>Jenis Kelamin</div> <div>: <?php echo strtoupper($jsonsister[0]['kelaminsiswa']);?></div>
          <div>3.</div> <div>Tempat dan Tanggal Lahir</div> <div>: <?php echo strtoupper($jsonsister[0]['tempatlahirsiswa']);?>,  <?php echo ($jsonsister[0]['tanggallahirsiswa']);?></div>
          <div>4.</div> <div>Agama</div> <div>:</div>
          <div>5.</div> <div>Kewarganegaraan</div> <div>: <?php echo strtoupper($jsonsister[0]['agamasiswa']);?></div>
          <div>6.</div> <div>Anak Keberapa</div> <div>: <?php echo strtoupper($jsonsister[0]['anakke']);?></div>
          <div>7.</div> <div>Jumlah Saudara Kandung</div> <div>: <?php echo strtoupper($jsonsister[0]['jumlahsaudara']);?></div>
          <div>8.</div> <div>Jumlah Saudara Tiri</div> <div>:</div>
          <div>9.</div> <div>Jumlah Saudara Angkat</div> <div>:</div>
          <div>10.</div> <div>Anak Yatim/ Piatu/ Yatim Piatu</div> <div>: <?php echo strtoupper($jsonsister[0]['statusanak']);?></div>
          <div>11.</div> <div>Bahasa Sehari-hari di rumah</div> <div>: <?php echo strtoupper($jsonsister[0]['bahasasiswa']);?></div>

          <div class="grid-item-inside"><b>B. KETERANGAN TEMPAT TINGGAL</b></div>
          <div>12.</div> <div>Alamat</div> <div>:  <?php echo strtoupper($jsonsister[0]['alamatsiswa']);?></div>
          <div>13.</div> <div>No Telepon/HP</div> <div>: <?php echo strtoupper($jsonsister[0]['teleponsiswa']);?>  <?php echo strtoupper($jsonsister[0]['hpsiswa']);?></div>
          <div>14.</div> <div>Tinggal dengan Orang</div> <div></div>
          <div></div> <div>Tua/Saudara/Asrama/Kost</div> <div>:  <?php echo strtoupper($jsonsister[0]['jenistinggal']);?></div>
          <div>15.</div> <div>Jarak Tempat Tinggal ke Sekolah</div> <div>:  <?php echo strtoupper($jsonsister[0]['jarak']);?></div>

          <div class="grid-item-inside"><b>C. KETERANGAN KESEHATAN</b></div>
          <div>16.</div> <div>Golongan Darah</div> <div>: </div>
          <div>17.</div> <div>Penyakit yang pernah diderita</div> <div>:</div>
          <div>18.</div> <div>Kelainan Jasmani</div> <div>:</div>
          <div>19.</div> <div>Tinggi dan Berat badan</div> <div>:  <?php echo strtoupper($jsonsister[0]['tinggisiswa']);?> CM,  <?php echo strtoupper($jsonsister[0]['beratsiswa']);?> KG</div>
          <div></div> <div>(Saat diterima di sekolah ini)</div> <div></div>

          <div class="grid-item-inside"><b>D. KETERANGAN PENDIDIKAN</b></div>
          <div>20.</div> <div>Pendidikan Sebelumnya</div> <div>:</div>
          <div></div> <div>a. Tamat dari</div> <div>: <?php echo strtoupper($jsonsister[0]['sekolahasal']);?></div>
          <div></div> <div>b. Tanggal dan Nomor Ijazah</div> <div>: <?php echo strtoupper($jsonsister[0]['ijazah']);?></div>
          <div></div> <div>c. Tanggal dan Nomor STL</div> <div>:</div>
          <div></div> <div>d. Lama Belajar</div> <div>:</div>
          <div>21.</div> <div>Pindahan</div> <div>:</div>
          <div></div> <div>a. Dari Sekolah</div> <div>:</div>
          <div></div> <div>b. Alasan</div> <div>:</div>
          <div>22.</div> <div>Diterima di sekolah ini</div> <div>:</div>
          <div></div> <div>a. Di kelas</div> <div>: <?php echo strtoupper($jsonsister[0]['kelas_diterima']);?></div>
          <div></div> <div>b. Kelompok</div> <div>:</div>
          <div></div> <div>c. Tanggal</div> <div>: <?php echo strtoupper($jsonsister[0]['tgl_diterima']);?></div>

          <div class="grid-item-inside"><b>E. KETERANGAN TENTANG AYAH KANDUNG</b></div>
          <div>23.</div> <div>Nama</div> <div>: <?php echo strtoupper($jsonsister[0]['namaayah']);?></div>
          <div>24.</div> <div>Tempat dan Tanggal Lahir</div> <div>: <?php echo strtoupper($jsonsister[0]['tempatlahirayah']);?>, <?php echo strtoupper($jsonsister[0]['tanggallahirayah']);?></div>
          <div>25.</div> <div>Alamat</div> <div>: <?php echo strtoupper($jsonsister[0]['alamatayah']);?></div>
          <div>26.</div> <div>No Telepon/HP</div> <div>: <?php echo strtoupper($jsonsister[0]['teleponayah']);?> <?php echo strtoupper($jsonsister[0]['hpayah']);?></div>
          <div>27.</div> <div>Agama</div> <div>: <?php echo strtoupper($jsonsister[0]['agamaayah']);?></div>
          <div>28.</div> <div>Kewarganegaraan</div> <div>:</div>
          <div>29.</div> <div>Pendidikan</div> <div>: <?php echo strtoupper($jsonsister[0]['pendidikanayah']);?></div>
          <div>30.</div> <div>Pekerjaan</div> <div>: <?php echo strtoupper($jsonsister[0]['pekerjaanayah']);?></div>
          <div>31.</div> <div>Pendapatan</div> <div>: <?php echo strtoupper($jsonsister[0]['gajiayah']);?></div>
          <div>32.</div> <div>Masih hidup/meninggal dunia</div> <div>: <?php echo strtoupper($jsonsister[0]['statusayah']);?></div>

          <div class="grid-item-inside"><b>F. KETERANGAN TENTANG IBU KANDUNG</b></div>
          <div>33.</div> <div>Nama</div> <div>: <?php echo strtoupper($jsonsister[0]['namaibu']);?></div>
          <div>34.</div> <div>Tempat dan Tanggal Lahir</div> <div>: <?php echo strtoupper($jsonsister[0]['tempatlahiribu']);?>, <?php echo strtoupper($jsonsister[0]['tanggalahiribu']);?></div>
          <div>35.</div> <div>Alamat</div> <div>: <?php echo strtoupper($jsonsister[0]['alamatibu']);?></div>
          <div>36.</div> <div>No Telepon/HP</div> <div>: <?php echo strtoupper($jsonsister[0]['teleponibu']);?> <?php echo strtoupper($jsonsister[0]['hpibu']);?></div>
          <div>37.</div> <div>Agama</div> <div>: <?php echo strtoupper($jsonsister[0]['agamaibu']);?></div>
          <div>38.</div> <div>Kewarganegaraan</div> <div>:</div>
          <div>39.</div> <div>Pendidikan</div> <div>: <?php echo strtoupper($jsonsister[0]['pendidikanibu']);?></div>
          <div>40.</div> <div>Pekerjaan</div> <div>: <?php echo strtoupper($jsonsister[0]['pekerjaanibu']);?></div>
          <div>41.</div> <div>Pendapatan</div> <div>: <?php echo strtoupper($jsonsister[0]['gajiibu']);?></div>
          <div>42.</div> <div>Masih hidup/meninggal dunia</div> <div>: <?php echo strtoupper($jsonsister[0]['statusibu']);?></div>

          <div class="grid-item-inside"><b>G. KETERANGAN TENTANG WALI</b></div>
          <div>43.</div> <div>Nama</div> <div>: <?php echo strtoupper($jsonsister[0]['namawali']);?></div>
          <div>44.</div> <div>Tempat dan Tanggal Lahir</div> <div>: <?php echo strtoupper($jsonsister[0]['tempatlahirwali']);?>,  <?php echo strtoupper($jsonsister[0]['tanggallahirwali']);?></div>
          <div>45.</div> <div>Alamat</div> <div>: <?php echo strtoupper($jsonsister[0]['alamatwali']);?></div>
          <div>46.</div> <div>No Telepon/HP</div> <div>: <?php echo strtoupper($jsonsister[0]['teleponwali']);?> <?php echo strtoupper($jsonsister[0]['hpwali']);?></div>
          <div>47.</div> <div>Agama</div> <div>: <?php echo strtoupper($jsonsister[0]['agamawali']);?></div>
          <div>48.</div> <div>Kewarganegaraan</div> <div>:</div>
          <div>49.</div> <div>Pendidikan</div> <div>: <?php echo strtoupper($jsonsister[0]['pendidikanwali']);?></div>
          <div>50.</div> <div>Pekerjaan</div> <div>: <?php echo strtoupper($jsonsister[0]['pekerjaanwali']);?></div>
          <div>51.</div> <div>Pendapatan</div> <div>: <?php echo strtoupper($jsonsister[0]['gajiwali']);?></div>
          <div>52.</div> <div>Masih hidup/meninggal dunia</div> <div>: <?php echo strtoupper($jsonsister[0]['statuswali']);?></div>

          <div class="grid-item-inside"><b>H. KEGEMARAN PESERTA DIDIK</b></div>
          <div>53.</div> <div>Kesenian</div> <div>:</div>
          <div>54.</div> <div>Olahraga</div> <div>:</div>
          <div>55.</div> <div>Kemasyarakatan/Organisasi</div> <div>:</div>
          <div>56.</div> <div>Lain-lain</div> <div>:</div>

          <div class="grid-item-inside"><b>I. KETERANGAN PERKEMBANGAN PESERTA DIDIK</b></div>
          <div>57.</div> <div>Menerima Beasiswa</div> <div>:</div>
          <div>58.</div> <div>Meninggalkan sekolah ini</div> <div></div>
          <div></div> <div>a. </div> <div>:</div>
          <div></div> <div>b. </div> <div>:</div>
          <div>59.</div> <div>Akhir Pendidikan</div> <div></div>
          <div></div> <div>a. Tamat belajar/ Lulus</div> <div>:</div>
          <div></div> <div>b. Ijazah</div> <div>:</div>
          <div></div> <div>c. Nomor Surat Tanda Lulus/STL</div> <div>:</div>
          <div></div> <div>d. Nilai Rata-rata yang dicapai</div> <div>:</div>

          <div class="grid-item-inside"><b>J. KETERANGAN SETELAH SELESAI PENDIDIKAN</b></div>
          <div>60.</div> <div>Akan melanjukan ke</div> <div>:</div>
          <div>61.</div> <div>Akan bekerja di</div> <div>:</div>
        </div>

        <p style="page-break-after: always;">&nbsp;</p>
        <table class="rapot">
          <thead>
            <tr>
              <td rowspan="4" style="width:30px; text-align: center;">No</td>
              <td rowspan="4" style="width:250px; text-align: center;">MAPEL</td>
              <td colspan="4" style="text-align: center;">Th. Ajaran <?= $t['t_nama'] ?></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: center;">KKM</td>
              <td colspan="2" style="text-align: center;">KKM</td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: center;">Semester 1</td>
              <td colspan="2" style="text-align: center;">Semester 2</td>
            </tr>
            <tr>
              <td style="text-align: center;">Pengetahuan</td>
              <td style="text-align: center;">Keterampilan</td>
              <td style="text-align: center;">Pengetahuan</td>
              <td style="text-align: center;">Keterampilan</td>
            </tr>
          </thead>
          <tbody>
            <?php
              $no=1;
              $mapel_kel_nama = "";
              foreach ($mapel_detail as $m):
                ////////////////////////semester 1///////////////////////////////

                $nilai = returnRaportPengetahuan($sis_arr[$i], 1, $m['mapel_id']);
                if($nilai){
                  $ujmid = $nilai['uj_mid1_kog'];
                  $ujfin = $nilai['uj_fin1_kog'];
                  $nh = $nilai['NH'];
                }else{
                  $ujmid = 0;
                  $ujfin = 0;
                  $nh = 0;
                }

                $nilai_ket = returnRaportKetrampilan($sis_arr[$i], 1, $m['mapel_id']);
                if($nilai_ket){
                  $ujmidps = $nilai_ket['uj_mid1_psi'];
                  $ujfinps = $nilai_ket['uj_fin1_psi'];
                  $naKet = round(hitungNA($nilai_ket['NA_ket'],$ujmidps,$ujfinps));
                }else{
                  $ujmidps = 0;
                  $ujfinps = 0;
                  $naKet = 0;
                }
                /////////////////////////semester 2//////////////////////////////
                $nilai2 = returnRaportPengetahuan($sis_arr[$i], 2, $m['mapel_id']);
                if($nilai2){
                  $ujmid2 = $nilai2['uj_mid2_kog'];
                  $ujfin2 = $nilai2['uj_fin2_kog'];
                  $nh2 = $nilai2['NH'];
                }else{
                  $ujmid2 = 0;
                  $ujfin2 = 0;
                  $nh2 = 0;
                }

                $nilai_ket2 = returnRaportKetrampilan($sis_arr[$i], 2, $m['mapel_id']);
                if($nilai_ket2){
                  $ujmidps2 = $nilai_ket2['uj_mid2_psi'];
                  $ujfinps2 = $nilai_ket2['uj_fin2_psi'];
                  $naKet2 = round(hitungNA($nilai_ket2['NA_ket'],$ujmidps2,$ujfinps2));
                }else{
                  $ujmidps2 = 0;
                  $ujfinps2 = 0;
                  $naKet2 = 0;
                }
            ?>
              <tr>
                <?php if($mapel_kel_nama != $m['mapel_kel_nama']): ?>
                  <td style="text-align: center;" colspan="2"><b><?= $m['mapel_kel_nama'] ?></b></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                <?php endif; ?>
              </tr>
              <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td style="padding: 0px 0px 0px 5px;"><?= $m['mapel_nama'] ?></td>
                <!-- pengetahuan semester 1 -->
                <td style="text-align: center;"><?= round(hitungNA($nh,$ujmid,$ujfin)) ?></td>
                <td style="text-align: center;">
<!-- keterampilan semester 1 -->
                <?php
                $siswa_id=$sis_arr[$i];
                $jumlahnilaimax=0;
                $nilaimax =0;
                $jumlahitem=0;
                $topik_mapel = topikberdasarkanmapel(1, $m['mapel_id']);
                $uj = return_uj_by_d_s_id($siswa_id, $m['mapel_id']);
                foreach ($topik_mapel as $t){
                $nilaimax = return_tes_by_d_s_id_topik_max($siswa_id, $t['topik_id']);
                $tes = return_tes_by_d_s_id_topik($siswa_id, $t['topik_id']);
                if($tes and ($nilaimax>0)){
                $jumlahnilaimax +=$nilaimax;
//                echo $siswa_id.">>";
//                echo $t['topik_id'];
//                echo "[".$jumlahnilaimax."]<br>";
                $jumlahitem++;
                }
                }
                ?>
                <?php
                $NH_ket_hasil_baru = $jumlahnilaimax/$jumlahitem;
                $nabaru = ($NH_ket_hasil_baru!=0)?round(hitungNA($NH_ket_hasil_baru,$uj['uj_mid1_psi'],$uj['uj_fin1_psi'])):'-';
//                echo "NilaiMax :".$jumlahnilaimax."<br>";
//                echo "Jumlahitem :".$jumlahitem."<br>";
//                echo "NH_ket_hasil_baru :".$NH_ket_hasil_baru."<br>";
                echo $nabaru;
                ?>
<!-- keterampilan semester 1 -->                
                </td>
                <!-- pengetahuan semester 2 -->
                <td style="text-align: center;"><?= round(hitungNA($nh2,$ujmid2,$ujfin2)) ?></td>
                <td style="text-align: center;">
                <!-- keterampilan semester 2 -->
                <?php
                $siswa_id=$sis_arr[$i];
                $jumlahnilaimax=0;
                $nilaimax =0;
                $jumlahitem=0;
                $topik_mapel = topikberdasarkanmapel(2, $m['mapel_id']);
                $uj = return_uj_by_d_s_id($siswa_id, $m['mapel_id']);
                foreach ($topik_mapel as $t){
                $nilaimax = return_tes_by_d_s_id_topik_max($siswa_id, $t['topik_id']);
                $tes = return_tes_by_d_s_id_topik($siswa_id, $t['topik_id']);
                if($tes and ($nilaimax>0)){
                $jumlahnilaimax +=$nilaimax;
//                echo $siswa_id.">>";
//                echo $t['topik_id'];
//                echo "[".$jumlahnilaimax."]<br>";
                $jumlahitem++;
                }
                }
                ?>
                <?php
                $NH_ket_hasil_baru = $jumlahnilaimax/$jumlahitem;
                $nabaru2 = ($NH_ket_hasil_baru!=0)?round(hitungNA($NH_ket_hasil_baru,$uj['uj_mid2_psi'],$uj['uj_fin2_psi'])):'-';
//                echo "NilaiMax :".$jumlahnilaimax."<br>";
//                echo "Jumlahitem :".$jumlahitem."<br>";
//                echo "NH_ket_hasil_baru :".$NH_ket_hasil_baru."<br>";
                echo $nabaru2;
                ?>
<!-- keterampilan semester 2 -->  
                
                </td>
              </tr>
            <?php
              $no++;
              $mapel_kel_nama = $m['mapel_kel_nama'];
              endforeach;
            ?>
            <tr>
              <td style="padding: 0px 0px 0px 5px;" colspan="2"><b>SIKAP SPIRITUAL</b></td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td style="padding: 0px 0px 0px 5px;" colspan="2"><b>SIKAP SOSIAL</b></td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;" colspan="2"><b>PENGEMBANGAN DIRI</b></td>
              <td colspan="2"></td><td colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">A</td>
              <td style="padding: 0px 0px 0px 5px;">Ekstrakurikuler</td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">B</td>
              <td style="padding: 0px 0px 0px 5px;">Keikutsertaan Dalam Organisasi/Kegiatan di Sekolah</td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;" colspan="2"><b>KETIDAKHADIRAN</b></td>
              <td colspan="2"></td><td colspan="2"></td>
            </tr>
            <tr>
              <td style="padding: 0px 0px 0px 5px;" colspan="2">Sakit</td>
              <td colspan="2" align="center"><?= $sakit1; ?></td>
              <td colspan="2" align="center"><?= $sakit2; ?></td>
            </tr>
            <tr>
              <td style="padding: 0px 0px 0px 5px;" colspan="2">Izin</td>
              <td colspan="2" align="center"><?= $ijin1;?></td>
              <td colspan="2" align="center"><?= $ijin2;?></td>
            </tr>
            <tr>
              <td style="padding: 0px 0px 0px 5px;" colspan="2">Tanpa Keterangan</td>
              <td colspan="2" align="center"><?= $alpa1;?></td>
              <td colspan="2" align="center"><?= $alpa2;?></td>
            </tr>
            <tr>
              <td style="text-align: center;" colspan="2"><b>AKHLAK MULIA DAN KEPRIBADIAN</b></td>
              <td colspan="2"></td><td colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">1</td>
              <td style="padding: 0px 0px 0px 5px;">Kedisiplinan</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">2</td>
              <td style="padding: 0px 0px 0px 5px;">Kebersihan</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">3</td>
              <td style="padding: 0px 0px 0px 5px;">Kesehatan</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">4</td>
              <td style="padding: 0px 0px 0px 5px;">Tanggung Jawab</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">5</td>
              <td style="padding: 0px 0px 0px 5px;">Sopan Santun</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">6</td>
              <td style="padding: 0px 0px 0px 5px;">Percaya diri</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">7</td>
              <td style="padding: 0px 0px 0px 5px;">Kompetitif</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">8</td>
              <td style="padding: 0px 0px 0px 5px;">Hubungan sosial</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">9</td>
              <td style="padding: 0px 0px 0px 5px;">Kejujuran</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">10</td>
              <td style="padding: 0px 0px 0px 5px;">Pelaksaaan ibadah ritual</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;" colspan="2"><br><b>STATUS AKHIR TAHUN</b></td>
              <td colspan="4">
                <div class="grid-container-tabel">
                  <div style="text-align: center;">
                      Naik Ke<br>Tinggal di
                  </div>
                  <div style="text-align: center;">
                      <br>
                      Kelas:
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="grid-container-ttd">
          <div></div>
          <div style="text-align: center;">
            <b>Surabaya, <?= $tgl[2].' '.return_nama_bulan($tgl[1]).' '.$tgl[0] ?></b><br>
            <b>Wali Kelas</b><br><br><br><br>
            <b>(<?= $walkel['kr_gelar_depan']." ".ucwords(strtolower($walkel['kr_nama_depan'].' '.$walkel['kr_nama_belakang'])).", ".$walkel['kr_gelar_belakang'] ?>)</b>
          </div>
        </div>

        <p style="page-break-after: always;">&nbsp;</p>
    <?php
      endfor;
    ?>

  </div>
  <input style="width:20%;" type="button" name="print_rekap" id="print_rekap" class="btn btn-success mb-3 ml-3" value="Print">
</div>
