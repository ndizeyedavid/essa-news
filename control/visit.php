<?php include "php/include.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ESSA News</title>
    <link rel="stylesheet" href="icons/bootstrap-icons.css">
    <link rel="icon" href="../assets/img/3.png">

</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bi bi-code'></i>
            <div class="logo-name"><span>ESSA</span>News</div>
        </a>
        <ul class="side-menu">
            <li><a href="./"><i class='bi bi-speedometer2'></i>Dashboard</a></li>
            <li><a href="news.php"><i class='bi bi-newspaper'></i>News</a></li>
            <li class="active"><a href="visit.php"><i class='bi bi-eye-fill'></i>Visits</a></li>

            <!-- <li><a href="#"><i class='bi bi-gear'></i>Settings</a></li> -->
        </ul>
        <ul class="side-menu">
            <li>
                <a href="php/logout.php" class="logout">
                    <i class='bi bi-door-open'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bi bi-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>

            <a href="#" class="profile">
                <img src="../assets/img/1.png">
            </a>
        </nav>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Site visits</h1>

                </div>
                <a href="?reset" onclick="return confirm('Are you sure you want to delete all site visits?\nThis operation is irreversible!');" class="report">
                    <i class='bi bi-arrow-repeat'></i>
                    <span>Reset</span>
                </a>
            </div>

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bi'></i>
                        <h3>All visitors</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Device</th>
                                <th>Browser</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $fetch = mysqli_query($con, "SELECT * FROM visits");
                            if (mysqli_num_rows($fetch) > 0) {
                                $x = 0;
                                while ($row = mysqli_fetch_array($fetch)) {
                            ?>
                                    <tr>
                                        <td><?php echo ++$x; ?></td>
                                        <td><?php echo $row['device']; ?></td>
                                        <td><?php echo $row['browser']; ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='6' align='center'>No visitors</td></tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </main>

    </div>

    <div class="modal-container" style="display: none;">
        <!-- <div class="modal-container"> -->
        <div class="modal">

        </div>
    </div>

    <script src="index.js"></script>
    <script src="view.js"></script>
    <script>
        function form_display(cont, id) {
            modal_container.style.display = "";
            modal.innerHTML = '<div class="loading"></div>';
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                const res = this.response;
                modal.innerHTML = res;
            }
            xhttp.open('GET', `php/op.php?cont=${cont}&id=${id}`);
            xhttp.send();
        }

        function upd(event) {
            console.log("mellw");
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(event) {
                var src = event.target.result;
                document.getElementById('profilePreview').src = src;
            }

            reader.readAsDataURL(file);
        };
    </script>
</body>

</html>
<?php
if (isset($_GET['reset'])) {
    $del = mysqli_query($con, "TRUNCATE visits");
    if ($del) {
        echo "<script>window.location.assign('visit.php');</script>";
    }
}
?>