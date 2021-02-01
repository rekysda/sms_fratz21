<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah_CRUD extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('_sk');
    $this->load->model('_kr');
    $this->load->model('_jabatan');
    $this->load->model('_st');
    $this->load->model('_t');


    //jika belum login
    if (!$this->session->userdata('kr_jabatan_id')) {
      redirect('Auth');
    }

    //jika bukan HRD dan sudah login redirect ke home
    if ($this->session->userdata('kr_jabatan_id') != 1 && $this->session->userdata('kr_jabatan_id') != 4 && $this->session->userdata('kr_jabatan_id')) {
      redirect('Profile');
    }
  }

  public function index()
  {

    $data['title'] = 'Detail Sekolah';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //data karyawan untuk konten
    $data['sk_all'] = $this->db->query(
      "Select sk_id, sk_nama, sk_mid, sk_fin, kr1.kr_nama_depan as kepsek, kr2.kr_nama_depan as guru_scout
      from sk, kr kr1, kr kr2
      where kr1.kr_id = sk.sk_kepsek
      and kr2.kr_id = sk.sk_scout_kr_id")->result_array();

    //$data['tes'] = var_dump($this->db->last_query());

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('sekolah_crud/index', $data);
    $this->load->view('templates/footer');
  }

  public function check_default($post_string)
  {
    return $post_string == '0' ? FALSE : TRUE;
  }

  public function add()
  {

    $this->form_validation->set_rules('sk_nama', 'School Name', 'required|trim');
    $this->form_validation->set_rules('sk_nickname', 'School Nickname', 'required|trim');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Tambah Sekolah';

      //data karyawan yang sedang login untuk topbar
      $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
      $data['sk_all'] = $this->_sk->return_all();
      $data['guru_all'] = $this->_kr->return_all_teacher();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('sekolah_crud/add', $data);
      $this->load->view('templates/footer');
    } else {
      $rawdate = htmlentities($this->input->post('sk_mid'));
      $sk_mid = date('Y-m-d', strtotime($rawdate));

      $rawdate = htmlentities($this->input->post('sk_fin'));
      $sk_fin = date('Y-m-d', strtotime($rawdate));

      $data = [
        'sk_nama' => $this->input->post('sk_nama'),
        'sk_nickname' => $this->input->post('sk_nickname'),
        'sk_mid' => $sk_mid,
        'sk_kepsek' => $this->input->post('kr_id'),
        'sk_fin' => $sk_fin
      ];

      $this->db->insert('sk', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">School Created!</div>');
      redirect('sekolah_crud/add');
    }
  }

  public function update()
  {

    //dari method post
    $sk_post = $this->input->get('_id', true);

    //jika bukan dari form update sendiri
    if (!$sk_post) {
      //ambil id dari method get
      $sk_get = $this->_sk->find_by_id($this->input->post('_id', true));

      //jika langsung akses halaman update atau jabatan yang akan diedit admin
      if ($sk_get['sk_id'] == 0 || !$sk_get['sk_id']) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Do not access page directly, please use edit button instead!</div>');
        redirect('Sekolah_CRUD');
      }
    }

    $this->form_validation->set_rules('sk_nama', 'School Name', 'required|trim');
    $this->form_validation->set_rules('sk_nickname', 'School Nickname', 'required|trim');

    if ($this->form_validation->run() == false) {
      //jika menekan tombol edit
      $data['title'] = 'Edit Sekolah';

      //data karyawan yang sedang login untuk topbar
      $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
      $data['jabatan_all'] = $this->_jabatan->return_all();
      $data['st_all'] = $this->_st->return_all();
      $data['guru_all'] = $this->_kr->return_all_teacher();

      //simpan data primary key
      $sk_id = $this->input->get('_id', true);

      $data['sk_update'] = $this->_sk->find_by_id($sk_id);

      //load view dengan data query
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('sekolah_crud/update', $data);
      $this->load->view('templates/footer');
    } else {
      //fetch data hasil inputan
      $rawdate = htmlentities($this->input->post('sk_mid'));
      $sk_mid = date('Y-m-d', strtotime($rawdate));

      $rawdate = htmlentities($this->input->post('sk_fin'));
      $sk_fin = date('Y-m-d', strtotime($rawdate));
      $data = [
        'sk_nama' => $this->input->post('sk_nama'),
        'sk_nickname' => $this->input->post('sk_nickname'),
        'sk_mid' => $sk_mid,
        'sk_kepsek' => $this->input->post('kr_id'),
        'sk_scout_kr_id' => $this->input->post('sckr_id'),
        'sk_fin' => $sk_fin
      ];

      //simpan ke db

      $this->db->where('sk_id', $this->input->post('_id'));
      $this->db->update('sk', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data sekolah berhasil diupdate!</div>');
      redirect('Sekolah_CRUD');
    }
  }
}
