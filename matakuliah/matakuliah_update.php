<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $sks = $_POST['sks'];
    $semester = $_POST['semester'];

    $result = mysqli_query($con, "UPDATE matakuliah SET kode='$kode', nama='$nama', sks=$sks, semester=$semester WHERE id=$id");
    header("Location:?page=matakuliah-show");
}
