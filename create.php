<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $Nama = isset($_POST['Nama']) ? $_POST['Nama'] : '';
    $Kode_Matakuliah = isset($_POST['Kode_Matakuliah']) ? $_POST['Kode_Matakuliah'] : '';
    $Deskripsi = isset($_POST['Deskripsi']) ? $_POST['Deskripsi'] : '';
    // $pekerjaan = isset($_POST['pekerjaan']) ? $_POST['pekerjaan'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO matakuliah VALUES (?, ?, ?, ?)');
    $stmt->execute([$id, $Nama, $Kode_Matakuliah, $Deskripsi]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="Nama">Nama</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="Nama" id="Nama">
        <label for="Kode_Matakuliah">Kode Matakuliah</label>
        <label for="Deskripsi">Deskripsi</label>
        <input type="text" name="Kode_Matakuliah" id="Kode_Matakuliah">
        <input type="text" name="Deskripsi" id="Deskripsi">
        <!-- <label for="pekerjaan">Pekerjaan</label> -->
        <!-- <input type="text" name="pekerjaan" id="pekerjaan"> -->
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>