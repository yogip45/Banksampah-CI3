<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mahasiswa</title>
</head>
<body>  
  <table border="1px solid black">
      <tr>        
        <th>No.</th>
        <th>Nama Mahasiswa</th>
        <th>Nim</th>
        <th>Alamat</th>        
      </tr>
      <?php $a=0?>
      <?php foreach ($mahasiswa as $mhs) : ?>
        <?php $a++?>
        <tr>
          <td><?php echo $a ?></td>
          <td><?php echo $mhs['nama'] ?></td>
          <td><?php echo $mhs['nim'] ?></td>
          <td><?php echo $mhs['alamat'] ?></td>
        </tr>
      <?php endforeach; ?>

  </table>
</body>
</html>