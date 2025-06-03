<div class="card">
    <div class="card-header">
        <strong>Data User</strong>
    </div>
    <div class="card-body">
        <form action="?page=user-show" method="POST">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukan Username..." name="keyword">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" name="search">Cari!</button>
                </div>
            </div>
        </form>

        <a href="?page=user-add" class="btn btn-primary mb-2">Tambah Data</a>

        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $limit = 5;
                    $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                    $mulai = ($page > 1) ? ($page * $limit) - $limit : 0;

                    if (isset($_POST['search']) && !empty(trim($_POST['keyword']))) {
                        $keyword = trim($_POST['keyword']);
                        $query = mysqli_query($con, "SELECT * FROM user WHERE username LIKE '%$keyword%'") or die(mysqli_error($con));
                    } else {
                        $query = mysqli_query($con, "SELECT * FROM user LIMIT $mulai, $limit") or die(mysqli_error($con));
                    }

                    $no = $mulai + 1;
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $data['username']; ?></td>
                            <td>
                                <a class="btn btn-sm btn-success" href="?page=user-edit&id=<?= $data['id']; ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="../user/user_delete.php?id=<?= $data['id']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')">Hapus</a>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
        $result = mysqli_query($con, "SELECT * FROM user");
        $total_records = mysqli_num_rows($result);
        $jumlah_page = ceil($total_records / $limit);
        ?>

        <p>Jumlah Data: <?= $total_records; ?></p>

        <nav class="mb-5">
            <ul class="pagination justify-content-end">
                <?php
                $jumlah_number = 1;
                $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
                $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;

                // First & Prev
                if ($page == 1) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                    echo '<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="?page=user-show&halaman=1">First</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?page=user-show&halaman=' . ($page - 1) . '">&laquo;</a></li>';
                }

                // Page numbers
                for ($i = $start_number; $i <= $end_number; $i++) {
                    $active = ($page == $i) ? 'active' : '';
                    echo '<li class="page-item ' . $active . '"><a class="page-link" href="?page=user-show&halaman=' . $i . '">' . $i . '</a></li>';
                }

                // Next & Last
                if ($page == $jumlah_page) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>';
                    echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="?page=user-show&halaman=' . ($page + 1) . '">&raquo;</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?page=user-show&halaman=' . $jumlah_page . '">Last</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</div>