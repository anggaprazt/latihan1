<?= $this->extend('layout/template'); ?>
 
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
<h2 class="mt-2">Detail Orangt</h2>
        <div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="/img/<?= $orang['sampul']; ?>" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $komik['judul'];?></h5>
        <p class="card-text"><b>Penulis : </b><?= $komik['penulis'];?></p>
        <p class="card-text"><small class="text-muted"><b>Penerbit : </b><?= $komik['penerbit'];?></small></p>
      
    <a href="/orang/edit/<?= $orang['slug']; ?>"class="btn btn-warning">edit</a>
      <form action="/orang/<?= $orang['id']; ?>" method="post" class="d-inline">
      <?= csrf_field(); ?>
      <input type="hidden" name="_method" value="DELETE">
      <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?');">Delete</button>
      </form>
    <!-- <a href="/komik/delete/<?= $komik['id']; ?>" class="btn btn-danger">hapus</a> -->
    <br>
    <a href="/orang">Kembali ke daftar orang</a>
    </div>
    </div>
  </div>
</div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>