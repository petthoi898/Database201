<?php
include('header.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/javascript-calendar.css" type="text/css">
</head>

<body>
    
    <div class="content">
        <div class="row">
            <div class="col-md-8">

                <div class="home-banner">
                    <div id="myCarousel" class="carousel slide " data-ride="carousel">

                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner ">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="images/banner-1.jpg" alt="first-slider">

                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/banner-2.jpg" alt="second-slider">

                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/banner-3.jpg" alt="thirds-slider">

                            </div>
                        </div>

                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon " aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>


                </div>

                <div class="descript" style="Margin:20px">
                    <h5>THÔNG TIN VỀ TRANG WEB</h5>
                    <ul>
                        <li>Quý Thầy/Cô thắc mắc về việc sử dụng trang web xin vui lòng liên hệ Tổ kỹ thuật P.ĐT.

                            Email: support@hcmut.edu.vn </li>
                        <li>Quý Thầy/Cô chưa có tài khoản (hoặc quên mật khẩu) nhà trường vui lòng liên hệ Ban quản lý
                            mạng toà nhà A5 để được hỗ trợ.

                            Email: support@hcmut.edu.vn</li>
                        <li>Trên hệ thống trang web, dữ liệu về môn học (bao gồm bài giảng, danh sách sinh viên, kết quả
                            bài tập TN, bài tập lớn...) sẽ được lưu theo từng học kỳ, sang học kỳ mới trang web của môn
                            học trong học kỳ cũ không mất đi. Tuy nhiên trang web cho môn học trong học kỳ mới sẽ là một
                            trang trắng, Quý Thầy/Cô cần đưa bài giảng mới lên cho trang này.</li>

                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Lịch</h5>
                <div class="calendar" style="margin:0">

                    <div class="icalendar">
                        <div class="icalendar__month">
                            <div class="icalendar__prev" onclick="moveDate('prev')">
                                <span>&#10094</span>
                            </div>
                            <div class="icalendar__current-date">
                                <h2 id="icalendarMonth"></h2>
                                <div>
                                    <div id="icalendarDateStr"></div>
                                </div>

                            </div>
                            <div class="icalendar__next" onclick="moveDate('next')">
                                <span>&#10095</span>
                            </div>
                        </div>
                        <div class="icalendar__week-days">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="icalendar__days"></div>


                        <script src="js/javascript-calendar.js" type="text/javascript"></script>
                    </div>
                </div>
                <script>
                    try {
                        fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function (response) {
                            return true;
                        }).catch(function (e) {
                            var carbonScript = document.createElement("script");
                            carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
                            carbonScript.id = "_carbonads_js";
                            document.getElementById("carbon-block").appendChild(carbonScript);
                        });
                    } catch (error) {
                        console.log(error);
                    }
                </script>
                <script type="text/javascript">

                    var _gaq = _gaq || [];
                    _gaq.push(['_setAccount', 'UA-36251023-1']);
                    _gaq.push(['_setDomainName', 'jqueryscript.net']);
                    _gaq.push(['_trackPageview']);

                    (function () {
                        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                    })();

                </script>
            </div>
        </div>

    </div>
    <?php
    include('footer.php');
    ?>
</body>

</html>