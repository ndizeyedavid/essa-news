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
            <li class="active"><a href="#"><i class='bi bi-newspaper'></i>News</a></li>
            <li><a href="#"><i class='bi bi-gear'></i>Settings</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
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
                    <h1>News Center</h1>

                </div>
                <a href="javascript:void(0)" onclick="form_display()" class="report">
                    <i class='bi bi-plus-circle'></i>
                    <span>New Story</span>
                </a>
            </div>

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bi'></i>
                        <h3>All Stories</h3>
                        <?php
                        if (isset($_GET['sort'])) {
                            if ($_GET['sort'] == 'desc') {
                        ?>
                                <i class='bi bi-filter' title='sort' onclick="window.location.href='?sort=asc'"></i>
                            <?php } else { ?>
                                <i class='bi bi-filter' style="rotate: 180deg;" title='sort' onclick="window.location.href='?sort=desc'"></i>
                            <?php }
                        } else { ?>
                            <i class='bi bi-filter' title='sort' onclick="window.location.href='?sort=asc'"></i>
                        <?php } ?>
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
                                <th>Update</th>
                                <th>Archive</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $fetch = mysqli_query($con, "SELECT * FROM english ORDER BY news_date DESC");
                            if (isset($_GET['sort'])) {
                                $sort = strtoupper($_GET['sort']);
                                $fetch = mysqli_query($con, "SELECT * FROM english ORDER BY title $sort");
                            }

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
                                            <td><a href="php/update.php?id=<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                            <td><a href="php/archive.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Notice!\n\nThis operation will make the story not visible for the visitors, Do you want to continue?')"><i class="bi bi-archive"></i></a></td>
                                        </tr>
                            <?php }
                                }
                            } else {
                                echo "<tr><td colspan='6' align='center'>Empty Story base</td></tr>";
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
            <h2>New Story</h2>
            <form action="php/new_story.php" method="POST" enctype="multipart/form-data">
                <div class="input-container">
                    <center>
                        <img src="images/profile-1.jpg" alt="dummy" class="preview" id="profilePreview">
                        <br>
                        <button type="button" onclick="document.querySelector('#fileUp').click()">Upload</button>
                    </center>
                    <input type="file" name="img" id="fileUp" hidden>
                </div>
                <div class="comb-2">
                    <div class="input-container">
                        <label>Title</label>
                        <input type="text" name="title">
                    </div>
                    <div class="input-container">
                        <label>Category</label>
                        <select name="category">
                            <option value="Social">Social</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Sport">Sport</option>
                            <option value="Education">Education</option>
                        </select>
                    </div>
                </div>
                <div class="input-container"><label>Express Your mind: </label><textarea name="story"></textarea></div>

                <input type="submit" value="Post" name="submit">
            </form>
        </div>
    </div>

    <script src="index.js"></script>
    <script src="view.js"></script>
    <script>
        function form_display() {
            modal_container.style.display = "";
        }
        document.getElementById("fileUp").addEventListener("change", function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(event) {
                var src = event.target.result;
                document.getElementById('profilePreview').src = src;
            }

            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>