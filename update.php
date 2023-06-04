<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $Nama = isset($_POST['Nama']) ? $_POST['Nama'] : '';
        $Kode_Matakuliah = isset($_POST['Kode_Matakuliah']) ? $_POST['Kode_Matakuliah'] : '';
        $Deskripsi = isset($_POST['Deskripsi']) ? $_POST['Deskripsi'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE matakuliah SET id = ?, Nama = ?, Kode_Matakuliah = ?, Deskripsi = ? WHERE id = ?');
        $stmt->execute([$id, $Nama, $Kode_Matakuliah, $Deskripsi, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM matakuliah WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Matakuliah #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="Nama">Nama</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id">
        <input type="text" name="Nama" value="<?=$contact['Nama']?>" id="Nama">
        <label for="Kode_Matakuliah">Kode Matakuliah</label>
        <label for="Deskripsi">Deskripsi</label>
        <input type="text" name="Kode_Matakuliah" value="<?=$contact['Kode_Matakuliah']?>" id="Kode_Matakuliah">
        <input type="text" name="Deskripsi" value="<?=$contact['Deskripsi']?>" id="Deskripsi">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>