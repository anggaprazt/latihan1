<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();

    }
    public function index()
    {
        
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik()
            ];
            
        return view('komik/index', $data);       
    }

    public function detail($slug)
    {
        $data = [
        'title' => 'Detail Komik', 
        'komik' => $this->komikModel->getKomik($slug)
        ];

        // Jika komik tidak ada dalam daftar 
        if(empty($data['komik']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik '. $slug . 'Tidak Ditemukan');
        }
      //  dd($data);
        return view('komik/detail', $data);
    }
    
    public function create()
    {
        // session();
        $data = [
            'title' => 'Form Tambah Data',
            'validation' => \Config\Services::validation()
            ];
 
        return view('komik/create', $data);
     }

     public function save()
     {
        // validasi input
        if(!$this->validate([
            'judul' => [
            'rules' => 'required|is_unique[komik.judul]',
            'errors' => [
            'required' => '{field} komik harus diisi',
            'is_unique' => '{field} komik sudah terdaftar'
            ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,500]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    // 'uploaded' => 'pilih gambar terlebih dahulu',
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->to('/komik/create')->withInput();
        }
        
        // kelola gambar
        $fileSampul = $this->request->getFile('sampul');
        // apakah tidak ada gambar yang di upload??
        if($fileSampul->getError() ==4) {
            $namaSampul = 'default.jpg';
        } else {
            // generate nama random sampul
                $namaSampul = $fileSampul->getRandomName();
            // pindah file gambar ke folder iMG
                $fileSampul->move('img', $namaSampul);
        }
      
        // ambil nama file
        // $namaSampul = $fileSampul->getName();
        
       
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul

        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/komik');
    }

    public function delete($id)
    {
    // cari gambar berdasarkan ID
        $komik = $this->komikModel->find($id);
        // cek jika file gambar defult.jpg
        if ($komik['sampul'] != 'default.jpg') {
        // dd($komik);

    // hapus gambar dari server dan database img
            unlink('img/' . $komik['sampul']);
    }

        
         $this->komikModel->delete($id);
         session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
         return redirect()->to('/komik');
     }

     public function edit($slug)
     {
        $data = [
            'title' => 'Form Ubah Data',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
            ];
 
        return view('komik/edit', $data);
     }

     public function update($id)
     {
        //  cek judul
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        } 
        
        // validasi input
         if(!$this->validate([
            'judul' => [
             'rules' => $rule_judul,
             'errors' => [
                 'required' => '{field} komik harus diisi',
                 'is_unique' => '{field} komik sudah terdaftar'
             ]
             ],

             'sampul' => [
                'rules' => 'max_size[sampul,500]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    // 'uploaded' => 'pilih gambar terlebih dahulu',
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                     
                ]
               ]

            // Validasi sampul/pilih gambar
            //  'sampul' => 'uploaded[sampul]'
        ])) {
            // $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput();//->with('validation', $validation);
            // return redirect()->to('/komik/create')->withInput();
        }

        // kelola gambar baru
        $fileSampul = $this->request->getFile('sampul');

        // cek apakah tetap gambar lama??
        if($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // generate nama random file
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan gambar
            $fileSampul->move('img', $namaSampul);
            // hapus file lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }
        
        //  dd($this->request->getVar());
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/komik');
     }
}
