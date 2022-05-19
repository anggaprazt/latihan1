<?= $this->extend('layout/template'); ?>
 
<?= $this->section('content'); ?>
<!-- stylesheet pagination -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">

<div class="container">
    <div class="row">
        <div class="col">
        <h1 class="mt-2">Daftar Orang</h1>
        <table class="table table-hover" id="datTabOrang">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; ?>
    <?php foreach ($orang as $o) : ?>
    <tr>
      <th scope="row"><?= $i++; ?></th>
      <td><?= $o['nama']; ?></td>
      <td><?= $o['alamat']; ?></td>
      <td><a href="" class="btn btn-success">Detail</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>


        </div>
    </div>
</div>
<!-- Script Pagination -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    $('#datTabOrang').DataTable();
});
</script>
<?= $this->endSection(); ?>