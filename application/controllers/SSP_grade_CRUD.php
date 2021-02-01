<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SSP_grade_CRUD extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('_sk');
    $this->load->model('_kr');
    $this->load->model('_jabatan');
    $this->load->model('_st');
    $this->load->model('_kelas');
    $this->load->model('_mapel');
    $this->load->model('_ssp_topik');


    //jika belum login
    if(!$this->session->userdata('kr_jabatan_id')){
      redirect('Auth');
    }

    //jika bukan guru dan sudah login redirect ke home
    if($this->session->userdata('kr_jabatan_id')!=7 && $this->session->userdata('kr_jabatan_id')){
      redirect('Profile');
    }
  }

  public function index(){

    $data['title'] = 'Nilai Ekstra';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //$data['tes'] = var_dump($this->db->last_query());

    //cari guru mengajar mapel mana saja

    $kr_id = $data['kr']['kr_id'];

    //SELECT * from d_mpl WHERE d_mpl_kr_id = $data['kr']['kr_id']

    $data['ssp_all'] = $this->db->query(
      "SELECT ssp_id, ssp_nama, t_nama, t_id
      FROM ssp
      LEFT JOIN t ON ssp_t_id = t_id
      WHERE ssp_kr_id = $kr_id
      ORDER BY t_id DESC, ssp_nama")->result_array();

    //var_dump($this->db->last_query());
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('ssp_grade_crud/index',$data);
    $this->load->view('templates/footer');

  }

  public function get_topik(){

    if($this->input->post('id',TRUE)){
      $ssp_id = $this->input->post('id',TRUE);

      $data = $this->db->query(
        "SELECT *
        FROM ssp_topik
        WHERE ssp_topik_ssp_id = $ssp_id
        ORDER BY ssp_topik_semester DESC, ssp_topik_nama")->result();

      //$data = $this->product_model->get_sub_category($category_id)->result();
      echo json_encode($data);
    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }

  }

  public function input(){

    if(!$this->input->post('arr_ssp')){
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Do not access page directly!</div>');
      redirect('ssp_grade_CRUD');
    }

    $ssp_id = $this->input->post('arr_ssp');

    $siswacount =$this->db->query(
      "SELECT *
      FROM ssp_peserta
      WHERE ssp_peserta_ssp_id = $ssp_id")->result_array();

    if(!$siswacount){
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Belum ada siswa terdaftar di Ekstrakurikuler!</div>');
      redirect('SSP_grade_CRUD');
    }

    $data['title'] = 'Nilai Ekstrakurikuler';
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    $data['ssp_id'] = $ssp_id;

    //belum ada nilai
    $data['siswa_all'] = $this->db->query(
      "SELECT d_s_id, sis_nama_depan, sis_nama_bel, sis_no_induk, kelas_nama, ssp_peserta_ssp_id, ssp_peserta_nilai, ssp_peserta_nilai2, ssp_peserta_id, ssp_nama, ssp_peserta_komen1,ssp_peserta_komen2
      FROM ssp_peserta
      LEFT JOIN ssp ON ssp_peserta_ssp_id = ssp_id
      LEFT JOIN d_s ON d_s_id = ssp_peserta_d_s_id
      LEFT JOIN sis ON d_s_sis_id = sis_id
      LEFT JOIN kelas ON d_s_kelas_id = kelas_id
      WHERE ssp_peserta_ssp_id = $ssp_id
      ORDER BY kelas_nama, sis_nama_depan")->result_array();

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('ssp_grade_crud/input',$data);
    $this->load->view('templates/footer');


  }

  public function addStudent(){

    if($this->input->post('siswa_check[]',TRUE)){
      $d_s_id = $this->input->post('siswa_check[]',TRUE);
      $ssp_id = $this->input->post('sspId',TRUE);


      for($i=0;$i<count($d_s_id);$i++){
        $data[] = array(
          'ssp_peserta_d_s_id' => $d_s_id[$i],
          'ssp_peserta_ssp_id' => $ssp_id
        );
      }

      $this->db->insert_batch('ssp_peserta', $data);

      $this->db->last_query();

      //$data = $this->product_model->get_sub_category($category_id)->result();
      echo '<div class="alert alert-success" role="alert">Successfully Added '. count($d_s_id) .' student(s)</div>';
    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }
  }

  public function pendaftaran_index(){
    $data['title'] = 'Pendaftaran';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //cari guru mengajar mapel mana saja

    $kr_id = $data['kr']['kr_id'];

    $data['ssp_all'] = $this->db->query(
      "SELECT ssp_id, ssp_nama, t_nama, t_id
      FROM ssp
      LEFT JOIN t ON ssp_t_id = t_id
      WHERE ssp_kr_id = $kr_id
      ORDER BY t_id DESC, ssp_nama")->result_array();

    //var_dump($this->db->last_query());
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('ssp_grade_crud/pendaftaran_index',$data);
    $this->load->view('templates/footer');
  }

  public function pendaftaran_form(){
    if($this->input->post('ssp_id', true)){

      $data['title'] = 'Daftarkan Siswa';
      $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

      $sk_id = $this->session->userdata('kr_sk_id');
      $ssp_id = $this->input->post('ssp_id', true);
      //cari tahun ssp
      $ssp = $this->db->query(
        "SELECT ssp_nama, ssp_t_id
        FROM ssp
        WHERE ssp_id = $ssp_id")->row_array();

      $ssp_t_id = $ssp['ssp_t_id'];
      $data['ssp_nama'] = $ssp['ssp_nama'];
      $data['ssp_id'] = $ssp_id;

      //cari kelas pada tahun ajaran itu
      $data['kelas_all'] = $this->db->query(
        "SELECT kelas_id, kelas_nama
        FROM kelas
        WHERE kelas_t_id = $ssp_t_id AND kelas_sk_id = $sk_id ORDER BY kelas_nama")->result_array();

      //var_dump($this->db->last_query());
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('ssp_grade_crud/pendaftaran_form',$data);
      $this->load->view('templates/footer');
    }
  }

  public function get_siswaSSP(){
    if($this->input->post('sspId',TRUE)){
      $sspId = $this->input->post('sspId',TRUE);

      $data = $this->db->query(
        "SELECT d_s_id, sis_nama_depan, sis_nama_bel, kelas_nama, ssp_peserta_ssp_id
        FROM ssp_peserta
        LEFT JOIN d_s ON ssp_peserta_d_s_id = d_s_id
        LEFT JOIN sis ON d_s_sis_id = sis_id
        LEFT JOIN kelas ON d_s_kelas_id = kelas_id
        WHERE ssp_peserta_ssp_id = $sspId")->result();

      //$data = $this->product_model->get_sub_category($category_id)->result();
      echo json_encode($data);
    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }
  }

  public function get_siswaKelas(){
    if($this->input->post('id',TRUE)){
      $kelas_id = $this->input->post('id',TRUE);
      $ssp_id = $this->input->post('id2',TRUE);

      //siswa tidak ada di ssp terpilih
      $data = $this->db->query(
        "SELECT d_s_id, sis_nama_depan, sis_nama_bel
        FROM d_s
        LEFT JOIN sis ON d_s_sis_id = sis_id
        WHERE d_s_kelas_id = $kelas_id AND d_s_id NOT IN (
          SELECT ssp_peserta_d_s_id FROM ssp_peserta WHERE ssp_peserta_ssp_id = $ssp_id
        )")->result();

      //$data = $this->product_model->get_sub_category($category_id)->result();
      echo json_encode($data);
    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }
  }

  public function save_input(){
    if($this->input->post('ssp_peserta_id[]')){
      $data = array();
      $ssp_nilai_angka = $this->input->post('ssp_nilai_angka[]');
      $ssp_nilai_angka2 = $this->input->post('ssp_nilai_angka2[]');
      $ssp_peserta_komen1 = $this->input->post('ssp_peserta_komen1[]');
      $ssp_peserta_komen2 = $this->input->post('ssp_peserta_komen2[]');
      $ssp_peserta_id = $this->input->post('ssp_peserta_id[]');

      for($i=0;$i<count($ssp_nilai_angka);$i++){
        $data[$i] = [
          'ssp_peserta_nilai' => $ssp_nilai_angka[$i],
          'ssp_peserta_nilai2' => $ssp_nilai_angka2[$i],
          'ssp_peserta_id' =>  $ssp_peserta_id[$i],
          'ssp_peserta_komen1' =>  $ssp_peserta_komen1[$i],
          'ssp_peserta_komen2' =>  $ssp_peserta_komen2[$i]
        ];
      }
      $this->db->update_batch('ssp_peserta',$data, 'ssp_peserta_id');
      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil menyimpan nilai!</div>');
      redirect('SSP_grade_CRUD');
    }
  }

}
