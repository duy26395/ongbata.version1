<?php

include '../process/Post.php';
include '../process/Connect.php';

//use session get id userlogin
$userid = '1';

$sql = "SELECT * FROM members m
left join post p on m.ID = p.membersid
left join gallery g on p.ID = g.postID
where m.ID = '{$userid}'";
$result = $connect->query($sql);
if (!empty($result) && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $imgavatar = $row['url'];
        $birthplace = $row['birthplace'];
        $permanentaddress = $row['paddress'];
        $maritalstatus = $row['maritalstatus'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $gender = $row['gender'];
        $birthday = $row['birthday'];
        $birthmonth = $row['birthmonth'];
        $birthyear = $row['birthyear'];
        $longitude = $row['longitude'];
        $latitude = $row['latitude'];
    }
}
 $location = $longitude .",". $latitude;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <link rel="icon" href="1419255.png" type="image/png" sizes="20x20">
    <title>Ông bà ta Profile</title>
    <link rel="stylesheet" href="../css/profile-ongbata.css" type="text/css">
    <link rel="stylesheet" href="../css/profile_ongbata_reponsive.css" type="text/css">
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.css" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/thu_vien_video.css" type="text/css">

    <link rel="stylesheet" href="../mediaelement-mediaelement-3b02c78/build/mediaelementplayer.css" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700">
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet" />

    <!-- Mapbox GL JS -->
    <!-- Geocoder plugin -->
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
        type="text/css" />
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet" />
    <!-- Geocoder plugin -->

    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
        type="text/css" />





    <!-- <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.css"
        integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="../lib/css/emoji.css" rel="stylesheet">

    <script type='text/javascript' src="../javascript/jquery.js"></script>
    <script type="text/javascript" src="../javascript/crud_post.js"></script>



</head>
<script type="text/javascript">
var idedit;
var fileimgpost;
var filename;
var filedata;
var select_id;
var pagereload = 1;
var fi;

function reload() {
    $.ajax({
        url: "../process/Post.php",
        type: "GET",
        data: {
            page: pagereload,
            method: 'loaddata'
        },
        cache: false,
        success: function(data) {
            $(".add_add9").addClass("rounded-circle  border border-3 border-success");
            $(".add_add9").parent().addClass("bg-light bg-gradient pd_15 d-flex justify-content-center");
            $('#list_posts').prepend(data);
            $('.anh_fullscren').click(function() {
                toggleFullscreen(this);
            });


            $.getScript(
                'https://s3.ap-southeast-1.amazonaws.com/labtoidayhoc/test_example/mediaelement-and-player.js',
                function() {
                    console.debug('Script loaded.');


                });
            $.getScript(
                'https://s3.ap-southeast-1.amazonaws.com/labtoidayhoc/test_example/thu_vien_video.js',
                function() {
                    console.debug('Script loaded.');

                });
            $(".check_anh8,.check_video7,.check_video9,.check_video10").remove();


        }
    });
}
reload();

function checkfileimg(e) {
    var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    for (var i = 0; i < e.files.length; i++) {
        if ($.inArray(e.files.item(i).name.split('.').pop().toLowerCase(), fileExtension) ==
            '-1') {
            return false;

        } else {
            return true;
        }
    }
}
//view data
//js pagenation
window.onscroll = function(ev) {
    if (Math.ceil(window.innerHeight + window.pageYOffset) >= document.body.offsetHeight - 1) {
        pagereload = pagereload + 1

        $.ajax({
            url: "../process/Post.php",
            type: "GET",
            data: {
                page: pagereload,
                method: 'loaddata'
            },
            cache: false,
            beforeSend: function() {
                $("#wait").css("display", "block");
            },
            success: function(data) {

                if (data) {

                    $(document).ready(function() {
                        $('#list_posts').append(data);
                        $(".add_add9").addClass("rounded-circle border border-3 border-white ");
                        $(".add_add9").parent().addClass(
                            "bg-light bg-gradient pd_15 d-flex justify-content-center");
                        $('.anh_fullscren').click(function() {
                            toggleFullscreen(this);
                        });

                        loadlink();

                        $.getScript(
                            'https://s3.ap-southeast-1.amazonaws.com/labtoidayhoc/test_example/mediaelement-and-player.js',
                            function() {
                                console.debug('Script loaded.');

                            });
                        $.getScript(
                            'https://s3.ap-southeast-1.amazonaws.com/labtoidayhoc/test_example/thu_vien_video.js',
                            function() {
                                console.debug('Script loaded.');

                            });
                        // $.getScript('../javascript/jquery.js', function() {
                        // console.debug('Script loaded.');

                        // });
                        Loadavatarimg();
                        $(".check_anh8,.check_video7,.check_video9,.check_video10").remove();
                        loadlibrary();
                        loadlibraryson();
                        $("#wait").css("display", "none");


                    })
                } else {
                    pagereload = pagereload - 1
                }
            }
        });
    }

};
// $(document).ajaxStart(function(){
//         $("#wait").css("display", "block");
//         });
// $(document).ajaxComplete(function(){
//             $("#wait").css("display", "none");
//         });
// $("#list_posts").load("../process/Post.php");
$(document).ready(function() {
    // check file type img
    $("#uploadFileimg").change(function() {
        fi = document.getElementById('uploadFileimg');
        filedata = new FormData();
        if (checkfileimg(fi)) {
            for (var i = 0; i < fi.files.length; i++) {
                filedata.append("files[]", fi.files.item(i))
            };
        } else {
            alert("Only formats are allowed : " + fileExtension.join(', '));
            $("#uploadFileimg").val('');
        }
    })

})
</script>

<body>



    <header class="container">
        <div class="bacground_profile-dad">
            <div class="bacground_profile cursor_p gallery_bia">
            </div>
            <button class="btn btn-success d-flex align-items-center bt_header_bk  ">
                <form class="fileUpload fileUpload_1 d-flex align-items-center " method='POST'
                    enctype="multipart/form-data">
                    <input type="file" class="upload" name="multipleFile3[]" id="multipleFile3" required="">
                    <span class="material-icons text-white">
                        photo_camera
                    </span>
                    <span class="text-white">
                        Thêm ảnh bìa
                    </span>
                </form>

            </button>
        </div>
        <script>
        function toggleFullscreen(elem) {
            elem = elem || document.documentElement;
            if (!document.fullscreenElement && !document.mozFullScreenElement &&
                !document.webkitFullscreenElement && !document.msFullscreenElement) {
                // if (elem.requestFullscreen) {
                //     elem.requestFullscreen();
                // }
                // else if (elem.msRequestFullscreen) {
                //     elem.msRequestFullscreen();}
                if (elem.mozRequestFullScreen) {
                    elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) {
                    elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                }
            }
        }

        // document.getElementById('btnFullscreen').addEventListener('click', function() {
        //   toggleFullscreen();
        // });

        // document.getElementById('anh_bia').addEventListener('click', function() {
        //     toggleFullscreen(this);
        // });
        </script>
        <center class="position-relative">
            <div class="avatar_dad   start-50 translate-middle">
                <div class="avatar_son position-relative hover01">
                    <div class="avtar_img figure rounded-circle border gallery_dd_big">

                    </div>
                    <button
                        class="btn btn-secondary d-flex align-items-center rounded-circle position-absolute bt_avatar">
                        <form class="fileUpload fileUpload_1 d-flex align-items-center" method='POST'
                            enctype="multipart/form-data">
                            <input type="file" class="upload" type="file" name="multipleFile2" id="multipleFile2">
                            <span class="material-icons text-white">
                                photo_camera
                            </span>
                        </form>

                    </button>
                </div>
            </div>
            <h1 class="name_profile">
                <?php echo $lastname . " " . $firstname ?>
            </h1>
        </center>
        <script>
        // function toggleFullscreen(elem) {
        //     elem = elem || document.documentElement;
        //     if (!document.fullscreenElement && !document.mozFullScreenElement &&
        //         !document.webkitFullscreenElement && !document.msFullscreenElement) {
        //         if (elem.requestFullscreen) {
        //             elem.requestFullscreen();
        //         } else if (elem.msRequestFullscreen) {
        //             elem.msRequestFullscreen();
        //         } else if (elem.mozRequestFullScreen) {
        //             elem.mozRequestFullScreen();
        //         } else if (elem.webkitRequestFullscreen) {
        //             elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        //         }
        //     } else {
        //         if (document.exitFullscreen) {
        //             document.exitFullscreen();
        //         } else if (document.msExitFullscreen) {
        //             document.msExitFullscreen();
        //         } else if (document.mozCancelFullScreen) {
        //             document.mozCancelFullScreen();
        //         } else if (document.webkitExitFullscreen) {
        //             document.webkitExitFullscreen();
        //         }
        //     }
        // }

        // document.getElementById('btnFullscreen').addEventListener('click', function() {
        //   toggleFullscreen();
        // });
        </script>
    </header>
    <div id="wait" style="display:none;position: fixed;width: 100%;height: 100vh;left: 50%;top: 50%; z-index: 888;"><img
            src='../images/giphy (1).gif' width="150" height="150" /></div>
    <section>


        <div id="container" class="bg-light ">

            <nav class="nav-tab nav-tab_dad shadow-sm bg-white position-sticky top-0 ">


                <div class="container d-flex align-items-center">
                    <div class="bottomMenu hide md-display_none" id="scoll_sh">
                        <a href="" class="">
                            <button class=" btn col d-flex align-items-center rounded-3 ">

                                <div class="avatar avatar-sm rounded-circle gallery_dd_s" id="gallery_bar">

                                </div>
                                <div class="fz_14 pd_5">
                                    <b><?php echo $firstname ?></b>
                                </div>

                            </button>
                        </a>
                    </div>

                    <ul id="scroll_ul" class=" ul_tab  row scroll_ul width_100 md-flex md-pd_0">

                        <li class="li_tab col md-width_30 "><button data-tab="tab-1"
                                class=" button_tab a-hv-text-udl tab_home"><span>Bài viết
                                </span></button></li>
                        <li class="li_tab col md-width_40"><button data-tab="tab-2"
                                class=" button_tab a-hv-text-udl  "><span>Giới thiệu
                                </span>
                            </button></li>
                        <li class="li_tab col-md-4 md-width_30"><button data-tab="tab-3"
                                class=" button_tab a-hv-text-udl tab_3"><span>Ảnh</span></button></li>

                    </ul>
                </div>
                <script>
                // scroll show div
                myID = document.getElementById("scroll_ul");

                var myScrollFunc = function() {
                    var y = window.scrollY;
                    if (y >= 400) {
                        myID.className = "scroll_ul width_90"
                    } else {
                        myID.className = "scroll_ul width_100"
                    }
                };

                window.addEventListener("scroll", myScrollFunc);
                </script>
                <script>
                // scroll show div
                myID = document.getElementById("scoll_sh");

                var myScrollFunc = function() {
                    var y = window.scrollY;
                    if (y >= 400) {
                        myID.className = "bottomMenu show_av"
                    } else {
                        myID.className = "bottomMenu hide"
                    }
                };

                window.addEventListener("scroll", myScrollFunc);
                </script>
            </nav>
            <div class="container ">

                <!-- FIRST SECTION -->
                <div class="content-tab" id="tab-1">
                    <div class="row">
                        <div class="col-md-4 md-mb_20 tab_1_left_dad">
                            <div class="position-sticky top_100 tab_1_left" id="leftcontent_tab">
                                <div class="bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_left-1  ">
                                    <h3 class="fz_20">
                                        <b>Giới thiệu</b>
                                    </h3>
                                    <div>

                                        <?php
$query = "SELECT * FROM placeslived  where membersid = '{$userid}' and type='Quê quán'  ORDER BY DateStart DESC LIMIT 1;";

$result = mysqli_query($connect, $query);

while ($row = mysqli_fetch_array($result)) {?>

                                        <div class="d-flex  align-items-center mb_10">
                                            <span class="material-icons">
                                                cottage
                                            </span>
                                            <span>
                                                Đến từ
                                            </span>
                                            <a href="#" class="">
                                                <b> <span> <?php echo $row['noi_song'] ?></span></b>
                                            </a>
                                        </div>

                                        <?php }
?>
                                        <script>console.log("1")</script>

                                        <?php
$query = "SELECT * FROM placeslived  where membersid = '{$userid}' and type='Tỉnh-Thành phố hiện tại' or type='Huyện/Quận hiện tại' or type='Xã-Phường hiện tại' ORDER BY DateStart DESC LIMIT 1;";

$result = mysqli_query($connect, $query);

while ($row = mysqli_fetch_array($result)) {?>

                                        <div class="d-flex  align-items-center mb_10">
                                            <span class="material-icons">
                                                location_on
                                            </span>
                                            <span>
                                                Sống tại
                                            </span>
                                            <a href="#" class="">
                                                <b> <span><?php echo $row['Place']; ?></span></b>
                                            </a>
                                        </div>
                                        <?php }?>
                                        <script>console.log("2")</script>
                                        <div class="d-flex  align-items-center mb_10">
                                            <span class="material-icons">
                                                favorite
                                            </span>
                                            <span>
                                                <?=$maritalstatus?>
                                            </span>

                                        </div>
                                        <script>console.log("3")</script>
                                    </div>
                                    <!-- ban do da dinh vi -->
                                    <div class="d-grid ">
                                        <center>
                                            <h3 class="fz_20">
                                                <b> Địa điểm đã định vị của
                                                    <?php echo $lastname . " " . $firstname ?></b>
                                            </h3>
                                        </center>
                                        <div class="position-relative map_dad">
                                            <div id="map1" class="rounded-3"></div>
                                        </div>
                                        <!-- <div id="map_2" class="rounded-3"></div> -->
                                        <!-- cua google map -->
                                    </div>
                                </div>
                                <div class="bg-white shadow-sm border border_raidus_07  pd_10 mb_20  section_left-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3>
                                            <span class="fz_20 "><b>Ảnh</b></span>
                                        </h3>
                                        <div class="nav-tab ">
                                            <div class="ul_tab ">
                                                <div class="li_tab ">
                                                    <a href="#" class="button_tab fz_17 a_hv_bg tab_3" data-tab="tab-3">
                                                        <span>Xem tất cả</span>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row pd_15" id="gallery_border">
                                        <?php
$query = "SELECT *, @rank :=  @rank + 1 AS rank FROM gallery g left join post p on p.ID = g.postid, (SELECT  @rank := 0) r where membersid = '{$userid}' ORDER BY  g.id DESC LIMIT 9;";

$result = mysqli_query($connect, $query);

while ($row = mysqli_fetch_array($result)) {?>

                                        <div class="col-4 pd_0" data-bs-target="#carousetab1"
                                            data-bs-slide-to="<?php echo $row['rank'] - 1; ?>" aria-current="true"
                                            aria-label="Slide <?php echo $row['rank'] ?>">
                                            <div class="pd_2" data-bs-toggle="modal"
                                                data-bs-target="#modal_anh_nho_tab1">
                                                <img src="<?php echo $path; ?><?php echo $row['url'] ?>" alt=""
                                                    class="<?php echo 'border_raidus', $row['rank']; ?>"
                                                    style="height: 105px;">
                                            </div>

                                        </div>

                                        <?php }?>
                                        <script>console.log("4")</script>
                                    </div>
                                </div>
                                <div
                                    class="bg-white shadow-sm border border_raidus_07  pd_10 mb_20  section_left-3 md-display_none">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3>
                                            <span class="fz_20 "><b>Sự kiện trong đời</b></span>
                                        </h3>
                                        <div class="nav-tab ">
                                            <div class="ul_tab ">
                                                <div class="li_tab ">
                                                    <a href="#" class="button_tab fz_17 a_hv_bg " data-tab="tab-2">
                                                        <span>Xem tất cả</span>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row pd_10 section_left-3_body">


                                        <?php
$query = "SELECT   * ,from_unixtime(p.DateTime) as EVDateTime, @rank :=  @rank + 1 AS rank_sk FROM lifeevents p, (SELECT  @rank := 0) r
                                            where membersid = '{$userid}'
                                            ORDER BY DateTime DESC LIMIT 2; ";

$result = mysqli_query($connect, $query);

while ($row = mysqli_fetch_array($result)) {?>

                                        <div
                                            class="col-md-6  pd_0  border section_left-3_body_hv  <?php echo 'border_raidus_sk', $row['rank_sk']; ?>">
                                            <a href="" class="text-center">
                                                <div>
                                                    <img src="../images/event.gif" alt="" class="">
                                                </div>
                                                <div class="pd_5 position-relative">
                                                    <div class="position-absolute section_left-3_body_icon">
                                                        <span class="material-icons rounded-circle bg-primary pd_2">
                                                            emoji_flags
                                                        </span>
                                                    </div>
                                                    <h3 class="fz_16 mt-2">
                                                        <b><span> <?php echo $row['NameEvenet'] ?></span></b>
                                                    </h3>
                                                    <span class="fz_14">
                                                        <?php echo $row['EVDateTime'] ?>
                                                    </span>
                                                </div>

                                            </a>
                                        </div>

                                        <?php }?>
                                        <script>console.log("5")</script>
                                    </div>
                                </div>

                                <div class="footer md-display_none">
                                    <ul class="d-flex flex-wrap">
                                        <li>
                                            <a href="">
                                                <span>Quyền riêng tư </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span>Điều khoản </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span>Quảng cáo </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span>Lựa chọn quảng cáo </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span> Cookie </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span>Xem thêm</span>
                                            </a>
                                        </li>
                                        <li>

                                            <span>Facebook © 2021</span>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_right-1">
                                <div class="row section_right_open_form-1 d-flex align-items-center">
                                    <div class="col-md-1 md-width_20 gallery_dd_s">

                                    </div>
                                    <button
                                        class="btn col-11 bg-light text-dark rounded-pill d-flex justify-content-start section_right-1_button1 bt_them_bai_viet"
                                        data-bs-toggle="modal" data-bs-target="#them_bai_viet">
                                        Bạn đang nghĩ gì?
                                    </button>
                                </div>
                                <div class="row md-flex">
                                    <div class="col-md-4 d-flex justify-content-center align-items-center md-width_35">
                                        <button class="btn  d-flex justify-content-center align-items-center fz_14">
                                            <div class="fileUpload fileUpload_1 d-flex align-items-center">
                                                <input type="file" class="upload up_file" data-bs-toggle="modal">
                                                <span class="material-icons text-danger">
                                                    video_call
                                                </span>
                                            </div>
                                            <span>
                                                Video
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-center align-items-center md-width_30">
                                        <button class="btn d-flex justify-content-center align-items-center fz_14">

                                            <div class="fileUpload fileUpload_1 d-flex align-items-center">
                                                <input type="file" class="upload up_file" data-bs-toggle="modal">
                                                <span class="material-icons text-success">
                                                    collections
                                                </span>
                                            </div>
                                            <span>
                                                Ảnh
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-center align-items-center md-width_35">
                                        <button class="btn d-flex justify-content-center align-items-center fz_14"
                                            onclick="getLocation()">
                                            <span class="material-icons text-info">
                                                assistant_photo
                                            </span>
                                            <span>
                                                Định vị
                                            </span>

                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_right-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3>
                                        <a href="#" class="fz_20 a_hv_black"><b>Bài viết</b></a>
                                    </h3>
                                    <button class="btn btn-light d-flex justify-content-between align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#bo_loc">
                                        <span class="material-icons">
                                            tune
                                        </span>
                                        <span>
                                            Bộ lọc
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="posts" id="list_posts">
                            </div>
                        </div>
                    </div>
                </div>
                <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
                <!-- Second SECTION -->
                <div class="content-tab" id="tab-2">

                    <div class="row bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_tab_2-1 md-mg_0 ">
                        <div class="  col-md-4 d-grid md-pb_10 md-mb_20 section_tab_2-1_son">
                            <h3>
                                <a href="#" class="fz_20 a_hv_black"><b>Giới thiệu</b></a>
                            </h3>
                            <ul class="nav nav-tabs  nav-tabs_section2 d-grid border-0 nav_control1">
                                <li class=""><a data-bs-toggle="tab" href="#home"
                                        class=" active fz_14  fw-bolder pd_5  rounded-3">Tổng quan</a></li>
                                <li class=""><a data-bs-toggle="tab" href="#menu1"
                                        class="fz_14  fw-bolder pd_5 rounded-3">Công việc và học vấn</a>
                                </li>
                                <li class=""><a data-bs-toggle="tab" href="#menu2"
                                        class="fz_14  fw-bolder pd_5 rounded-3">Nơi từng sống</a></li>
                                <li class=""><a data-bs-toggle="tab" href="#menu3"
                                        class="fz_14  fw-bolder pd_5 rounded-3">Thông tin liên hệ và cơ
                                        bản</a></li>
                                <li class=""><a data-bs-toggle="tab" href="#menu4"
                                        class="fz_14  fw-bolder pd_5 rounded-3">Chi tiết về bạn</a></li>
                                <li class=""><a data-bs-toggle="tab" href="#menu5"
                                        class="fz_14  fw-bolder pd_5 rounded-3">Sự kiện trong đời</a></li>
                            </ul>
                        </div>


                        <div class="tab-content tab-content_section2 col-md-8">
                            <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
                            <div id="home" class="tab-pane fade in active show">


                                <?php
$query = "SELECT * FROM work where membersid = '{$userid}' ORDER BY id DESC  LIMIT 1 ";

$result = mysqli_query($connect, $query);

while ($row = mysqli_fetch_array($result)) {?>

                                <div class="d-flex justify-content-between align-items-center mb_20">
                                    <div class=" d-flex justify-content-between align-items-start">

                                        <span class="material-icons text-black-50 pd_2">
                                            work
                                        </span>

                                        <div class="d-grid pd_2">
                                            <div>
                                                <?php echo $row['Workplace'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php }?>
                                <script>console.log("6")</script>
                                <?php
$query = "SELECT   * FROM placeslived  where membersid = '{$userid}' and type='Tỉnh-Thành phố hiện tại' or type='Huyện/Quận hiện tại' or type='Xã-Phường hiện tại' ORDER BY DateStart DESC  LIMIT 1 ";
$result = mysqli_query($connect, $query);

while ($row = mysqli_fetch_array($result)) {?>

                                <div class="d-flex justify-content-between align-items-center mb_20">
                                    <div class="d-flex justify-content-between align-items-start">

                                        <span class="material-icons text-black-50 pd_2">
                                            cottage
                                        </span>

                                        <div class="pd_2">
                                            <div>Sống tại <a href=""
                                                    class="text_black"><?php echo $row['Place'] ?></a></div>

                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                                <script>console.log("7")</script>
                                <?php
$query = "SELECT   * FROM placeslived where membersid = '{$userid}' and type='Quê quán'  ORDER BY DateStart DESC  LIMIT 1 ";

$result = mysqli_query($connect, $query);

while ($row = mysqli_fetch_array($result)) {?>

                                <div class="d-flex justify-content-between align-items-center mb_20">
                                    <div class="d-flex justify-content-between align-items-start">

                                        <span class="material-icons text-black-50 pd_2">
                                            location_on
                                        </span>

                                        <div class="pd_2">
                                            <div>Đến từ <a href="" class="text_black ">
                                                    <?php echo $row['Place'] ?></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                                <script>console.log("8")</script>
                                <div class="d-flex justify-content-between align-items-center mb_20">
                                    <div class="d-flex justify-content-between align-items-start">

                                        <span class="material-icons text-black-50 pd_2">
                                            favorite
                                        </span>

                                        <div class="pd_2">
                                            <div><?=$maritalstatus?></div>
                                        </div>
                                </div>
                                <script>console.log("9")</script>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div class="">
                                    <h3 class="fz_17"><b><span>Công việc</span></b></h3>
                                    <div class="d-flex text-primary cursor_p clikc_vl" data-bs-toggle="modal" name="add"
                                        id="add" data-bs-target="#them_cong_viec">
                                        <span class="material-icons ">
                                            add_circle_outline
                                        </span>
                                        <span>
                                            Thêm nơi làm việc
                                        </span>
                                    </div>

                                    <div id="display_area_cv">
                                        <?php

$query = "SELECT * FROM work where membersid = '{$userid}' ORDER BY DateStart DESC ";
$result = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($result)) {?>

                                        <div class="d-flex justify-content-between align-items-center delete">

                                            <div class="  d-flex justify-content-between align-items-center"
                                                id="<?php echo $row['id']; ?>">

                                                <div class="avatar-sm ">
                                                    <i class="fas   <?php echo $row['Workplace']; ?>"> </i>
                                                </div>

                                                <div class="">
                                                    <div>
                                                        <?php echo $row['Workplace']; ?>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class=" dropdown-toggle button_dr_afet " type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="true">

                                                    <span class="material-icons text-black-50 cursor_p">
                                                        edit
                                                    </span>
                                                </div>
                                                <ul class="dropdown-menu  z_index_0">
                                                    <li>
                                                        <button
                                                            class="btn d-flex align-items-center fz_12 justify-content-between edit_data "
                                                            name="edit" id="<?php echo $row["id"]; ?>">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                drive_file_rename_outline
                                                            </span>
                                                            <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button
                                                            class="delete delete_jq btn d-flex align-items-center  justify-content-between"
                                                            data-id=<?php echo $row['id']; ?>>
                                                            <span class="material-icons fz_12 text-black-50">
                                                                delete
                                                            </span>
                                                            <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                        </button>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <?php

}?>
<script>console.log("10")</script>

                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <h3 class="fz_17"><b><span>Nơi từng sống</span></b></h3>
                                <div class="d-flex text-primary cursor_p clikc_vl" data-bs-toggle="modal" name="add_2"
                                    id="add_2" data-bs-target="#them_noi_song">
                                    <span class="material-icons ">
                                        add_circle_outline
                                    </span>
                                    <span>
                                        Thêm Thành phố
                                    </span>
                                </div>

                                <div id="display_area_ns">
                                    <?php
$query = "SELECT * FROM placeslived where membersid = '{$userid}' ORDER BY DateStart DESC ";
$result = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($result)) {?>
                                    <div class="d-flex justify-content-between align-items-center ">

                                        <div class="d-flex justify-content-between" id="xoa_2">

                                            <div class="" style="margin-right: 5px;">
                                                <i class="fas <?php echo $row['Type']; ?> "
                                                    style=" font-size: 28px;color: #20c997;"></i>
                                            </div>

                                            <div class="">
                                                <div><a href="" class="text_black"><?php echo $row['Place']; ?></a>
                                                </div>
                                                <span class="fz_12 text-black-50"><?php echo $row['Type']; ?></span>

                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class=" dropdown-toggle button_dr_afet" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="true">

                                                <span class="material-icons text-black-50 cursor_p">
                                                    pending
                                                </span>
                                            </div>
                                            <ul class="dropdown-menu  z_index_0">
                                                <li>
                                                    <button
                                                        class="btn d-flex align-items-center fz_12 justify-content-between edit_data_2"
                                                        id="<?php echo $row["id"]; ?>" data-bs-toggle="modal"
                                                        data-bs-target="#them_noi_song" name="edit_2">
                                                        <span class="material-icons fz_12 text-black-50">
                                                            drive_file_rename_outline
                                                        </span>
                                                        <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button
                                                        class=" delete_2 btn d-flex align-items-center delete_jq justify-content-between"
                                                        data-id=<?php echo $row['id']; ?>>
                                                        <span class="material-icons fz_12 text-black-50">
                                                            delete
                                                        </span>
                                                        <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                    <?php
}?>
<script>console.log("11")</script>
                                </div>
                            </div>
                            <div id="menu3" class="tab-pane fade">
                                <div class="thong-tin-lien-he">
                                    <h3 class="fz_17"><b><span>Thông tin liên hệ</span></b></h3>
                                    <div class="d-flex text-primary cursor_p clikc_vl" data-bs-toggle="modal" id="add_3"
                                        name="add_3" data-bs-target="#them_thong_tin_lien_he">
                                        <span class="material-icons  ">
                                            add_circle_outline
                                        </span>
                                        <span>
                                            Thêm Thông tin liên hệ
                                        </span>
                                    </div>

                                    <link rel="stylesheet"
                                        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                    <div id="display_area_lh">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="d-flex justify-content-between align-items-start">

                                                <div class="" style="margin-right: 5px;">
                                                    <i class=""
                                                        style=" font-size: 28px;color: #20c997;"></i>
                                                </div>

                                                <div class="">
                                                    <div><a href="" class="text_black">
                                                        </a>
                                                    </div>
                                                    <span
                                                        class="fz_12 text-black-50"></span>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">

                                                <div class=" dropdown-toggle button_dr_afet" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="true">

                                                    <span class="material-icons text-black-50 cursor_p">
                                                        drive_file_rename_outline
                                                    </span>
                                                </div>
                                                <ul class="dropdown-menu  z_index_0">
                                                    <li>
                                                        <button
                                                            class="btn d-flex align-items-center fz_12 justify-content-between edit_data_3"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#them_thong_tin_lien_he" name="edit_3"
                                                            id="">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                drive_file_rename_outline
                                                            </span>
                                                            <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button
                                                            class=" delete_3  delete_jq btn d-flex align-items-center  justify-content-between"
                                                            data-id="">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                delete
                                                            </span>
                                                            <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
<script>console.log("12")</script>
                                    </div>

                                </div>
                                <div class="thong_tin_co_ban">
                                    <h3 class="fz_17"><b><span>Thông tin Cơ bản</span></b></h3>
                                    <div class="d-flex text-primary cursor_p clikc_vl" data-bs-toggle="modal" id="add_4"
                                        name="add_4" data-bs-target="#them_thong_tin_co_ban">
                                        <span class="material-icons ">
                                            add_circle_outline
                                        </span>
                                        <span>
                                            Thêm Thông tin Cơ bản
                                        </span>
                                    </div>

                                    <div id="display_area_cb">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="d-flex justify-content-between align-items-start">

                                                <div class="" style="margin-right: 5px;">
                                                    <i class="fa"
                                                        style=" font-size: 28px;color: #20c997;"></i>
                                                </div>

                                                <div class="">
                                                    <div>
                                                        <span class="kiem_tra">
                                                    </div>
                                                    <span class="fz_12 text-black-50 ">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class=" dropdown-toggle button_dr_afet" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="true">

                                                    <span class="material-icons text-black-50 cursor_p">
                                                        drive_file_rename_outline
                                                    </span>
                                                </div>
                                                <ul class="dropdown-menu  z_index_0">
                                                    <li>
                                                        <button
                                                            class="btn d-flex align-items-center fz_12 justify-content-between edit_data_4"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#them_thong_tin_co_ban"
                                                            id="">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                drive_file_rename_outline
                                                            </span>
                                                            <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button
                                                            class=" delete_4 delete_jq btn d-flex align-items-center  justify-content-between">
                                                            <span class="material-icons fz_12 text-black-50"
                                                                data-id="">
                                                                delete
                                                            </span>
                                                            <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
<script>console.log("13")</script>
                                    </div>

                                </div>
                            </div>
                            <div id="menu4" class="tab-pane fade">
                                <div class="">
                                    <h3 class="fz_17"><b><span>Giới thiệu về bạn</span></b></h3>
                                    <div class="d-flex text-primary cursor_p clikc_vl" data-bs-toggle="modal" id="add_5"
                                        name="add_5" data-bs-target="#them_tieu_su">
                                        <span class="material-icons ">
                                            add_circle_outline
                                        </span>
                                        <span>
                                            Thêm tiểu sử về bạn
                                        </span>
                                    </div>

                                    <div id="display_area_ts">
                                        <?php
$query = "SELECT * FROM lifeevents where membersid = '{$userid}' ORDER BY id DESC ";
$result = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($result)) {?>
                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="d-flex justify-content-between align-items-start">

                                                <div class="avatar-sm pd_2">
                                                    <img src="https://www.storyuk.com/themes/story/images/story-logo-horizontal.png"
                                                        alt="" class="rounded-circle">
                                                </div>

                                                <div class="">
                                                    <div>
                                                        <span><?php echo $row['NameEvenet']; ?></span>
                                                    </div>
                                                    <span class="fz_12 text-black-50"><?php echo $row['EventDetail']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class=" dropdown-toggle button_dr_afet" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="true">

                                                    <span class="material-icons text-black-50 cursor_p">
                                                        pending
                                                    </span>
                                                </div>
                                                <ul class="dropdown-menu  z_index_0">
                                                    <li>
                                                        <button id="<?php echo $row['id']; ?>"
                                                            class="btn d-flex align-items-center fz_12 justify-content-between edit_data_5"
                                                            data-bs-toggle="modal" data-bs-target="#them_tieu_su">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                drive_file_rename_outline
                                                            </span>
                                                            <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button data-id="<?php echo $row['id']; ?>"
                                                            class="delete_5 delete_jq btn d-flex align-items-center  justify-content-between">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                delete
                                                            </span>
                                                            <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                        </button>
                                                    </li>



                                                </ul>
                                            </div>
                                        </div>

                                        <?php
}?>
<script>console.log("14")</script>
                                    </div>
                                </div>
                            </div>
                            <div id="menu5" class="tab-pane fade">

                                <h3 class="fz_17"><b><span>Sự kiện trong đời</span></b></h3>
                                <div class="d-flex text-primary cursor_p clikc_vl" data-bs-toggle="modal" id="add_6"
                                    name="add_6" data-bs-target="#them_su_kien">
                                    <span class="material-icons ">
                                        add_circle_outline
                                    </span>
                                    <span>
                                        Thêm sự kiện trong đời
                                    </span>
                                </div>

                                <div id="display_area_sk">
                                    <?php
$query = "SELECT *,from_unixtime(DateTime) as leDateTime FROM lifeevents where membersid = '{$userid}' ORDER BY id DESC ";
$result = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($result)) {?>

                                    <div class="d-grid">
                                        <h3 class="fz_17"><b><span><?php echo $row['leDateTime']; ?></span></b></h3>
                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="d-flex justify-content-between align-items-start">

                                                <div class="avatar-sm ">
                                                    <img src="../images/729130-200.png" alt="" class="rounded-circle">
                                                </div>

                                                <div class="">
                                                    <div>
                                                        <?php echo $row['NameEvenet']; ?>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class=" dropdown-toggle button_dr_afet" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="true">

                                                    <span class="material-icons text-black-50 cursor_p">
                                                        pending
                                                    </span>
                                                </div>
                                                <ul class="dropdown-menu  z_index_0">
                                                    <li>
                                                        <button id="<?php echo $row['id']; ?>"
                                                            class="btn d-flex align-items-center fz_12 justify-content-between edit_data_6"
                                                            data-bs-toggle="modal" data-bs-target="#them_su_kien">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                drive_file_rename_outline
                                                            </span>
                                                            <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button data-id="<?php echo $row['id']; ?>"
                                                            class=" delete_6 delete_jq btn d-flex align-items-center  justify-content-between">
                                                            <span class="material-icons fz_12 text-black-50">
                                                                delete
                                                            </span>
                                                            <b><span class="fz_12"> Xóa sự kiện</span></b>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p>
                                            <span>
                                                <?php echo $row['EventDetail']; ?>
                                            </span>
                                        </p>
                                    </div>
                                    <?php }?>
                                    <script>console.log("15")</script>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- third SECTION -->
                <div class="content-tab" id="tab-3">
                    <div class="bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_right-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>
                                <a href="#" class="fz_20 a_hv_black"><b>Ảnh</b></a>
                            </h3>

                            <div class=" btn btn-light d-flex justify-content-between align-items-center">
                                <form class="fileUpload" method='POST' enctype="multipart/form-data">
                                    <input type="file" class="upload" name="multipleFile_tab3" id="multipleFile_tab3"
                                        required="" multiple />
                                    <span>Thêm ảnh</span>
                                </form>

                            </div>


                        </div>


                        <div class="tab_2 mb_10">
                            <button class="tablinks fz_14 rounded-3 active_2"
                                onclick="openTabson(event, 'Anh_dai_dien')">Ảnh đại diện</button>
                            <button class="tablinks fz_14 rounded-3  fetch_anh"
                                onclick="openTabson(event, 'anh_cua_ban')">Ảnh
                                của bạn</button>
                            <button class="tablinks fz_14 rounded-3 fetch_anh3"
                                onclick="openTabson(event, 'anh_bia_tab')">Ảnh
                                bìa</button>
                        </div>

                        <div id="Anh_dai_dien" class=" firts_display tabcontent_2  pd_10">
                            <div class="row row-cols-lg-5 md-flex" id="gallery_dd_tab3">
                            </div>
                        </div>


                        <div id="anh_cua_ban" class="tabcontent_2  pd_10">
                            <div class="row row-cols-lg-5 md-flex" id="anh_cua_ban_tab3">

                            </div>
                        </div>

                        <div id="anh_bia_tab" class="tabcontent_2  pd_10">
                            <div class="row row-cols-lg-5 md-flex " id="anh_bia_tab3">


                            </div>
                        </div>


                    </div>
                    <div class="bg-white shadow-sm border border_raidus_07 pd_10 mb_20 section_right-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>
                                <a href="#" class="fz_20 a_hv_black"><b>Video</b></a>
                            </h3>

                            <div class=" btn btn-light d-flex justify-content-between align-items-center">
                                <div class="fileUpload">
                                    <input type="file" class="upload" id="multipleVideo" name="multipleVideo[]"
                                        required="" multiple />
                                    <span>Thêm video</span>
                                </div>
                            </div>

                        </div>

                        <div class="row  pd_10 md-flex" id="video" style="height: 300px;">

                        </div>


                    </div>

                </div>

            </div>
            <!-- khu vuc de du lieu modal -->

            <div class="container">
                <!-- khu anh -->
                <div>
                    <!-- tab 1 -->
                    <div class="anh_tu_bai_viet modal fade" id="modal_anh_nho_tab1" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal body -->
                                <div class="modal-body pd_10">
                                    <div id="carousetab1" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner" id="anh_nho_tab1">

                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carousetab1" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carousetab1" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="modal-footer pd_10">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tab 3 -->
                    <div class="anh_tu_bai_viet modal fade" id="myModal1" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal body -->
                                <div class="modal-body pd_10">
                                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner" id="anh_cua_ban_modal">

                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>



                                </div>
                                <div class="modal-footer pd_10">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal anh_dai_dien fade" id="myModal2" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                                <!-- Modal body -->
                                <div class="modal-body pd_10">
                                    <div id="carouselExampleCaptions2" class="carousel slide" data-bs-ride="carousel">

                                        <div class="carousel-inner" id="anh_dai_dien_modal">

                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleCaptions2" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleCaptions2" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>



                                </div>
                                <div class="modal-footer pd_10">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal anh_bia modal fade" id="myModal3" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal body -->
                                <div class="modal-body pd_10">
                                    <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">

                                        <div class="carousel-inner" id="anh_bia_modal">

                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleCaptions3" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleCaptions3" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="modal-footer pd_10">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <!-- tab 2 -->

                </div>
                <!-- add location -->
                <div class="modal fade  " id="them_vi_tri">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <form method="post" id="insert_form_location">
                                <div class="modal-header">
                                    <h4 class="modal-title">Thêm ví trí phần mộ</h4>
                                    <button type="button" class=" btn close rounded-circle btn-light"
                                        data-bs-dismiss="modal">&times;</button>

                                </div>
                                <div class="modal-body">

                                    <div class=" d-flex justify-content-between align-items-center mb_10">
                                        <div class="  d-flex align-items-center rounded-3 ">

                                            <div class="avatar avatar-sm rounded-circle gallery_dd_s">
                                            </div>
                                            <div class="fz_14 pd_5 d-grid">
                                                <span><b> <?php echo $firstname ?></b></span>

                                            </div>

                                        </div>

                                    </div>


                                    <div id="location_dad">
                                        <label for="location "><b>Vĩ độ và kinh độ :</b> </label>
                                        <input type="text" name="loaction" id="location"
                                            class="border-0 location w-100">
                                        <div class="d-flex  ">
                                            <div class="location_son">
                                                <label for="nhap_ten-diadiem"><b>Nhập tên Mộ:</b></label>
                                                <input type="text" id="nhap_ten-diadiem" name="nhap_ten-diadiem"
                                                    required class="border border-success rounded location ">
                                            </div>
                                            <div class="location_son">
                                                <label for="nhap_mota-diadiem"> <b>Nhập mô tả chi tiết phần Mộ:
                                                    </b></label>
                                                <input type="text" id="nhap_mota-diadiem" name="nhap_mota-diadiem"
                                                    class="border border-success rounded location  ">
                                            </div>

                                        </div>


                                    </div>
                                    <!-- </form> -->

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger close"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <input type="hidden" name="userid" id="user" value="<?php echo $userid ?>" />
                                    <input type="hidden" name="location_id" id="location_id" class="value_0" />
                                    <input type="submit" name="insert_lc" id="insert_lc" value="Insert"
                                        class="btn btn-success" />
                                </div>
                            </form>
                            <div class=" mb_20 d-flex justify-content-center align-items-center">
                                <span class="material-icons btn-outline-info" onclick="getLocation()" type="button"
                                    class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Định vị lại">
                                    gps_fixed
                                </span>
                                <button class="btn btn-warning " id="address">
                                    xem trước ví trí trên bản đồ
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- khu video -->
                <div>
                    <div class="modal" id="myModal_video">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal body -->
                                <div class="modal-body pd_10">
                                    <div id="carouselExampleCaptions_video" class="carousel slide"
                                        data-interval="false">

                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="media-wrapper">
                                                    <video id="player1" style="max-width:100%;" class="video"
                                                        poster="../images/188206093_475589787034957_417689121209685679_n.jpg"
                                                        preload="none" controls playsinline webkit-playsinline>
                                                        <source
                                                            src="../images/Cartoon Network 2013 - Extended (Video).mp4"
                                                            type="video/mp4">
                                                        <!-- <track srclang="en" kind="subtitles" src="mediaelement.vtt">
                                                            <track srclang="en" kind="chapters" src="chapters.vtt"> -->
                                                    </video>
                                                </div>
                                            </div>
                                            <div class="carousel-item">

                                                <div class="media-wrapper">
                                                    <video id="player2" style="max-width:100%;"
                                                        poster="../images/101547259_1153875724960686_7268416877787873280_n.jpg"
                                                        preload="none" controls playsinline webkit-playsinline>
                                                        <source
                                                            src="../images/[Nhạc Tik Tok] Tôi sẵn sàng ở bên cạnh bạn Remix (我愿意平凡的陪在你身旁) - 蔡耀轩remix - Vương Thất Thất (王七七).mp4"
                                                            type="video/mp4">
                                                        <!-- <track srclang="en" kind="subtitles" src="mediaelement.vtt">
                                                            <track srclang="en" kind="chapters" src="chapters.vtt"> -->
                                                    </video>
                                                </div>
                                            </div>


                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleCaptions_video" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleCaptions_video" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>



                                </div>
                                <div class="modal-footer pd_10">
                                    <button type="button" class="btn btn-danger closevd"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- khu ban dang nghi gi or them bai viet -->
                <div>
                    <div class="modal fade " id="them_bai_viet" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tạo bài viết</h4>
                                    <button type="button" class=" btn close rounded-circle btn-light"
                                        data-bs-dismiss="modal">&times;</button>

                                </div>
                                <div class="modal-body">

                                    <div class=" d-flex justify-content-between align-items-center">
                                        <div class="  d-flex align-items-center rounded-3 ">

                                            <div class="avatar avatar-sm rounded-circle gallery_dd_s">
                                            </div>
                                            <div class="fz_14 pd_5 d-grid">
                                                <span><b> <?php echo $firstname ?></b></span>

                                            </div>

                                        </div>
                                        <div class="">
                                            <label for="che_do  " class="fz_12"><b>Chọn chế độ:</b></label>
                                            <select id="che_do " class="fz_12">
                                                <option value="volvo" selected>Công khai</option>
                                                <option value="saab">Chỉ mình tôi</option>
                                                <option value="vw">Bạn bè của bạn</option>
                                                <option value="audi">Bạn bè củ thể</option>
                                            </select>
                                        </div>

                                    </div>
                                    <form id="AddPost" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                        class="pd_5 form_add_bai_viet lead emoji-picker-container" style="resize: none;"
                                        enctype="multipart/form-data">
                                        <div class="toolbar-container"></div>
                                        <!-- <textarea
                                            class="form-control textarea-control border border-0 position-relative editor"
                                            rows="10" data-emojiable="true" data-emoji-input="unicode"
                                            placeholder="Bạn đang nghĩ gì?" style="resize: none;" type="text"
                                            name="Postcontent" ></textarea> -->
                                        <div class="form-control textarea-control    border border-0 position-relative editor"
                                            rows="10" name="Postcontent">

                                        </div>
                                        <!-- preview image  hoac videp-->
                                        <div>
                                            <div class="previewfile row row-cols-lg-5 ">
                                                <!-- <div class="col pd_5 position-relative">
                                                    <video controls>
                                                        <source src="movie.mp4" type="video/mp4">
                                                    </video>

                                                    <span
                                                        class="material-icons position-absolute top-0 end-0 pd_5 cursor_p"
                                                        data-bs-toggle="tooltip" data-placement="top" title="Xóa video">
                                                        remove_circle_outline
                                                    </span>
                                                </div> -->
                                            </div>
                                        </div>

                                    </form>
                                    <div id="mapholder"></div>
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="fileUpload fileUpload_1 pd_5" data-bs-toggle="tooltip"
                                            data-placement="top" title="Thêm Ảnh">
                                            <input type="file" class="upload" id="uploadFileimg" name="uploadFileimg"
                                                multiple>
                                            <span class="material-icons text-success">
                                                collections
                                            </span>
                                        </div>
                                        <div class="fileUpload fileUpload_1 pd_5" data-bs-toggle="tooltip"
                                            data-placement="top" title="Thêm Video">
                                            <input type="file" class="upload" id="uploadFilevideo"
                                                name="uploadFilevideo">
                                            <span class="material-icons text-danger">
                                                video_call
                                            </span>
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-closecreatepost" data-bs-dismiss="modal">Cancel</button>
                                    <button class="btn btn-success" id="PushPost">
                                        POST
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- khu bo loc -->
                <div>
                    <div class="modal fade  " id="bo_loc" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-center position-relative">
                                    <h4 class="modal-title text-center">Bộ lọc bài viết</h4>
                                    <button type="button"
                                        class=" btn close rounded-circle btn-light position-absolute top-0 end-0 mg_5"
                                        data-bs-dismiss="modal">&times;</button>

                                </div>
                                <div class="modal-body">

                                    <div class="">
                                        <div class="  d-grid  ">
                                            <span class="fz_16"> <b>Dùng bộ lọc để tìm bài viết trên dòng
                                                    thời gian
                                                    của bạn.</b></span>
                                            <span class="fz_14"> Mọi người vẫn nhìn thấy dòng thời gian của
                                                bạn như
                                                bình thường.</span>

                                        </div>

                                        <div class="d-flex justify-content-between select_modal_boloc mb_10">
                                            <label for="che_do  " class="fz_14"><b>Đi đến:</b></label>
                                            <select id="che_do " class="fz_14">
                                                <option value="volvo" selected>Năm</option>
                                                <option value="saab">2021</option>
                                                <option value="vw">2020</option>
                                                <option value="audi">2019</option>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-between select_modal_boloc mb_10">
                                            <label for="che_do  " class="fz_14"><b> Người đăng:</b></label>
                                            <select id="che_do " class="fz_14">
                                                <option value="volvo" selected>Bất kỳ ai</option>
                                                <option value="saab">Bạn</option>
                                                <option value="vw">Người khác</option>

                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-between select_modal_boloc mb_10">
                                            <label for="che_do  " class="fz_14"><b>Quyền riêng
                                                    tư:</b></label>
                                            <select id="che_do " class="fz_14">
                                                <option value="volvo" selected>Tất cả bài viêt</option>
                                                <option value="saab">Công khai</option>
                                                <option value="vw">Chỉ mình tôi</option>
                                                <option value="audi">Bạn bè của bạn </option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger">Xóa </button>
                                    <button class="btn btn-outline-primary">
                                        Xong
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- khu tab 2 gioi thieu -->
                <div>


                    <div class="modal fade  " id="them_cong_viec">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <form method="post" id="insert_form">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm Công việc hoặc học vấn</h4>
                                        <button type="button" class=" btn close rounded-circle btn-light"
                                            data-bs-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">

                                        <div class=" d-flex justify-content-between align-items-center mb_10">
                                            <div class="  d-flex align-items-center rounded-3 ">

                                                <div class="avatar avatar-sm rounded-circle gallery_dd_s">
                                                </div>
                                                <div class="fz_14 pd_5 d-grid">
                                                    <span><b> <?php echo $firstname ?></b></span>

                                                </div>

                                            </div>
                                            <div class="">
                                                <!-- <label for="che_do  " class="fz_12"><b>Chọn chế độ:</b></label>
                                                    <select id="che_do_cv" class="fz_12">
                                                        <option value="cong_khai" selected>Công khai</option>
                                                        <option value="chi_minh_toi">Chỉ mình tôi</option>
                                                        <option value="ban_be_cua_ban">Bạn bè của bạn</option>
                                                        <option value="ba_be_cu_the">Bạn bè củ thể</option>
                                                    </select> -->
                                            </div>

                                        </div>
                                        <!-- <form action="" class="d-flex align-items-center "> -->
                                        <!-- <div class="fileUpload fileUpload_1 d-grid  cursor_p">
                                                    <input type="file" class="upload ">
                                                    <span class="material-icons text-success">
                                                        photo_camera
                                                    </span>
                                                    <span class="text-black-50 fz_12">
                                                        Thêm Logo trường học hoặc nơi làm việc
                                                    </span>
                                                </div> -->

                                        <input type="text" id="nhap_noi_lv" name="nhap_noi_lv"
                                            placeholder="Nhập nơi làm việc hoặc nơi học tập"
                                            class="width_100 border_raidus_07 border  border-success up_cv height_40"
                                            required>
                                        <!-- </form> -->

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger close"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="hidden" name="userid" id="user" value="<?php echo $userid ?>" />
                                        <input type="hidden" name="cong_viec_id" id="cong_viec_id" class="value_0" />
                                        <input type="submit" name="insert" id="insert" value="Insert"
                                            class="btn btn-success" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade  " id="them_noi_song" role="dialog">
                        <div class="modal-dialog">
                            <form method="post" id="insert_form_2">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm nơi từng sống hoặc đang sống</h4>
                                        <button type="button" class=" btn close rounded-circle btn-light"
                                            data-bs-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">

                                        <div class=" d-flex justify-content-between align-items-center">
                                            <div class="  d-flex align-items-center rounded-3 ">

                                                <div class="avatar avatar-sm rounded-circle gallery_dd_s">
                                                </div>
                                                <div class="fz_14 pd_5 d-grid">
                                                    <span><b> <?php echo $firstname ?></b></span>

                                                </div>

                                            </div>
                                            <div class="">
                                                <!-- <label for="che_do  " class="fz_12"><b>Chọn chế độ:</b></label>
                                                    <select id="che_do " class="fz_12">
                                                        <option value="volvo" selected>Công khai</option>
                                                        <option value="saab">Chỉ mình tôi</option>
                                                        <option value="vw">Bạn bè của bạn</option>
                                                        <option value="audi">Bạn bè củ thể</option>
                                                    </select> -->
                                            </div>

                                        </div>

                                        <div class="d-grid">

                                            <div class="d-flex justify-content-between mb_10">
                                                <div class="fileUpload fileUpload_1 d-grid cursor_p">
                                                    <!-- <input type="file" class="upload ">
                                                            <span class="material-icons text-success">
                                                                photo_camera
                                                            </span>
                                                            <span class="text-black-50 fz_12">
                                                                Thêm Logo(nếu có)
                                                            </span> -->
                                                </div>
                                                <div class="">
                                                    <select id="mo_ta" class="fz_12" name="mo_ta">
                                                        <option value="Quê quán" selected>Quê quán </option>
                                                        <option value="Tỉnh-Thành phố đã từng sống">Tỉnh/Thành phố
                                                            đã từng sống</option>
                                                        <option value="Huyện-Quận đã từng sống">Huyện/Quận đã từng
                                                            sống</option>
                                                        <option value="Xã-Phường đã từng sống">Xã/Phường đã từng
                                                            sống</option>
                                                        <option value="Tỉnh-Thành phố hiện tại">Tỉnh/Thành phố hiện
                                                            tại</option>
                                                        <option value="Huyện/Quận hiện tại">Huyện/Quận hiện tại
                                                        </option>
                                                        <option value="Xã-Phường hiện tại">Xã/Phường hiện tại
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="text" id="nhap_noi_song" name="nhap_noi_song"
                                                placeholder="Nhập nơi từng sống  hoặc nơi đang sống hiện tại"
                                                class="width_100 border_raidus_07 border  border-success up_cv height_40"
                                                required>
                                        </div>

                                    </div>




                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="hidden" name="userid" id="user" value="<?php echo $userid ?>" />
                                        <input type="hidden" name="noi_song_id" class="value_0" id="noi_song_id" />
                                        <input type="submit" name="them_ns" id="them_ns" value="Insert"
                                            class="btn btn-success" />
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="modal fade  " id="them_thong_tin_lien_he" role="dialog">
                        <div class="modal-dialog">
                            <form method="post" id="insert_form_3">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm Thông tin liên hệ</h4>
                                        <button type="button" class=" btn close rounded-circle btn-light"
                                            data-bs-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">

                                        <div class=" d-flex justify-content-between align-items-center">
                                            <div class="  d-flex align-items-center rounded-3 ">

                                                <div class="avatar avatar-sm rounded-circle gallery_dd_s">
                                                </div>
                                                <div class="fz_14 pd_5 d-grid">
                                                    <span><b> <?php echo $firstname ?></b></span>

                                                </div>

                                            </div>
                                            <div class="">
                                                <!-- <label for="che_do  " class="fz_12"><b>Chọn chế độ:</b></label>
                                                    <select id="che_do " class="fz_12">
                                                        <option value="volvo" selected>Công khai</option>
                                                        <option value="saab">Chỉ mình tôi</option>
                                                        <option value="vw">Bạn bè của bạn</option>
                                                        <option value="audi">Bạn bè củ thể</option>
                                                    </select> -->
                                            </div>

                                        </div>

                                        <div class="d-grid">

                                            <div class="d-flex justify-content-end mb_10">
                                                <div>
                                                    <label for="loai_lienhe " class="fz_12">
                                                        Chọn loại liên hệ:
                                                    </label>

                                                    <select id="loai_lienhe" class="fz_12" name="loai_lienhe">
                                                        <option value="Email" selected>Email </option>
                                                        <option value="Số điện thoại">Số điện thoại</option>
                                                        <option value="Zalo"> Zalo</option>
                                                        <option value="Telegram">Telegram</option>

                                                    </select>
                                                </div>

                                            </div>
                                            <input type="text" id="nhap_lien_he" name="nhap_lien_he"
                                                placeholder="Nhập thông tin liên hệ"
                                                class="width_100 border_raidus_07 border  border-success up_cv height_40">
                                        </div>

                                    </div>




                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="hidden" name="userid" id="user" value="<?php echo $userid ?>" />
                                        <input type="hidden" name="lien_he_id" class="value_0" id="lien_he_id" />
                                        <input type="submit" name="them_lh" id="them_lh" value="Insert"
                                            class="btn btn-success" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal fade  " id="them_thong_tin_co_ban" role="dialog">
                        <div class="modal-dialog">

                            <form method="post" id="insert_form_4">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm thông tin cơ bản </h4>
                                        <button type="button" class=" btn close rounded-circle btn-light"
                                            data-bs-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">

                                        <div class=" d-flex justify-content-between align-items-center">
                                            <div class="  d-flex align-items-center rounded-3 ">

                                                <div class="avatar avatar-sm rounded-circle gallery_dd_s">
                                                </div>
                                                <div class="fz_14 pd_5 d-grid">
                                                    <span><b><?php echo $firstname ?></b></span>

                                                </div>

                                            </div>
                                            <div class="">
                                                <!-- <label for="che_do  " class="fz_12"><b>Chọn chế độ:</b></label>
                                                    <select id="che_do " class="fz_12">
                                                        <option value="volvo" selected>Công khai</option>
                                                        <option value="saab">Chỉ mình tôi</option>
                                                        <option value="vw">Bạn bè của bạn</option>
                                                        <option value="audi">Bạn bè củ thể</option>
                                                    </select> -->
                                            </div>

                                        </div>

                                        <div class="d-grid">

                                            <div class="d-flex justify-content-end mb_10">

                                                <div class="">
                                                    <label for="chon_loai_tt" class="fz_12">Chọn loại thông
                                                        tin</label>
                                                    <select id="chon_loai_tt" class="fz_12" name="chon_loai_tt">
                                                        <option value="Giới tính" selected>Giới tính </option>
                                                        <option value="Ngày sinh">Ngày sinh</option>
                                                        <option value="Năm sinh">Năm sinh</option>
                                                        <option value="Nơi thường trú">Nơi thường trú</option>
                                                        <option value="Nơi tạm trú">Nơi tạm trú</option>
                                                        <option value="Nghề nghiệp">Nghề nghiệp</option>
                                                        <option value="Tình trạng quan hệ">Tình trạng quan hệ
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="text" id="nhap_thong_tin_cb"
                                                placeholder="Nhập thông tin cơ bản" name="nhap_thong_tin_cb"
                                                class="width_100 border_raidus_07 border  border-success up_cv height_40">
                                        </div>

                                    </div>




                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="hidden" name="userid" id="user" value="<?php echo $userid ?>" />
                                        <input type="hidden" name="co_ban_id" id="co_ban_id" />
                                        <input type="submit" name="them_cb" id="them_cb" value="Insert"
                                            class="btn btn-success" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal fade  " id="them_tieu_su" role="dialog">
                        <div class="modal-dialog">
                            <form method="post" id="insert_form_5">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm tiểu sử </h4>
                                        <button type="button" class=" btn close rounded-circle btn-light"
                                            data-bs-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">

                                        <div class=" d-flex justify-content-between align-items-center mb_10">
                                            <div class="  d-flex align-items-center rounded-3 ">

                                                <div class="avatar avatar-sm rounded-circle gallery_dd_s">
                                                </div>
                                                <div class="fz_14 pd_5 d-grid">
                                                    <span><b> <?php echo $firstname ?></b></span>

                                                </div>

                                            </div>
                                            <div class="">
                                                <!-- <label for="che_do  " class="fz_12"><b>Chọn chế độ:</b></label>
                                                    <select id="che_do " class="fz_12">
                                                        <option value="volvo" selected>Công khai</option>
                                                        <option value="saab">Chỉ mình tôi</option>
                                                        <option value="vw">Bạn bè của bạn</option>
                                                        <option value="audi">Bạn bè củ thể</option>
                                                    </select> -->
                                            </div>

                                        </div>

                                        <div class="d-grid">

                                            <div class="d-flex  align-items-center width_100 mb_10">
                                                <div class="fileUpload fileUpload_1 d-grid cursor_p mg_5">
                                                    <!-- <input type="file" class="upload ">
                                                            <span class="material-icons text-success">
                                                                photo_camera
                                                            </span> -->

                                                </div>
                                                <div class="width_90">
                                                    <input type="text" id="nhap_mta_tieu_su" name="nhap_mta_tieu_su"
                                                        placeholder="Nhập mô tả"
                                                        class="width_100 border_raidus_07 border  border-success up_cv height_40 mb_10">
                                                </div>
                                            </div>

                                            <textarea class="   border border-0" rows="10" id="chi_tiet_tieu_su"
                                                name="chi_tiet_tieu_su"
                                                placeholder="Tiểu sử của bạn như thế nao? hãy giải bày hết lên đây nhé :))"
                                                style="resize: none;"></textarea>
                                        </div>

                                    </div>




                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="hidden" name="userid" id="user" value="<?php echo $userid ?>" />
                                        <input type="hidden" name="tieu_su_id" class="value_0" id="tieu_su_id" />
                                        <input type="submit" name="them_ts" id="them_ts" value="Insert"
                                            class="btn btn-success" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal fade  " id="them_su_kien" role="dialog">
                        <div class="modal-dialog">
                            <form method="post" id="insert_form_6">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm sự kiện trong đời</h4>
                                        <button type="button" class=" btn close rounded-circle btn-light"
                                            data-bs-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">

                                        <div class=" d-flex justify-content-between align-items-center">
                                            <div class="  d-flex align-items-center rounded-3 ">

                                                <div class="avatar avatar-sm rounded-circle gallery_dd_s">
                                                </div>
                                                <div class="fz_14 pd_5 d-grid">
                                                    <span><b> <?php echo $firstname ?></b></span>

                                                </div>

                                            </div>
                                            <div class="">
                                                <!-- <label for="che_do  " class="fz_12"><b>Chọn chế độ:</b></label>
                                                    <select id="che_do " class="fz_12">
                                                        <option value="volvo" selected>Công khai</option>
                                                        <option value="saab">Chỉ mình tôi</option>
                                                        <option value="vw">Bạn bè của bạn</option>
                                                        <option value="audi">Bạn bè củ thể</option>
                                                    </select> -->
                                            </div>

                                        </div>

                                        <div class="d-grid">

                                            <!-- <div class="d-flex justify-content-center mb_10">
                                                        <div class="fileUpload fileUpload_1 d-grid cursor_p">
                                                            <input type="file" class="upload ">
                                                            <span class="material-icons text-success">
                                                                photo_camera
                                                            </span>
                                                            <span class="text-black-50 fz_12">
                                                                Thêm ảnh
                                                            </span>
                                                        </div>

                                                    </div> -->
                                            <div class="d-flex justify-content-between mb_10">
                                                <div class="d-grid text-center">
                                                    <label for="nhap_nam" class="fz_12">Nhập thời gian:</label>
                                                    <input type="text" id="nhap_thoi_gian" placeholder="Nhập thời gian"
                                                        name="nhap_thoi_gian"
                                                        class=" rounded-3 border  border-success up_cv height_40">
                                                </div>
                                                <div class="d-grid text-center">
                                                    <label for="nhap_sk" class="fz_12">Nhập sự kiện:</label>
                                                    <input type="text" id="nhap_sk" placeholder="Nhập mô tả sự kiện"
                                                        name="nhap_sk"
                                                        class=" rounded-3 border  border-success up_cv height_40">
                                                </div>
                                            </div>

                                            <textarea class=" border border-0" rows="10" id="chi_tiet_su_kien"
                                                name="chi_tiet_su_kien" placeholder="Mô tả chi tiết sự kiện "
                                                style="resize: none;"></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="hidden" name="userid" id="user" value="<?php echo $userid ?>" />
                                        <input type="hidden" class="value_0" name="su_kien_id" id="su_kien_id" />
                                        <input type="submit" name="them_sk" id="them_sk" value="Insert"
                                            class="btn btn-success" />
                                    </div>
                                </div>
                                <form>
                        </div>
                    </div>
                </div>
                <!-- load xong -->
                <!-- <div class="">
                    <div class="modal fade " id="load_thu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: transparent;">
                        <div class="modal-dialog modal-dialog-centered justify-content-center" style="background: transparent;">
                            <div class="modal-content border-0"style=" height: 150px;width: 150px;border: none; background: transparent;">
                                <img src="https://i.pinimg.com/originals/96/8e/44/968e44ed3f0778f5c3688ddc253b8c30.gif" alt="">
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="load_sussce fixed-top height-vh100 width_100">

                    <center class="position-absolute top-50 start-50 translate-middle rounded"><span class=" ">Thành
                            công</center>
                </div>
                <div class="load_home fixed-top height-vh100 width_100">

                    <center class="position-absolute top-50 start-50 translate-middle rounded"><span
                            class=" typing-demo">Chào mừng đến với trang cá nhân của <?php echo $firstname ?> </center>
                </div>

            </div>
        </div>
        <!-- chuc nang cua video -->
        <div style="opacity: 0;">
            <form action="#" method="get" style="opacity: 0;">
                <label><select name="lang">


                    </select>
                </label>
                <label>)<select name="stretching">

                        <option value="fill" selected>Fill</option>
                    </select>
                </label>
            </form>
        </div>



        <!-- chuc nang zoom anh -->
        <svg style=display:none>
            <!-- Icons adapted from those made by https://www.flaticon.com/authors/freepik off https://www.flaticon.com/ -->
            <symbol id="icon-fullScreen-open" viewBox="0 0 96 96">
                <path
                    d="M0 62l12 12 19-19 10 10-19 19 12 12H0V62zm96 34H62l12-12-19-19 10-10 19 19 12-12v34zM34 0L22 12l19 19-10 10-19-19L0 34V0h34zm62 0v34L84 22 65 41 55 31l19-19L62 0h34H0h96z" />
            </symbol>
            <symbol id="icon-fullScreen-exit" viewBox="0 0 96 96">
                <path
                    d="M96 60L82 74l14 13-8 9-14-14-14 14V60h36zm-60 0v36L22 82 8 96l-8-9 14-13L0 60h36zM0 36h36V0L22 14 9 0 0 9l14 13L0 36zm60 0h36L82 22 96 9l-9-9-13 14L60 0v36z" />
            </symbol>
        </svg>

    </section>

</body>


<link rel="stylesheet" href="../css/croppie.css" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="../bootstrap-5.0.2-dist/js/bootstrap.js"></script>

<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
<script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js">
</script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script src="../mediaelement-mediaelement-3b02c78/build/mediaelement-and-player.js"></script>



<script src="../lib/js/config.js"></script>
<script src="../lib/js/emoji-picker.js"></script>
<script src="../lib/js/jquery.emojiarea.js"></script>
<script src="../lib/js/util.js"></script>
<script src="../javascript/share.js"></script>
<!-- <script type="text/javascript" src="../javascript/croppie.js"></script> -->
<script src="../ckeditor5/ckeditor5-build-decoupled-document/ckeditor.js"></script>


<!-- <script type="text/javascript" src="up_anhbia.js"></script> -->
<!-- <script type="text/javascript" src="../javascript/up_anhdai_dien.js"></script> -->
<script type="text/javascript" src="../javascript/up_video_tab3.js"></script>
<script type="text/javascript" src="../javascript/up_location.js"></script>
<!--
 -->
<script type="text/javascript" src="../javascript/upload_anh_tab_3.js"></script>
<script src="../javascript/thu_vien_video.js"></script>
<script src="../javascript/profile-ongbata.js"></script>
<script src="../javascript/crud_imgcover.js"></script>
<script src="../javascript/crud_imgavatar.js"></script>
<script src="../javascript/fetch_data.js"></script>
<script type="text/javascript" src="../javascript/upload_gioi_thieu.js"> </script>

<!--  -->
<!-- map -->
<script src="../javascript/thu-vien-map-box.js"></script>


<!-- khu script  -->

<!-- emoij -->
<script>
$(function() {
    // Initializes and creates emoji set from sprite sheet
    window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: '../lib/img/',
        popupButtonClasses: 'fa fa-smile-o'
    });
    // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
    // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
    // It can be called as many times as necessary; previously converted input fields will not be converted again
    window.emojiPicker.discover();
});
</script>
<!--  -->
<script>
//  $( "#anh_dai_dien" ).on( "click", function(event) {

//     toggleFullscreen(this);

//     } );
</script>
<!-- location google map -->
<script>
// var JSONID = 0;

// // Create a JSON Object Array
// var geoLocJSON = new Array();

// var x = document.getElementById("location");

// function getLocation() {
//     if (navigator.geolocation) {
//         navigator.geolocation.watchPosition(showPosition);
//     } else {
//         x.innerHTML = "Geolocation is not supported by this browser.";
//     }
// }

// function showPosition(position) {
//     x.value = +position.coords.latitude +
//         ", " + position.coords.longitude;

//     var myJSON = {
//         "id": JSONID,
//         "geoLoc": {
//             "latitude": position.coords.latitude,
//             "longtitute": position.coords.longitude
//         }
//     };

//     // Increments the JSONID
//     JSONID++;
//     geoLocJSON.push(myJSON);

//     // Google intatercive map
//     lat = position.coords.latitude;
//     lon = position.coords.longitude;
//     latlon = new google.maps.LatLng(lat, lon)
//     mapholder = document.getElementById('mapholder')
//     mapholder.style.height = '340px';
//     mapholder.style.width = '100%';

//     var myOptions = {
//         center: latlon,
//         zoom: 20,
//         mapTypeId: google.maps.MapTypeId.ROADMAP,
//         mapTypeControl: false,
//         navigationControlOptions: {
//             style: google.maps.NavigationControlStyle.SMALL
//         }
//     }

//     var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
//     var marker = new google.maps.Marker({
//         position: latlon,
//         map: map,
//         title: "You are here!"
//     });
// }

// // If error
// function showError(error) {
//     switch (error.code) {
//         case error.PERMISSION_DENIED:
//             x.innerHTML = "User denied the request for Geolocation."
//             break;

//         case error.POSITION_UNAVAILABLE:
//             x.innerHTML = "Location information is unavailable."
//             break;

//         case error.TIMEOUT:
//             x.innerHTML = "The request to get user location timed out."
//             break;

//         case error.UNKNOWN_ERROR:
//             x.innerHTML = "An unknown error occurred."
//             break;
//     }
// }
</script>
<!-- location new -->
<script>
// day len la x
// y la demo
var x = document.getElementById("location");
var y = document.getElementById("address");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
        y.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {

    x.value = +position.coords.longitude +
        ", " + position.coords.latitude;
    y.value = +position.coords.latitude +
        ", " + position.coords.longitude;
    $('#them_vi_tri').modal('show');
    $("#address").each(function() {
        var address = $(this).val().replace(/\,/g, ' '); // get rid of commas
        var url = address.replace(/\ /g, '%20'); // convert address into approprite URI for google maps

        $(this).wrap('<a href="http://maps.google.com/maps?q=' + url + '" target="_blank"></a>');

    });
}
</script>

<!-- // ckeditor -->
<script>
DecoupledEditor

    .create(document.querySelector('.editor'), {
        // language: 'vi'
        placeholder: 'Bạn đang nghĩ gì?',
        // cloudServices: {
        //     tokenUrl: 'https://example.com/cs-token-endpoint',
        //     uploadUrl: 'https://your-organization-id.cke-cs.com/easyimage/upload/'
        //  }
        ckfinder: {
            uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
        },
    })

    .then(editor => {
        const toolbarContainer = document.querySelector('.form_add_bai_viet .toolbar-container');

        toolbarContainer.prepend(editor.ui.view.toolbar.element);

        window.editor = editor;
    })
    .catch(err => {
        console.error(err.stack);
    });
document.querySelector('#PushPost').addEventListener('click', () => {
    const editorData = editor.getData();
});
</script>

<!-- LOCATIONED google map -->
<!-- <script>
                    var locations = [
                        ['<b>England Branch,</b><br> International city', 16.041131355778706,108.22196289561334, 2, "https://maps.google.com/mapfiles/ms/micons/blue.png"],
                        ['<b>Greec Branch,</b><br> International city', 16.07472878038142, 108.21038338400398, 1, "https://maps.google.com/mapfiles/ms/micons/green.png"]
                    ];
                    var map = new google.maps.Map(document.getElementById('map_2'), {
                        zoom: 10,
                        center: new google.maps.LatLng(16.07472878038142, 108.21038338400398),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });
                    var infowindow = new google.maps.InfoWindow();
                    var marker, i;
                    for (i = 0; i < locations.length; i++) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            icon: locations[i][4],
                            map: map
                        });
                        google.maps.event.addListener(marker, 'click', (function (marker, i) {
                            return function () {
                                infowindow.setContent(locations[i][0]);
                                infowindow.open(map, marker);
                            }
                        })(marker, i));
                    }
            </script> -->
<!-- mapbox -->
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiZ2lhcDE1IiwiYSI6ImNrcmFuenhrZDFqN2MycGxwa3J6OHA4cDgifQ.1G6kupnoC6sI2dA5SfEBbA';

var map = new mapboxgl.Map({
    container: 'map1', // HTML container id
    style: 'mapbox://styles/mapbox/streets-v11', // style URL
    center: [<?php echo $location; ?>], // starting position as [lng, lat]
    zoom: 13
});

var popup = new mapboxgl.Popup().setHTML(
    '<h3 class="fz_16"><?php echo $lastname . " " . $firstname ?></h3>'
);

var marker = new mapboxgl.Marker()
    .setLngLat([<?php echo $location; ?>])
    .setPopup(popup)
    .addTo(map);
</script>

<!-- khu ajax -->

<script type="text/javascript">
$(document).ready(function() {
    // kiem tra do dai chu


    $.getScript('../javascript/thu_vien_video.js', function() {
        console.debug('Script loaded.');
    });
    $.getScript('../mediaelement-mediaelement-3b02c78/build/mediaelement-and-player.js', function() {
        console.debug('Script loaded.');
    });
    // togglefuscren
    $('.anh_fullscren').click(function() {
        toggleFullscreen(this);
    });

    // window.onload = function ()
    // {
    //     $(".load_sussce").show().delay(5000).fadeOut();
    // };
    $(".load_home").show().delay(5000).queue(function(n) {
        $(this).hide();
        n();
        $(".check_anh8,.check_video7,.check_video9,.check_video10").remove()
    });
    // check file
    $(".add_add9").addClass("rounded-circle  border border-3 border-white");
    $(".add_add9").parent().addClass("bg-light bg-gradient pd_15 d-flex justify-content-center");
    $(".check_anh8,.check_video7,.check_video9,.check_video10").remove()

    // $(".load_home").show().delay(5000).fadeOut();

    $("#load_thu").modal('show').delay(5000).queue(function(n) {
        $(this).modal('hide');
        n();
        $(".check_anh8,.check_video7,.check_video9,.check_video10").remove()
    });
    // xoa phan them cong viec
    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete': 1,
                'id': id,
            },
            success: function(data) {
                // remove the deleted comment
                // $(this).parent().parent().parent().parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });



    // xoa phan them noi song
    $(document).on('click', '.delete_2', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_2': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                // $clicked_btn.parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });

    // thong tin lien he
    // xoa phan them noi song
    $(document).on('click', '.delete_3', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_3': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                // $clicked_btn.parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });

    // thong tin lien he
    // xoa phan them noi song
    $(document).on('click', '.delete_4', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_4': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                // $clicked_btn.parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });
    // thong tin lien he
    // xoa phan them noi song
    $(document).on('click', '.delete_5', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_5': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                // $clicked_btn.parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });
    // thong tin lien he
    // xoa phan them noi song
    $(document).on('click', '.delete_6', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_6': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                // $clicked_btn.parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });

    // xoa anh dai dien
    $(document).on('click', '.delete_anh3', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: '../process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_anh3': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                // $clicked_btn.parent().remove();
                //   $("xoa").parent(response)
                //   $('#name').val('');
                //   $('#comment').val('');
                //   $('.input-js').val('');
            }
        });
    });
    $(document).on('click', '.delete_video', function() {

        var inputs = $(this);
        for (var i = 0; i < inputs.length; i++) {

            var id_vao = inputs[i].id
        }
        $clicked_btn = $(this);
        $.ajax({
            url: '../process/delete_gioi_thieu.php',
            type: 'GET',
            data: {
                'delete_video': 1,
                'id': id_vao,
            },
            success: function(response) {
                $clicked_btn.parent().parent().parent().parent().parent().parent().remove();
            }
        });


    });



    $(this).find("#imagetab1").addClass("active");
    $(this).find(".itemdd1").addClass("active");
    $(this).find(".itembia1").addClass("active");
    // xoa
    $(".delete_jq").click(function() {
        $(this).parent().parent().parent().parent().remove();
    });
    $(".delete_jqa").click(function() {
        $(this).parent().parent().parent().parent().parent().parent().remove();
    });

    // Fetch Data from Database
    function fetchData() {
        // $.ajax({
        //     url: "fetch_anh_dai_dien.php",
        //     type: "POST",
        //     cache: false,
        //     success: function(data) {
        //         $(".gallery_dd_big").html(data);
        //     }
        // });
        // $.ajax({
        //     url: "fetch_anh_daidien_son.php",
        //     type: "POST",
        //     cache: false,
        //     success: function(data) {
        //         $(".gallery_dd_s").html(data);
        //     }
        // });
        $.ajax({
            url: "fetch_anh_modal_tab1.php",
            type: "POST",
            cache: false,
            success: function(data) {
                $("#anh_nho_tab1").html(data);
            }
        });
    }
    fetchData();


    $(document).on('change', '.up_file', function() {
        $('#them_bai_viet').modal('show');
    });
    // check file emty
    $("img[src='']").parent().parent().parent().remove()
    $("source[src='']").parent().parent().remove()
    $(".read-m").click(function() {
        $(this).parent().parent().toggleClass("pr_da");
    });


});

function loadlink() {

    // kiem tra do dai chu
    //  $(".dad_title").each(function() {
    //                     $(this).parent().addClass($(this).text().length > 100 ? "block" : "an_rm");

    //                 });
    // // read more

    // $('.readmore').click(function(event){
    // var article_num = event.target.dataset.article;

    // // window.testEvent = event;
    // // Show the additional content
    // $(`.${article_num} .show-this-on-click`).slideDown();

    // // Toggle the controls
    // $(`.${article_num} .readmore`).hide();
    // $(`.${article_num} .readless`).show();

    // event.preventDefault();
    // });

    // $('.readless').click(function(event){
    // var article_num = event.target.dataset.article;

    // // Hide the additional content
    // $(`.${article_num} .show-this-on-click`).slideUp();

    // // Toggle the controls
    // $(`.${article_num} .readless`).hide();
    // $(`.${article_num} .readmore`).show();

    // event.preventDefault();
    // });

    // $('.background-control').click(function(){
    // if ($('.post').hasClass('amarillo')) {
    //     $('.post').removeClass('amarillo');
    //     $('.background-status').text('article has class amarillo: false!');
    // } else {
    //     $('.post').addClass('amarillo');
    //     $('.background-status').text('article has class amarillo: true!');
    // }
    // event.preventDefault();
    // });

    //         $(".read-m").click(function(){
    //         $(this).parent().parent().toggleClass("pr_da");
    //     });
    // $(".fullScreen_btn-open,.fullScreen_btn-exit").click(function(){
    //   $(this).parent().toggleClass("image_tg");
    // });
    // $(this).find(".fullScreen_btn-exit").addClass(" fa-birthday-cake");
    // $(this).find(".fullScreen_btn-open").removeClass(" fa-birthday-cake");
    $(this).find(".image_post5").parent().append(
        "<span class='see_more fz_20 position-absolute top-50 start-50 translate-middle text-center' data-bs-toggle='modal' data-bs-target='#post_sm_3'><b>Xem thêm 2 ảnh nữa </b></span>"
    );
    $(this).find(".image_post5").css("display", "none");

    $(".click_show,.bt_close_sm-media").click(function() {
        $(this).fadeOut(function() {
            $(this).parent().parent().parent().toggleClass("show_comment");
        })
    });
    $(".click_show,.bt_close_sm-media").click(function() {
        $(this).fadeOut(function() {
            $(this).parent().parent().parent().toggleClass("show_comment");
        })
    });
}
loadlink();
// This will run on page load
// setInterval(function(){
//     loadlink() // this will run after every 5 seconds
// }, 5000);
</script>

</html>