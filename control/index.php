<?php
include "php/include.php";
session_start();
if ($_SESSION['id']) {
?>

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
        <div class=" sidebar">
            <a href="#" class="logo">
                <i class='bi bi-code'></i>
                <div class="logo-name"><span>ESSA</span>News</div>
            </a>
            <ul class="side-menu">
                <li class="active"><a href="#"><i class='bi bi-speedometer2'></i>Dashboard</a></li>
                <li><a href="news.php"><i class='bi bi-newspaper'></i>News</a></li>
                <li><a href="visit.php"><i class='bi bi-eye-fill'></i>Visits</a></li>
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
                        <h1>Dashboard</h1>

                    </div>
                    <a href="report.php" class="report">
                        <!-- <i class='bi bi-download'></i> -->
                        <span>Download Report</span>
                    </a>
                </div>

                <!-- Insights -->
                <ul class="insights">
                    <li>
                        <i class='bi bi-receipt-cutoff'></i>
                        <span class="info">
                            <h3>
                                <?php
                                $stories = mysqli_query($con, "SELECT * FROM english");
                                echo mysqli_num_rows($stories);
                                ?>
                            </h3>
                            <p>Stories</p>
                        </span>
                    </li>
                    <li><i class='bi bi-eye'></i>
                        <span class="info">
                            <h3>
                                <?php
                                $visits = mysqli_query($con, "SELECT * FROM visits");
                                echo mysqli_num_rows($visits);
                                ?>
                            </h3>
                            <p>Site Visit</p>
                        </span>
                    </li>
                    <li><i class='bi bi-hand-thumbs-up'></i>
                        <span class="info">
                            <h3>
                                <?php
                                $likes = mysqli_query($con, "SELECT SUM(likes) FROM english");
                                $likes = mysqli_fetch_assoc($likes);
                                echo $likes['SUM(likes)'];
                                ?>
                            </h3>
                            <p>Likes</p>
                        </span>
                    </li>
                    <li><i class='bi bi-currency-dollar'></i>
                        <span class="info">
                            <h3>
                                <?php
                                $views = mysqli_query($con, "SELECT SUM(views) FROM english");
                                $views = mysqli_fetch_assoc($views);
                                echo $views['SUM(views)'] * $likes['SUM(likes)'] * mysqli_num_rows($visits);
                                ?> RWF
                            </h3>
                            <p>Estimated Income</p>
                        </span>
                    </li>
                </ul>
                <!-- End of Insights -->

                <div class="bottom-data">
                    <div class="orders">
                        <div class="header">
                            <i class='bi bi-receipt-cutoff'></i>
                            <h3>Recent Stories</h3>
                            <i class='bi bi-filter'></i>
                            <i class='bi bi-search'></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Views</th>
                                    <th>Likes</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $fetch = mysqli_query($con, "SELECT * FROM english ORDER BY news_date DESC limit 3");

                                if (mysqli_num_rows($fetch) > 0) {
                                    while ($row = mysqli_fetch_array($fetch)) {
                                        if ($row['archive'] != "1") {
                                ?>
                                            <tr onclick="display_news(<?php echo $row['id']; ?>)">
                                                <td><img src="images/<?php echo $row['image']; ?>" alt="News-image"></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['subject']; ?></td>
                                                <td><?php echo $row['views']; ?></td>
                                                <td><?php echo $row['likes']; ?></td>
                                                <td>
                                                    <?php
                                                    $date = explode(" ", $row['news_date']);
                                                    echo $date[0];
                                                    ?>
                                                </td>
                                            </tr>
                                <?php }
                                    }
                                } else {
                                    echo "<tr><td colspan='6' align='center'>Empty Story base</td></tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Reminders -->
                    <div class="reminders">
                        <div class="header">
                            <h3>Feedbacks</h3>
                            <i class='bi bi-filter'></i>
                        </div>
                        <ul class="task-list">

                            <?php
                            $fetch = mysqli_query($con, "SELECT * FROM feedback ORDER BY added_date DESC");
                            while ($row = mysqli_fetch_array($fetch)) {
                            ?>
                                <li class="completed">
                                    <div class="task-title">
                                        <i class='bi'></i>
                                        <div>
                                            <p><b><?php echo $row['name'] ?></b></p>
                                            <p><?php echo $row['feedback'] ?> <br><i class="bi-star-fill"></i>: <?php echo $row['rating']; ?></p>
                                        </div>
                                    </div>
                                    <!-- <i class='bi bi-three-dots-vertical'></i> -->
                                </li>
                            <?php } ?>


                        </ul>
                    </div>

                    <!-- End of Reminders-->

                </div>

            </main>

        </div>

        <div class="modal-container" style="display: none;">
            <div class="modal"></div>
        </div>

        <script src="index.js"></script>
        <script src="view.js"></script>
    </body>

    </html>
<?php
} else {
    echo "<Script>window.location.assign('login.php');</script>";
}
?>