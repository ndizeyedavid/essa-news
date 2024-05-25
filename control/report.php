<?php include "php/include.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dash board</title>
    <link rel="stylesheet" href="icons/bootstrap-icons.css">
</head>

<body>

    <!-- Main Content -->
    <div class="content" style="left:0;width:100%">
        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Report (<?php echo date("d/m/Y"); ?>)</h1>

                </div>
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
        </main>

    </div>

    <div class="modal-container" style="display: none;">
        <div class="modal"></div>
    </div>

    <script src="index.js"></script>
    <script>
        print();
        setTimeout(window.location.assign('./'), 100);
    </script>
</body>

</html>