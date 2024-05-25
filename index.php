<?php
include 'php/include.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/vendor/icons/bootstrap-icons.css">
    <link rel="icon" href="assets/img/3.png">


    <!-- SEO -->
    <meta name="description" content="Offering the best quality news from ESSA Nyarugunga. Enroll with us with this minimal user friendly design and never miss Essa Nyarugunga Updates" />
    <meta name="keywords" content="essa, essa nyarugunga, ESSA, Essa, Essa Nyarugunga, ESSA Nyarugunga, ESSA NYARUGUNGA, essa news, ESSA NEWS, Essa news, Essa News, News Essa, Essa nyarugunga news, essa updates" />
    <meta name="author" content="Tuyisenge Innocent" />


    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="Essa News" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="http://essanews.rf.gd" />
    <meta property="og:site_name" content="Essa News" />
    <meta property="og:description" content="Offering the best quality news from ESSA Nyarugunga. Enroll with us with this minimal user friendly design and never miss Essa Nyarugunga Updates" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <!-- SEO -->


</head>

<body>
    <section class="body-container">

        <section class="left-container">
            <div class="profile"><img src="assets/img/1.png" alt="User-profile"></div>

            <div class="navs">

                <a href="./" class="nav-link">
                    <i class="bi bi-clipboard2-data"></i>
                    <p>Trending</p>
                </a>

                <a href="./?cont=1" class="nav-link">
                    <i class="bi bi-music-note-beamed"></i>
                    <p>Entertainment</p>
                </a>

                <a href="./?cont=2" class="nav-link">
                    <i class="bi bi-people"></i>
                    <p>Social</p>
                </a>

                <a href="./?cont=3" class="nav-link">
                    <i class="bi bi-book"></i>
                    <p>Education</p>
                </a>

                <a href="./?cont=4" class="nav-link">
                    <i class="bi bi-dribbble"></i>
                    <p>Sport</p>
                </a>

            </div>

            <!-- <div class="bottom-nav">
                <button class="login">Login</button>
                <button class="signup">Sign Up</button>
            </div> -->

        </section>

        <section class="main-container">
            <div class="top-content">
                <div class="resp">
                    <a href="javascript:void(0)" class="nav-btn"><i class="bi-justify"></i></a>
                </div>
                <h3 class="heading">ESSA News</h3>
                <p class="subheading">
                    <?php
                    if (isset($_GET['cont'])) {
                        $cont = $_GET['cont'];

                        if ($cont == 1) {
                            $cont = "Entertainment";
                        } else if ($cont == 2) {
                            $cont = "Social";
                        } else if ($cont == 3) {
                            $cont = "Education";
                        } else if ($cont == 4) {
                            $cont = "Sport";
                        } else {
                            $cont = "Social";
                        }
                    } else {
                        $cont = "Trending";
                    }
                    echo $cont . " news";
                    ?>
                </p>
            </div>

            <div class="news-container">

                <?php
                if (isset($_GET['cont'])) {
                    $cont = $_GET['cont'];

                    if ($cont == 1) {
                        $cont = "Entertainment";
                    } else if ($cont == 2) {
                        $cont = "Social";
                    } else if ($cont == 3) {
                        $cont = "Education";
                    } else if ($cont == 4) {
                        $cont = "Sport";
                    } else {
                        $cont = "Social";
                    }
                    $fetch = mysqli_query($con, "SELECT * FROM english WHERE subject='{$cont}' AND archive!='1' ORDER BY news_date DESC");
                } else {
                    $fetch = mysqli_query($con, "SELECT * FROM english WHERE archive!='1' ORDER BY news_date DESC");
                }

                if (mysqli_num_rows($fetch) > 0) {
                    while ($row = mysqli_fetch_assoc($fetch)) {
                        $id = $row['id'];
                ?>
                        <div class="news-card">
                            <div class="news-img" onclick="fetch_news(<?php echo $id ?>);"><img src="control/images/<?php echo $row['image']; ?>" alt="news-img"></div>
                            <div class="news-summary">
                                <div class="title">
                                    <h4 class="news-title" onclick="fetch_news(<?php echo $id ?>);"><?php echo $row['title']; ?></h4>
                                    <button class="save-btn" onclick="like_news(this, <?php echo $id; ?>)"><i class="bi-hand-thumbs-up"></i></button>
                                </div>

                                <div class="summary" onclick="fetch_news(<?php echo $id ?>);">"<?php echo substr($row['Full_news'], 0, 90); ?>...</div>

                                <div class="bottom-content" onclick="fetch_news(<?php echo $id ?>);">
                                    <p class="category"><?php echo $row['subject']; ?></p>
                                    <p><i class="bi-hand-thumbs-up-fill"></i> <span id="likes"><?php echo $row['likes']; ?></span></p>
                                    <p class="date"><?php echo $row['news_date']; ?></p>
                                </div>

                            </div>
                        </div>

                    <?php
                    }
                } else {
                    ?>

                    <p style="font-size: 29px;font-weight: 800;height: 100%;display: flex;align-items: center;justify-content: center;opacity: 0.6;">No News available at this moment</p>

                <?php } ?>

            </div>
        </section>

        <section class="right-container">
            <div class="resp"><a href="javascript:void(0)" id="news-close" style="font-size: 30px;"><i class="bi-x-circle"></i></a></div>
            <div class="card">
                <div class="empty">
                    <p>Select a story..</p>
                </div>
            </div>
        </section>

    </section>
    <div class="modal-container" style="display:none;">
        <div class="modal">
            <h3>FeedBack</h3>
            <form action="php/feedback.php" method="POST" onsubmit="document.querySelector('.modal-container').style.display='none';">
                <div class="input-container">
                    <label>Names</label>
                    <input type="text" name="name">
                </div>
                <div class="input-container">
                    <label>Ratings(<b><span class="rate">0</span></b>/5)</label>
                    <input type="range" name="rating" value="0" min='0' max="5" onchange="document.querySelector('.rate').innerText=this.value;">
                </div>
                <div class="input-container">
                    <label>What was your experience</label>
                    <textarea name="feedback"></textarea>
                </div>
                <input type="submit" value="Send" name="submit">
            </form>
        </div>
    </div>
    <?php
    if (!isset($_GET['cont'])) {
    ?>
        <div class="loading-section">
            <div class="loading-container">
                <div class="loading"></div>
            </div>
            <p>Please Wait...</p>
        </div>
    <?php } ?>
    <script src="assets/js/main.js"></script>
    <script>
        // modal scripts
        let modal_container = document.querySelector('.modal-container');
        let modal = document.querySelector('.modal');

        modal_container.onclick = function(e) {
            if (e.target.classList.contains('modal-container')) {
                modal_container.style.display = 'none';
            }
        }

        localStorage.setItem('rated', false);
        if (localStorage.getItem('rated')) {
            var feedback = setTimeout(() => {
                localStorage.setItem('rated', true)
                modal_container.style.display = 'flex';
            }, 60000);
        } else {
            localStorage.setItem('rated', false);
        }
        document.body.onload = function() {

            let url = window.location.href;
            let cont = url.split("?");
            if (cont.length == 1) {
                navs[0].classList.add('active');
            } else {
                cont = cont[1];
                cont = cont.split('=');
                cont = cont[1];
                navs[cont].classList.add('active');
            }

            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                console.log(this.response);
            };
            xhttp.open('GET', `php/load.php?device=${navigator.userAgentData.platform}&browser=${navigator.appCodeName}`);
            xhttp.send();
        }
    </script>
</body>

</html>