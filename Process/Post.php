<?php
//use session get id userlogin
$userid = '1';

include 'Connect.php';
include '../AWS3/crudpost_AWS3.php';
include '../AWS3/configAWS3.php';

$pathAMS3 = 'https://labtoidayhoc.s3.ap-southeast-1.amazonaws.com/duy_dev/';
$path = $pathAMS3;
$fileExtensionvideo = ['m4v', 'avi', 'mpg', 'mp4'];

$result_data = array();
$limit = 3;
$sql = "SELECT COUNT(id) FROM post";
$rs_result = mysqli_query($connect, $sql);
$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
if (isset($_GET['method'])) {
    $form_data = array();
    $method = $_GET['method'];
    if ($method == 'loaddata') {
        $start_from = (($_GET['page']) - 1) * $limit;
        $sql = "SELECT p.id as pid,p.*,SUBSTRING(Title,1,100),SUBSTRING(Title,100),m.*,HOUR(CURRENT_TIMESTAMP-from_unixtime(p.datecreate)) as numberhour,
        from_unixtime(p.datecreate) as datecreatepost
         FROM post p left join members m on p.membersid = m.id
         where p.membersid = '{$userid}' and p.groupsid is null
        ORDER BY p.datecreate DESC LIMIT $start_from, $limit";
        $result = $connect->query($sql);
        if (!empty($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //show html
                ?>
<div id="postid_<?=$row['pid'];?>" class="bg-white shadow-sm border border_raidus_07  mb_20 section_right-3 postroot">
    <div class=" section_right-2_header d-flex justify-content-between align-items-center pd_10 ">
        <div class="d-flex justify-content-between  align-items-center">
            <div class="avtar_img_section_right_2 gallery_dd_s">
            </div>
            <div class="text-center">
                <h5 class="fz_16">
                    <b>
                        <span>
                            <?=$row['lastname'] . " " . $row['firstname'];?>
                        </span>
                    </b>
                </h5>
                <div class="fz_12 d-flex   align-items-center">
                    <span>
                        <?php switch (true) {
                    case ($row['numberhour'] == null):
                        echo "NULL";
                        break;
                    case ($row['numberhour'] <= 1):
                        echo "1 giờ trước";
                        break;
                    case ($row['numberhour'] <= 24):
                        echo $row['numberhour'] . " giờ trước";
                        break;
                    case ($row['numberhour'] > 24):
                        echo $row['datecreatepost'];
                        break;
                }
                ?>
                    </span>
                    <span class="material-icons">
                        supervisor_account
                    </span>
                </div>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn dropdown-toggle button_dr_afet" type="button" data-bs-toggle="dropdown">

                <span class="material-icons ">
                    more_horiz
                </span>
            </button>
            <ul class="dropdown-menu  z_index_10">
                <li>
                    <button class="btn d-flex align-items-center fz_12 justify-content-between btn-editpost"
                        data-bs-toggle="modal" data-bs-target="#them_bai_viet" data-id="<?=$row['pid'];?>">
                        <span class="material-icons fz_12 text-black-50">
                            drive_file_rename_outline
                        </span>
                        <b> <span class="fz_12"> Chỉnh sửa bài viết</span></b>
                    </button>
                </li>
                <li>
                    <button class="btn d-flex align-items-center  justify-content-between btn--del"
                        data-id="<?=$row['pid'];?>">
                        <span class="material-icons fz_12 text-black-50">
                            delete
                        </span>
                        <b><span class="fz_12"> Xóa bài viết</span></b>
                    </button>
                </li>
            </ul>
        </div>
    </div>
    <div class="section_right-2_body mb_10">
        <div class="pd_10 ">
            <span><?php echo $row['Title'] ?></span>
        </div>
        <?php
$sqlcountimg = "SELECT count(*) FROM gallery g where postid = '{$row['pid']}'";
                $sqlrs = mysqli_query($connect, $sqlcountimg);
                $rowimg = mysqli_fetch_row($sqlrs);
                $total_recordsimg = $rowimg[0];
                if ($total_recordsimg == '1') {
                    $sql_imgurl = "SELECT * FROM gallery g where postid = '{$row['pid']}'";
                    $resultsql_imgurl = $connect->query($sql_imgurl);
                    while ($rowimgurl = mysqli_fetch_array($resultsql_imgurl)) {
                        if (isset($rowimgurl['url'])) {$imgurl1 = $rowimgurl['url'];}
                    }
                    $file_type = strtolower(ltrim(strstr($imgurl1,"."),"."));
                    foreach ($fileExtensionvideo as $key => $val) {
                        if($file_type == $fileExtensionvideo[$key])
                        {   
                            $v = true;
                        }}
                        if($v){
                        ?>
        <div class="media-wrapper align-items-center d-flex " height="100%">
            <video id="player1" width="100%" height="100%" style="max-width:100%;"
                poster="https://media.istockphoto.com/videos/movie-time-concept-background-video-id1127766856?s=640x640"
                preload="none" controls playsinline webkit-playsinline>
                <source src="<?php echo $path; ?><?=$imgurl1;?>">
            </video>
        </div>
        <?php
} else {
                        ?>
        <div class="d-flex flex-wrap imgs_post position-relative">
            <div class="flex_50 image_post1">
                <div class="wrapper <?php echo 'check_anh'; ?>">
                    <div data-fullScreen class="fullScreen-1 ">
                        <div class="hv_thu  <?php echo 'add_add'; ?>">
                            <img src="<?php echo $path; ?><?=$imgurl1;?>" class="anh_fullscren cursor_p" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
}
                } elseif ($total_recordsimg > '1') {
                    $sql_imgurl = "SELECT * FROM gallery g where postid = '{$row['pid']}' and isvideo is null LIMIT 1 ";
                    $resultsql_imgurl = $connect->query($sql_imgurl);
                    while ($rowimgurl = mysqli_fetch_array($resultsql_imgurl)) {
                        if (isset($rowimgurl['url'])) {$imgurlmore = $rowimgurl['url'];}
                        {?>
        <div class="d-flex flex-wrap imgs_post position-relative">
            <div class="flex_50 image_post1">
                <div class="wrapper <?php echo 'check_anh'; ?>">
                    <div data-fullScreen class="fullScreen-1 ">
                        <div class="hv_thu  <?php echo 'add_add'; ?>">
                            <img src="<?php echo $path; ?><?=$imgurlmore;?>" class="anh_fullscren cursor_p" alt="">
                        </div>

                    </div>
                </div>
            </div>
            <!-- neu anh tu nam anh tro len thi apppen span duoi nguoc lai thi ko, do anh chua do nhiu anh trong mot post nen em de tam rk -->
            <span class='see_more fz_20 position-absolute top-50 start-50 translate-middle text-center'
                data-bs-toggle='modal' data-bs-target='<?php echo '#post_sm_'; ?>'><b
                    data-bs-target="<?php echo "#carouselExampleControls_see_more_post", $row['pid']; ?>"
                    data-bs-slide-to="4" aria-label="Slide 5">Xem thêm <?php echo $total_recordsimg; ?> ảnh nữa
                </b></span>
        </div>
        <?php }
                    }
                }

                ?>
        <div class="section_right-2_footer pd_10 ">
            <div class="d-flex justify-content-between  align-items-center">
                <div class="fz_14 d-flex justify-content-between  align-items-center md-fz_12">
                    <?php
$sqlcount = "SELECT postid,count(case when pa.react = 'like' then 1 end) as countlike,
                    count(case when pa.react = 'comment' then 1 end) as countcomment
                        FROM postaction pa where pa.postid = '{$row['pid']}'
                         group by postid";
                $ccountlike = $ccomment = "";
                $resultcount = $connect->query($sqlcount);
                while ($rowcmt = mysqli_fetch_array($resultcount)) {
                    if (isset($rowcmt['countlike'])) {$ccountlike = $rowcmt['countlike'];}
                    if (isset($rowcmt['countcomment'])) {$ccomment = $rowcmt['countcomment'];}
                }
                ?>
                    <span class="material-icons text-danger">
                        favorite
                    </span>
                    <span class="coutlike">
                        <?php echo $ccountlike; ?>
                    </span>
                </div>
                <div class="fz_14 md-fz_12">
                    <span>
                        <?php echo $ccomment; ?>
                    </span>
                    <span>
                        Bình luận
                    </span>
                </div>
            </div>
            <div class="row border-bottom mb_20 md-flex">
                <div class="col-md-4 d-flex align-items-center justify-content-center md-width_30 md-pd_0">
                    <button class="btn d-flex align-items-center justify-content-center md-fz_12 fet_data
                    <?php
$sqllikeuser = "SELECT * from postaction where postid = '{$row['pid']}' and membersid = '{$userid}' and react = 'like'";
                $resultlikeuser = mysqli_query($connect, $sqllikeuser);
                if ($resultlikeuser) {
                    $rowlikeuser = mysqli_num_rows($resultlikeuser);
                    if ($rowlikeuser > 0) {
                        echo "liked";
                    }
                }
                ?>" id="like" data-id="<?=$row['pid'];?>" onclick="openToggle(this)">
                        <span class="material-icons text-success">
                            favorite
                        </span>
                        <span class="db_bl_tg">
                            Thích
                        </span>
                        <span class="dp_none_tg">
                            Đã thích
                        </span>
                    </button>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center md-width_40 md-pd_0">
                    <button class="btn d-flex align-items-center justify-content-center md-fz_12"
                        onclick="openCommentdad(this)">
                        <span class="material-icons text-success">
                            add_comment
                        </span>
                        <span>
                            Bình luận
                        </span>
                    </button>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center md-width_30 md-pd_0 ">
                    <button class="btn d-flex align-items-center justify-content-center md-fz_12" data-bs-toggle="modal"
                        data-bs-target="<?php echo '#sharepost'; ?>">
                        <span class="material-icons text-success">
                            share
                        </span>
                        <span>
                            Chia sẻ
                        </span>
                    </button>
                </div>
            </div>
            <div class="comment_nt_click" id="comment">
                <?php
$sqlcmt = "SELECT m.firstname,m.lastname,c.* FROM comment c left join members m on c.membersid = m.id
                                 where c.postid = '{$row['pid']}'";
                $resultcmt = $connect->query($sqlcmt);
                if (!empty($resultcmt) && $resultcmt->num_rows > 0) {
                    while ($rowcmt = $resultcmt->fetch_assoc()) {
                        ?>

                <div class="">
                    <div class="d-flex align-items-center justify-content-center ">
                        <div class="">

                            <div class="row justify-content-center mb-4">
                                <div class="col-lg-12">
                                    <div class="comments">
                                        <div class="comment d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <div class="avatar avatar-sm rounded-circle ">
                                                    <img class="avatar-img"
                                                        src="https://uifaces.co/our-content/donated/AW-rdWlG.jpg"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                                <div class="comment-meta d-flex align-items-baseline">
                                                    <h6 class="me-2">
                                                        <?=$rowcmt['firstname'] . " " . $rowcmt['lastname'];?>
                                                    </h6>
                                                    <span class="text-muted">2d</span>
                                                </div>
                                                <div class="comment-body d-grid">
                                                    <p>
                                                        <?=$rowcmt['content'];?>
                                                    </p>
                                                    <div class="action">

                                                        <span class="fz_12 text-black-50 cursor_p" id=""
                                                            onclick=" openCommentson(event, 'show_comment_son-1')">Trả
                                                            lời</span>
                                                        <div class="  align-items-center justify-content-between formcomment_son lead emoji-picker-container "
                                                            id="show_comment_son-1">
                                                            <form action=""
                                                                class="d-flex comments   align-items-center w-100">

                                                                <textarea
                                                                    class=" py-0 px-1  rounded-pill formcomment border border-0 form-control textarea-control"
                                                                    rows="1" placeholder="Viết bình luận..."
                                                                    style="resize: none;" data-emojiable="true"
                                                                    data-emoji-input="unicode"></textarea>
                                                            </form>

                                                            <div
                                                                class="pd_2 d-flex   align-items-center justify-content-end ">
                                                                <div
                                                                    class="d-flex   align-items-center justify-content-center">


                                                                    <div class="fileUpload fileUpload_1 d-flex align-items-center mr_5"
                                                                        data-bs-toggle="tooltip" data-placement="top"
                                                                        title="Thêm ảnh/Video"
                                                                        data-bs-original-title="Biểu tượng cảm xúc">
                                                                        <input type="file" class="upload">
                                                                        <span class="material-icons text-success">
                                                                            add_a_photo
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex   align-items-center justify-content-center opacti_0"
                                                                    style="opacity: 0;">

                                                                    <span class="material-icons   text-success cursor_p"
                                                                        data-bs-toggle="tooltip" data-placement="top"
                                                                        title=""
                                                                        data-bs-original-title="Biểu tượng cảm xúc">
                                                                        sentiment_satisfied_alt
                                                                    </span>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- relay cmt -->
                                                <!-- <div class="comment-replies bg-light p-3 mt-3 rounded">
                                                        <h6
                                                            class="comment-replies-title mb-4 text-muted text-uppercase">
                                                            2 replies</h6>

                                                        <div class="reply d-flex mb-4">
                                                            <div class="flex-shrink-0">
                                                                <div class="avatar avatar-sm rounded-circle">
                                                                    <img class="avatar-img"
                                                                        src="https://images.unsplash.com/photo-1501325087108-ae3ee3fad52f?ixlib=rb-0.3.5&q=80&fm=jpg&crop=faces&fit=crop&h=200&w=200&s=f7f448c2a70154ef85786cf3e4581e4b"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                                                <div class="reply-meta d-flex align-items-baseline">
                                                                    <h6 class="mb-0 me-2">
                                                                        Brandon Smith
                                                                    </h6>
                                                                    <span class="text-muted">2d</span>
                                                                </div>
                                                                <div class="reply-body">
                                                                    Lorem ipsum dolor
                                                                    sit,
                                                                    amet
                                                                    consectetur
                                                                    adipisicing
                                                                    elit.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="reply d-flex">
                                                            <div class="flex-shrink-0">
                                                                <div class="avatar avatar-sm rounded-circle ">
                                                                    <img class="avatar-img"
                                                                        src="https://uifaces.co/our-content/donated/6f6p85he.jpg"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                                                <div class="reply-meta d-flex align-items-baseline">
                                                                    <h6 class="mb-0 me-2">
                                                                        James
                                                                        Parsons</h6>
                                                                    <span class="text-muted">1d</span>
                                                                </div>
                                                                <div class="reply-body">
                                                                    Lorem ipsum dolor
                                                                    sit
                                                                    amet,
                                                                    consectetur
                                                                    adipisicing
                                                                    elit. Distinctio
                                                                    dolore
                                                                    sed
                                                                    eos sapiente,
                                                                    praesentium.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                            </div>

                                        </div>
                                        <div class="comment d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar avatar-sm rounded-circle gallery_dd_s">

                                                </div>
                                            </div>
                                            <div class="flex-shrink-1 ms-2 ms-sm-3">
                                                <div class="comment-meta d-flex">
                                                    <h6 class="me-2">Fayaa
                                                    </h6>
                                                    <span class="text-muted">4d</span>
                                                </div>
                                                <div class="comment-body">
                                                    <p>
                                                        <span>Lorem ipsum dolor sit
                                                            amet
                                                            consectetur
                                                            adipisicing elit. Iusto
                                                            laborum
                                                            in
                                                            corrupti dolorum, quas
                                                            delectus
                                                            nobis
                                                            porro accusantium
                                                            molestias
                                                            sequi.</span>
                                                    </p>
                                                    <div class="action">

                                                        <span class="fz_12 text-black-50 cursor_p" id=""
                                                            onclick=" openCommentson(event, 'show_comment_son-2')">
                                                            Trả lời</span>
                                                        <div class="  align-items-center justify-content-between formcomment_son2 lead emoji-picker-container "
                                                            id="show_comment_son-2">
                                                            <form action="" class="d-flex   align-items-center w-100  ">

                                                                <textarea
                                                                    class=" py-0 px-1  rounded-pill formcomment border border-0 form-control textarea-control "
                                                                    data-emojiable="true" data-emoji-input="unicode"
                                                                    rows="1" placeholder="Viết bình luận..."
                                                                    style="resize: none;"></textarea>
                                                            </form>

                                                            <div
                                                                class="pd_2 d-flex   align-items-center justify-content-end ">
                                                                <div
                                                                    class="d-flex   align-items-center justify-content-center mr_5">

                                                                    <div class="fileUpload fileUpload_1 d-flex align-items-center"
                                                                        data-bs-toggle="tooltip" data-placement="top"
                                                                        title="Thêm Ảnh/Video"
                                                                        data-bs-original-title="Biểu tượng cảm xúc">
                                                                        <input type="file" class="upload">
                                                                        <span class="material-icons text-success">
                                                                            add_a_photo
                                                                        </span>
                                                                    </div>

                                                                </div>
                                                                <div
                                                                    class="d-flex   align-items-center justify-content-center ">

                                                                    <span
                                                                        class="material-icons   text-success cursor_p opacity_0"
                                                                        data-bs-toggle="tooltip" data-placement="top"
                                                                        title=""
                                                                        data-bs-original-title="Thêm Ảnh/Video">
                                                                        sentiment_satisfied_alt
                                                                    </span>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php }}?>
                <div class=" d-flex   align-items-center">
                    <div class="avtar_img_section_right_2 pd_2 gallery_dd_s">
                        <!-- <img src="../images/213711859_497523451508257_6355355932146235345_n.jpg"
                                                                alt="" class="rounded-circle border"> -->
                    </div>

                    <div
                        class="d-flex   align-items-center justify-content-between formcomment_dad comments lead emoji-picker-container">
                        <form action="" class="d-flex   align-items-center ">

                            <textarea
                                class=" py-0 px-1  rounded-pill formcomment border border-0 form-control textarea-control "
                                data-emojiable="true" data-emoji-input="unicode" rows="1"
                                placeholder="Viết bình luận..." style="resize: none;"></textarea>
                        </form>

                        <div class="pd_2 d-flex   align-items-center justify-content-end ">
                            <div class="d-flex   align-items-center justify-content-center mr_5">

                                <div class="fileUpload fileUpload_1 d-flex align-items-center" data-bs-toggle="tooltip"
                                    data-placement="top" title="" data-bs-original-title="Thêm Ảnh/Video">
                                    <input type="file" class="upload">
                                    <span class="material-icons text-success">
                                        add_a_photo
                                    </span>
                                </div>

                            </div>
                            <div class="d-flex   align-items-center justify-content-center ">

                                <span class="material-icons   text-success cursor_p opacity_0" style="opacity: 0;"
                                    data-bs-toggle="tooltip" data-placement="top" title="Biểu tượng cảm xúc">
                                    sentiment_satisfied_alt
                                </span>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="sharepost1">
            <div class="modal fade" id="<?php echo "sharepost", $row['postid']; ?>">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content border-0 bg-transparent">

                        <div class="share_dad">
                            <ul class=" d-flex">
                                <li>
                                    <a class="facebook customer share fa fa-facebook"
                                        href="https://www.facebook.com/sharer.php?u=https://ongbata.vn/"
                                        title="Facebook share" target="_blank"></a>
                                </li>

                                <li>
                                    <a class="xing customer share fa fa-linkedin"
                                        href="https://www.xing.com/social_plugins/share?url=https://ongbata.vn/"
                                        title="Xing Share" target="_blank"></a>
                                </li>
                                <li>
                                    <a class="linkedin customer share fa fa-xing"
                                        href="https://www.linkedin.com/shareArticle?mini=https://ongbata.vn/"
                                        title="linkedin Share" target="_blank"></a>
                                </li>
                                <li>
                                    <a href="javascript:;" onclick="window.print()" class="fa fa-printr">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




<!-- khu modal -->
<!-- khu see more of post -->
<div>
    <div class="modal fade " id="<?php echo 'post_sm_', $row['postid']; ?>" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-xxl-down modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body row pd_0 overflow_hidden_pc-none_media-auto">

                    <div class="col-4 media_display position-relative md-width_100 ">
                        <button type="button"
                            class="z_index_10 btn-close bg-light bt_close_sm-media2  rounded-circle pd_10"
                            data-bs-dismiss="modal" aria-label="Close"></button>


                        <div class="d-grid">
                            <div
                                class=" section_right-2_header d-flex justify-content-between align-items-center pd_10 ">
                                <div class="d-flex justify-content-between  align-items-center">
                                    <div class="avtar_img_section_right_2 gallery_dd_s">
                                        <!-- <img src="../images/213711859_497523451508257_6355355932146235345_n.jpg"
                                                                    alt="" class="rounded-circle border"> -->
                                    </div>
                                    <div class="text-center">
                                        <h5 class="fz_16">
                                            <b>
                                                <span>

                                                    <?=$row['lastname'] . " " . $row['firstname'];?>

                                                </span>
                                            </b>
                                        </h5>
                                        <div class="fz_12 d-flex   align-items-center">
                                            <span>
                                                <?php switch (true) {
                    case ($row['numberhour'] == null):
                        echo "NULL";
                        break;
                    case ($row['numberhour'] <= 1):
                        echo "1 giờ trước";
                        break;
                    case ($row['numberhour'] <= 24):
                        echo $row['numberhour'] . " giờ trước";
                        break;
                    case ($row['numberhour'] > 24):
                        echo $row['datecreatepost'];
                        break;
                }
                ?>
                                            </span>
                                            <span class="material-icons">
                                                supervisor_account
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <button class="btn dropdown-toggle button_dr_afet" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">

                                        <span class="material-icons ">
                                            more_horiz
                                        </span>

                                    </button>


                                    <ul class="dropdown-menu  z_index_10">
                                        <li>
                                            <button class="btn d-flex align-items-center fz_12 justify-content-between"
                                                data-bs-toggle="modal" data-bs-target="#them_bai_viet">
                                                <span class="material-icons fz_12 text-black-50">
                                                    drive_file_rename_outline
                                                </span>
                                                <b> <span class="fz_12"> Chỉnh sửa bài viết</span></b>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="btn d-flex align-items-center  justify-content-between">
                                                <span class="material-icons fz_12 text-black-50">
                                                    delete
                                                </span>
                                                <b><span class="fz_12"> Xóa bài viết</span></b>
                                            </button>
                                        </li>



                                    </ul>


                                </div>
                            </div>
                            <div class="pd_10 ">

                                <span><?php echo $row['Title'] ?></span>


                            </div>
                        </div>

                        <div class="section_right-2_footer pd_10 md-pd_0">
                            <div class="d-flex justify-content-between  align-items-center">
                                <div class="fz_14 d-flex justify-content-between  align-items-center md-fz_12">
                                    <?php
$sqlcount = "SELECT postid,count(case when pa.react = 'like' then 1 end) as countlike,
                                                                            count(case when pa.react = 'comment' then 1 end) as countcomment
                                                                                FROM postaction pa where pa.postid = '{$row['pid']}'
                                                                                group by postid";
                $ccountlike = $ccomment = "";
                $resultcount = $connect->query($sqlcount);
                while ($rowcmt = mysqli_fetch_array($resultcount)) {
                    if (isset($rowcmt['countlike'])) {$ccountlike = $rowcmt['countlike'];}
                    if (isset($rowcmt['countcomment'])) {$ccomment = $rowcmt['countcomment'];}
                }
                ?>
                                    <span class="material-icons text-danger">
                                        favorite
                                    </span>
                                    <span class="coutlike">
                                        <?php echo $ccountlike; ?>
                                    </span>
                                </div>
                                <div class="fz_14 md-fz_12">
                                    <span>
                                        <?php echo $ccomment; ?>
                                    </span>
                                    <span>
                                        Bình luận
                                    </span>
                                </div>
                            </div>
                            <div class="row border-bottom mb_20 md-flex">
                                <div
                                    class="col-md-4 d-flex align-items-center justify-content-center md-width_30 md-pd_0">
                                    <button class="btn d-flex align-items-center justify-content-center md-fz_12 fet_data
                                                                            <?php
$sqllikeuser = "SELECT * from postaction where postid = '{$row['pid']}' and membersid = '{$userid}' and react = 'like'";
                $resultlikeuser = mysqli_query($connect, $sqllikeuser);
                if ($resultlikeuser) {
                    $rowlikeuser = mysqli_num_rows($resultlikeuser);
                    if ($rowlikeuser > 0) {
                        echo "liked";
                    }
                }
                ?>" id="like" data-id="<?=$row['pid'];?>" onclick="openToggle(this)">
                                        <span class="material-icons text-success">
                                            favorite
                                        </span>
                                        <span class="db_bl_tg">
                                            Thích
                                        </span>
                                        <span class="dp_none_tg">
                                            Đã thích
                                        </span>
                                    </button>
                                </div>
                                <div
                                    class="col-md-4 d-flex align-items-center justify-content-center md-width_40 md-pd_0">
                                    <button
                                        class="btn d-flex align-items-center justify-content-center md-fz_12 click_show">
                                        <span class="material-icons text-success">
                                            add_comment
                                        </span>
                                        <span>
                                            Bình luận
                                        </span>
                                    </button>
                                </div>
                                <div
                                    class="col-md-4 d-flex align-items-center justify-content-center md-width_30 md-pd_0 ">
                                    <button class="btn d-flex align-items-center justify-content-center md-fz_12"
                                        data-bs-toggle="modal"
                                        data-bs-target="<?php echo '#sharepost', $row['postid']; ?>">
                                        <span class="material-icons text-success">
                                            share
                                        </span>
                                        <span>
                                            Chia sẻ
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="comment_nt_click comment_tg_click comment_tg_click_media" id="comment">
                                <div class="colse_comment">

                                    <button type="button"
                                        class="z_index_10 btn-close bg-light bt_close_sm-media  rounded-circle pd_10 media_display"></button>

                                </div>
                                <?php
$sqlcmt = "SELECT m.firstname,m.lastname,c.* FROM comment c left join members m on c.membersid = m.id
                                                                                where c.postid = '{$row['pid']}'";
                $resultcmt = $connect->query($sqlcmt);
                if (!empty($resultcmt) && $resultcmt->num_rows > 0) {
                    while ($rowcmt = $resultcmt->fetch_assoc()) {
                        ?>

                                <div class="">

                                    <div class="d-flex align-items-center justify-content-center ">
                                        <div class="">

                                            <div class="row justify-content-center mb-4">
                                                <div class="col-lg-12">
                                                    <div class="comments">
                                                        <div class="comment d-flex mb-4">
                                                            <div class="flex-shrink-0">
                                                                <div class="avatar avatar-sm rounded-circle ">
                                                                    <img class="avatar-img"
                                                                        src="https://uifaces.co/our-content/donated/AW-rdWlG.jpg"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                                                <div class="comment-meta d-flex align-items-baseline">
                                                                    <h6 class="me-2">
                                                                        <?=$rowcmt['firstname'] . " " . $rowcmt['lastname'];?>
                                                                    </h6>
                                                                    <span class="text-muted">2d</span>
                                                                </div>
                                                                <div class="comment-body d-grid">
                                                                    <p>
                                                                        <?=$rowcmt['content'];?>
                                                                    </p>
                                                                    <div class="action">

                                                                        <span class="fz_12 text-black-50 cursor_p" id=""
                                                                            onclick=" openCommentson(event, 'show_comment_son-1')">Trả
                                                                            lời</span>
                                                                        <div class="  align-items-center justify-content-between formcomment_son lead emoji-picker-container "
                                                                            id="show_comment_son-1">
                                                                            <form action=""
                                                                                class="d-flex comments   align-items-center w-100">

                                                                                <textarea
                                                                                    class=" py-0 px-1  rounded-pill formcomment border border-0 form-control textarea-control"
                                                                                    rows="1"
                                                                                    placeholder="Viết bình luận..."
                                                                                    style="resize: none;"
                                                                                    data-emojiable="true"
                                                                                    data-emoji-input="unicode"></textarea>
                                                                            </form>

                                                                            <div
                                                                                class="pd_2 d-flex   align-items-center justify-content-end ">
                                                                                <div
                                                                                    class="d-flex   align-items-center justify-content-center">


                                                                                    <div class="fileUpload fileUpload_1 d-flex align-items-center mr_5"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Thêm ảnh/Video"
                                                                                        data-bs-original-title="Biểu tượng cảm xúc">
                                                                                        <input type="file"
                                                                                            class="upload">
                                                                                        <span
                                                                                            class="material-icons text-success">
                                                                                            add_a_photo
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="d-flex   align-items-center justify-content-center opacti_0"
                                                                                    style="opacity: 0;">

                                                                                    <span
                                                                                        class="material-icons   text-success cursor_p"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-placement="top" title=""
                                                                                        data-bs-original-title="Biểu tượng cảm xúc">
                                                                                        sentiment_satisfied_alt
                                                                                    </span>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="comment d-flex">
                                                            <div class="flex-shrink-0">
                                                                <div
                                                                    class="avatar avatar-sm rounded-circle gallery_dd_s">

                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-1 ms-2 ms-sm-3">
                                                                <div class="comment-meta d-flex">
                                                                    <h6 class="me-2">Fayaa
                                                                    </h6>
                                                                    <span class="text-muted">4d</span>
                                                                </div>
                                                                <div class="comment-body">
                                                                    <p>
                                                                        <span>Lorem ipsum dolor sit
                                                                            amet
                                                                            consectetur
                                                                            adipisicing elit. Iusto
                                                                            laborum
                                                                            in
                                                                            corrupti dolorum, quas
                                                                            delectus
                                                                            nobis
                                                                            porro accusantium
                                                                            molestias
                                                                            sequi.</span>
                                                                    </p>
                                                                    <div class="action">

                                                                        <span class="fz_12 text-black-50 cursor_p" id=""
                                                                            onclick=" openCommentson(event, 'show_comment_son-2')">
                                                                            Trả lời</span>
                                                                        <div class="  align-items-center justify-content-between formcomment_son2 lead emoji-picker-container "
                                                                            id="show_comment_son-2">
                                                                            <form action=""
                                                                                class="d-flex   align-items-center w-100  ">

                                                                                <textarea
                                                                                    class=" py-0 px-1  rounded-pill formcomment border border-0 form-control textarea-control "
                                                                                    data-emojiable="true"
                                                                                    data-emoji-input="unicode" rows="1"
                                                                                    placeholder="Viết bình luận..."
                                                                                    style="resize: none;"></textarea>
                                                                            </form>

                                                                            <div
                                                                                class="pd_2 d-flex   align-items-center justify-content-end ">
                                                                                <div
                                                                                    class="d-flex   align-items-center justify-content-center mr_5">

                                                                                    <div class="fileUpload fileUpload_1 d-flex align-items-center"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Thêm Ảnh/Video"
                                                                                        data-bs-original-title="Biểu tượng cảm xúc">
                                                                                        <input type="file"
                                                                                            class="upload">
                                                                                        <span
                                                                                            class="material-icons text-success">
                                                                                            add_a_photo
                                                                                        </span>
                                                                                    </div>

                                                                                </div>
                                                                                <div
                                                                                    class="d-flex   align-items-center justify-content-center ">

                                                                                    <span
                                                                                        class="material-icons   text-success cursor_p opacity_0"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-placement="top" title=""
                                                                                        data-bs-original-title="Thêm Ảnh/Video">
                                                                                        sentiment_satisfied_alt
                                                                                    </span>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php }}?>
                                <div class=" d-flex   align-items-center">
                                    <div class="avtar_img_section_right_2 pd_2 gallery_dd_s">
                                        <!-- <img src="../images/213711859_497523451508257_6355355932146235345_n.jpg"
                                                                                                                alt="" class="rounded-circle border"> -->
                                    </div>

                                    <div
                                        class="d-flex   align-items-center justify-content-between formcomment_dad comments lead emoji-picker-container">
                                        <form action="" class="d-flex   align-items-center ">

                                            <textarea
                                                class=" py-0 px-1  rounded-pill formcomment border border-0 form-control textarea-control "
                                                data-emojiable="true" data-emoji-input="unicode" rows="1"
                                                placeholder="Viết bình luận..." style="resize: none;"></textarea>
                                        </form>

                                        <div class="pd_2 d-flex   align-items-center justify-content-end ">
                                            <div class="d-flex   align-items-center justify-content-center mr_5">

                                                <div class="fileUpload fileUpload_1 d-flex align-items-center"
                                                    data-bs-toggle="tooltip" data-placement="top" title=""
                                                    data-bs-original-title="Thêm Ảnh/Video">
                                                    <input type="file" class="upload">
                                                    <span class="material-icons text-success">
                                                        add_a_photo
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="d-flex   align-items-center justify-content-center ">

                                                <span class="material-icons   text-success cursor_p opacity_0"
                                                    style="opacity: 0;" data-bs-toggle="tooltip" data-placement="top"
                                                    title="Biểu tượng cảm xúc">
                                                    sentiment_satisfied_alt
                                                </span>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-8 slide_sm_left md-width_100 md-pd_0">

                        <div id="<?php echo "carouselExampleControls_see_more_post", $row['pid']; ?>"
                            class="carousel slide slide_sm_son" data-bs-touch="false" data-bs-interval="false"
                            data-interval="false">
                            <button type="button"
                                class=" z_index_10 btn-close bg-light bt_close_sm position-absolute top-0 start-0 rounded-circle pd_10 pc_display"
                                data-bs-dismiss="modal" aria-label="Close"></button>

                            <div class="carousel-inner see_more_of_post">
                                <!-- show img more div -->
                                <div class="carousel-item <?php echo 'image1' ?> active">
                                    <div class="wrapper wrapper_sm">
                                        <div data-fullScreen class=fullScreen-1>
                                            <div class="wrapper <?php echo 'check_anh'; ?>">
                                                <div data-fullScreen class="fullScreen-1 ">
                                                    <div class="see-more_img <?php echo 'add_add'; ?>">
                                                        <img src="" class="anh_fullscren cursor_p" alt="">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="media-wrapper <?php echo 'check_video'; ?>">
                                                <video id="player1" width="640" height="360" style="max-width:100%;"
                                                    poster="https://media.istockphoto.com/videos/movie-time-concept-background-video-id1127766856?s=640x640"
                                                    preload="none" controls playsinline webkit-playsinline>
                                                    <source src="" type="video/mp4">
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev  slide_prev_sm pc_display" type="button"
                                data-bs-target="<?php echo "#carouselExampleControls_see_more_post", $row['pid']; ?>"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon rounded-circle bg-dark pd_20 "
                                    aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next slide_next_sm pc_display" type="button"
                                data-bs-target="<?php echo "#carouselExampleControls_see_more_post", $row['pid']; ?>"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon rounded-circle bg-dark pd_20 "
                                    aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>

                        </div>
                    </div>
                    <div class="col-4 pc_display">
                        <div class="d-grid">
                            <div
                                class=" section_right-2_header d-flex justify-content-between align-items-center pd_10 ">
                                <div class="d-flex justify-content-between  align-items-center">
                                    <div class="avtar_img_section_right_2 gallery_dd_s">

                                    </div>
                                    <div class="text-center">
                                        <h5 class="fz_16">
                                            <b>
                                                <span>
                                                    <?=$row['lastname'] . " " . $row['firstname'];?>
                                                </span>
                                            </b>
                                        </h5>
                                        <div class="fz_12 d-flex   align-items-center">
                                            <span>
                                                <?php switch (true) {
                    case ($row['numberhour'] == null):
                        echo "NULL";
                        break;
                    case ($row['numberhour'] <= 1):
                        echo "1 giờ trước";
                        break;
                    case ($row['numberhour'] <= 24):
                        echo $row['numberhour'] . " giờ trước";
                        break;
                    case ($row['numberhour'] > 24):
                        echo $row['datecreatepost'];
                        break;
                }
                ?>
                                            </span>
                                            <span class="material-icons">
                                                supervisor_account
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <button class="btn dropdown-toggle button_dr_afet" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">

                                        <span class="material-icons ">
                                            more_horiz
                                        </span>

                                    </button>


                                    <ul class="dropdown-menu  z_index_10">
                                        <li>
                                            <button class="btn d-flex align-items-center fz_12 justify-content-between"
                                                data-bs-toggle="modal" data-bs-target="#them_bai_viet">
                                                <span class="material-icons fz_12 text-black-50">
                                                    drive_file_rename_outline
                                                </span>
                                                <b> <span class="fz_12"> Chỉnh sửa bài viết</span></b>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="btn d-flex align-items-center  justify-content-between">
                                                <span class="material-icons fz_12 text-black-50">
                                                    delete
                                                </span>
                                                <b><span class="fz_12"> Xóa bài viết</span></b>
                                            </button>
                                        </li>



                                    </ul>


                                </div>
                            </div>
                            <div class="pd_10 ">
                                <span>
                                    <?php echo $row['Title'] ?>
                                </span>

                            </div>
                        </div>

                        <div class="section_right-2_footer pd_10 ">
                            <div class="d-flex justify-content-between  align-items-center">
                                <div class="fz_14 d-flex justify-content-between  align-items-center md-fz_12">
                                    <?php
$sqlcount = "SELECT postid,count(case when pa.react = 'like' then 1 end) as countlike,
                                                                        count(case when pa.react = 'comment' then 1 end) as countcomment
                                                                            FROM postaction pa where pa.postid = '{$row['pid']}'
                                                                            group by postid";
                $ccountlike = $ccomment = "";
                $resultcount = $connect->query($sqlcount);
                while ($rowcmt = mysqli_fetch_array($resultcount)) {
                    if (isset($rowcmt['countlike'])) {$ccountlike = $rowcmt['countlike'];}
                    if (isset($rowcmt['countcomment'])) {$ccomment = $rowcmt['countcomment'];}
                }
                ?>
                                    <span class="material-icons text-danger">
                                        favorite
                                    </span>
                                    <span class="coutlike">
                                        <?php echo $ccountlike; ?>
                                    </span>
                                </div>
                                <div class="fz_14 md-fz_12">
                                    <span>
                                        <?php echo $ccomment; ?>
                                    </span>
                                    <span>
                                        Bình luận
                                    </span>
                                </div>
                            </div>
                            <div class="row border-bottom mb_20 md-flex">
                                <div
                                    class="col-md-4 d-flex align-items-center justify-content-center md-width_30 md-pd_0">
                                    <button class="btn d-flex align-items-center justify-content-center md-fz_12 fet_data
                                                                        <?php
$sqllikeuser = "SELECT * from postaction where postid = '{$row['pid']}' and membersid = '{$userid}' and react = 'like'";
                $resultlikeuser = mysqli_query($connect, $sqllikeuser);
                if ($resultlikeuser) {
                    $rowlikeuser = mysqli_num_rows($resultlikeuser);
                    if ($rowlikeuser > 0) {
                        echo "liked";
                    }
                }
                ?>" id="like" data-id="<?=$row['pid'];?>" onclick="openToggle(this)">
                                        <span class="material-icons text-success">
                                            favorite
                                        </span>
                                        <span class="db_bl_tg">
                                            Thích
                                        </span>
                                        <span class="dp_none_tg">
                                            Đã thích
                                        </span>
                                    </button>
                                </div>
                                <div
                                    class="col-md-4 d-flex align-items-center justify-content-center md-width_40 md-pd_0">
                                    <button
                                        class="btn d-flex align-items-center justify-content-center md-fz_12 click_show">
                                        <span class="material-icons text-success">
                                            add_comment
                                        </span>
                                        <span>
                                            Bình luận
                                        </span>
                                    </button>
                                </div>
                                <div
                                    class="col-md-4 d-flex align-items-center justify-content-center md-width_30 md-pd_0 ">
                                    <button class="btn d-flex align-items-center justify-content-center md-fz_12"
                                        data-bs-toggle="modal"
                                        data-bs-target="<?php echo '#sharepost', $row['postid'] ?>">
                                        <span class="material-icons text-success">
                                            share
                                        </span>
                                        <span>
                                            Chia sẻ
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="comment_nt_click comment_tg_click" id="comment">
                                <div class=" d-flex   align-items-center">
                                    <div class="avtar_img_section_right_2 pd_2 gallery_dd_s">

                                    </div>

                                    <div
                                        class="d-flex   align-items-center justify-content-between formcomment_dad comments lead emoji-picker-container">
                                        <form action="" class="d-flex   align-items-center ">

                                            <textarea
                                                class=" py-0 px-1  rounded-pill formcomment border border-0 form-control textarea-control "
                                                data-emojiable="true" data-emoji-input="unicode" rows="1"
                                                placeholder="Viết bình luận..." style="resize: none;"></textarea>
                                        </form>

                                        <div class="pd_2 d-flex   align-items-center justify-content-end ">
                                            <div class="d-flex   align-items-center justify-content-center mr_5">

                                                <div class="fileUpload fileUpload_1 d-flex align-items-center"
                                                    data-bs-toggle="tooltip" data-placement="top" title=""
                                                    data-bs-original-title="Thêm Ảnh/Video">
                                                    <input type="file" class="upload">
                                                    <span class="material-icons text-success">
                                                        add_a_photo
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="d-flex   align-items-center justify-content-center ">

                                                <span class="material-icons   text-success cursor_p opacity_0"
                                                    style="opacity: 0;" data-bs-toggle="tooltip" data-placement="top"
                                                    title="Biểu tượng cảm xúc">
                                                    sentiment_satisfied_alt
                                                </span>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php
$sqlcmt = "SELECT m.firstname,m.lastname,c.* FROM comment c left join members m on c.membersid = m.id
                                                                                where c.postid = '{$row['pid']}'";
                $resultcmt = $connect->query($sqlcmt);
                if (!empty($resultcmt) && $resultcmt->num_rows > 0) {
                    while ($rowcmt = $resultcmt->fetch_assoc()) {
                        ?>

                                <div class="overflow-auto max-height-vh50">
                                    <div class="d-flex align-items-center justify-content-center ">
                                        <div class="">

                                            <div class="row justify-content-center mb-4">
                                                <div class="col-lg-12">
                                                    <div class="comments">
                                                        <div class="comment d-flex mb-4">
                                                            <div class="flex-shrink-0">
                                                                <div class="avatar avatar-sm rounded-circle ">
                                                                    <img class="avatar-img"
                                                                        src="https://uifaces.co/our-content/donated/AW-rdWlG.jpg"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                                                <div class="comment-meta d-flex align-items-baseline">
                                                                    <h6 class="me-2">
                                                                        <?=$rowcmt['firstname'] . " " . $rowcmt['lastname'];?>
                                                                    </h6>
                                                                    <span class="text-muted">2d</span>
                                                                </div>
                                                                <div class="comment-body d-grid">
                                                                    <p>
                                                                        <?=$rowcmt['content'];?>
                                                                    </p>
                                                                    <div class="action">

                                                                        <span class="fz_12 text-black-50 cursor_p" id=""
                                                                            onclick=" openCommentson(event, 'show_comment_son-1')">Trả
                                                                            lời</span>
                                                                        <div class="  align-items-center justify-content-between formcomment_son lead emoji-picker-container "
                                                                            id="show_comment_son-1">
                                                                            <form action=""
                                                                                class="d-flex comments   align-items-center w-100">

                                                                                <textarea
                                                                                    class=" py-0 px-1  rounded-pill formcomment border border-0 form-control textarea-control"
                                                                                    rows="1"
                                                                                    placeholder="Viết bình luận..."
                                                                                    style="resize: none;"
                                                                                    data-emojiable="true"
                                                                                    data-emoji-input="unicode"></textarea>
                                                                            </form>

                                                                            <div
                                                                                class="pd_2 d-flex   align-items-center justify-content-end ">
                                                                                <div
                                                                                    class="d-flex   align-items-center justify-content-center">


                                                                                    <div class="fileUpload fileUpload_1 d-flex align-items-center mr_5"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Thêm ảnh/Video"
                                                                                        data-bs-original-title="Biểu tượng cảm xúc">
                                                                                        <input type="file"
                                                                                            class="upload">
                                                                                        <span
                                                                                            class="material-icons text-success">
                                                                                            add_a_photo
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="d-flex   align-items-center justify-content-center opacti_0"
                                                                                    style="opacity: 0;">

                                                                                    <span
                                                                                        class="material-icons   text-success cursor_p"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-placement="top" title=""
                                                                                        data-bs-original-title="Biểu tượng cảm xúc">
                                                                                        sentiment_satisfied_alt
                                                                                    </span>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- relay cmt -->
                                                                <!-- <div class="comment-replies bg-light p-3 mt-3 rounded">
                                                                                                        <h6
                                                                                                            class="comment-replies-title mb-4 text-muted text-uppercase">
                                                                                                            2 replies</h6>

                                                                                                        <div class="reply d-flex mb-4">
                                                                                                            <div class="flex-shrink-0">
                                                                                                                <div class="avatar avatar-sm rounded-circle">
                                                                                                                    <img class="avatar-img"
                                                                                                                        src="https://images.unsplash.com/photo-1501325087108-ae3ee3fad52f?ixlib=rb-0.3.5&q=80&fm=jpg&crop=faces&fit=crop&h=200&w=200&s=f7f448c2a70154ef85786cf3e4581e4b"
                                                                                                                        alt="">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                                                                                                <div class="reply-meta d-flex align-items-baseline">
                                                                                                                    <h6 class="mb-0 me-2">
                                                                                                                        Brandon Smith
                                                                                                                    </h6>
                                                                                                                    <span class="text-muted">2d</span>
                                                                                                                </div>
                                                                                                                <div class="reply-body">
                                                                                                                    Lorem ipsum dolor
                                                                                                                    sit,
                                                                                                                    amet
                                                                                                                    consectetur
                                                                                                                    adipisicing
                                                                                                                    elit.
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="reply d-flex">
                                                                                                            <div class="flex-shrink-0">
                                                                                                                <div class="avatar avatar-sm rounded-circle ">
                                                                                                                    <img class="avatar-img"
                                                                                                                        src="https://uifaces.co/our-content/donated/6f6p85he.jpg"
                                                                                                                        alt="">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                                                                                                <div class="reply-meta d-flex align-items-baseline">
                                                                                                                    <h6 class="mb-0 me-2">
                                                                                                                        James
                                                                                                                        Parsons</h6>
                                                                                                                    <span class="text-muted">1d</span>
                                                                                                                </div>
                                                                                                                <div class="reply-body">
                                                                                                                    Lorem ipsum dolor
                                                                                                                    sit
                                                                                                                    amet,
                                                                                                                    consectetur
                                                                                                                    adipisicing
                                                                                                                    elit. Distinctio
                                                                                                                    dolore
                                                                                                                    sed
                                                                                                                    eos sapiente,
                                                                                                                    praesentium.
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div> -->
                                                            </div>

                                                        </div>
                                                        <div class="comment d-flex">
                                                            <div class="flex-shrink-0">
                                                                <div
                                                                    class="avatar avatar-sm rounded-circle gallery_dd_s">

                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-1 ms-2 ms-sm-3">
                                                                <div class="comment-meta d-flex">
                                                                    <h6 class="me-2">Fayaa
                                                                    </h6>
                                                                    <span class="text-muted">4d</span>
                                                                </div>
                                                                <div class="comment-body">
                                                                    <p>
                                                                        <span>Lorem ipsum dolor sit
                                                                            amet
                                                                            consectetur
                                                                            adipisicing elit. Iusto
                                                                            laborum
                                                                            in
                                                                            corrupti dolorum, quas
                                                                            delectus
                                                                            nobis
                                                                            porro accusantium
                                                                            molestias
                                                                            sequi.</span>
                                                                    </p>
                                                                    <div class="action">

                                                                        <span class="fz_12 text-black-50 cursor_p" id=""
                                                                            onclick=" openCommentson(event, 'show_comment_son-2')">
                                                                            Trả lời</span>
                                                                        <div class="  align-items-center justify-content-between formcomment_son2 lead emoji-picker-container "
                                                                            id="show_comment_son-2">
                                                                            <form action=""
                                                                                class="d-flex   align-items-center w-100  ">

                                                                                <textarea
                                                                                    class=" py-0 px-1  rounded-pill formcomment border border-0 form-control textarea-control "
                                                                                    data-emojiable="true"
                                                                                    data-emoji-input="unicode" rows="1"
                                                                                    placeholder="Viết bình luận..."
                                                                                    style="resize: none;"></textarea>
                                                                            </form>

                                                                            <div
                                                                                class="pd_2 d-flex   align-items-center justify-content-end ">
                                                                                <div
                                                                                    class="d-flex   align-items-center justify-content-center mr_5">

                                                                                    <div class="fileUpload fileUpload_1 d-flex align-items-center"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Thêm Ảnh/Video"
                                                                                        data-bs-original-title="Biểu tượng cảm xúc">
                                                                                        <input type="file"
                                                                                            class="upload">
                                                                                        <span
                                                                                            class="material-icons text-success">
                                                                                            add_a_photo
                                                                                        </span>
                                                                                    </div>

                                                                                </div>
                                                                                <div
                                                                                    class="d-flex   align-items-center justify-content-center ">

                                                                                    <span
                                                                                        class="material-icons   text-success cursor_p opacity_0"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-placement="top" title=""
                                                                                        data-bs-original-title="Thêm Ảnh/Video">
                                                                                        sentiment_satisfied_alt
                                                                                    </span>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php }}?>

                            </div>
                        </div>

                    </div>


                </div>

            </div>
        </div>
    </div>
    <?php
}
        }
    }
}
function checkdata($data)
{
    $data = trim($data);
    return $data;
}

if (isset($_POST['method'])) {
    $method = $_POST['method'];
    switch ($method) {
        case "createpost":
            $Postcontent = checkdata($_POST['Postcontent']);
            $fileimgpost = checkdata($_POST['fileimgpost']);

            $sqlinsert = "INSERT INTO `post`(`membersid`, `Title`,`datecreate`) VALUES ('{$userid}','{$Postcontent}',unix_timestamp())";
            if (mysqli_query($connect, $sqlinsert)) {
                $last_id = mysqli_insert_id($connect);
                if ($fileimgpost == 'true') {
                    $result_data['success'] = true;
                    $result_data['lastid'] = $last_id;

                } else {
                    $result_data['success'] = true;
                    $result_data['lastid'] = "";
                }

            } else {
                $result_data['success'] = false;
                $result_data['name'] = $connect->error;
            }
            echo json_encode($result_data);
            break;
        case "deletepost":
            $sqlimgdataarray = $result = $fileNameimg = $row = null;
            $result_data = array();
            $imgdataarray = array();
            $delpostid = checkdata($_POST['delpostid']);
            //check img from gallery
            $sqlimgdataarray = "SELECT url FROM gallery WHERE postid = '{$delpostid}'";
            $result = $connect->query($sqlimgdataarray);
            if (!empty($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (isset($row['url'])) {array_push($imgdataarray, $row['url']);}
                }
            }

            // xoá ảnh post
            $sqldelgalarry = "DELETE FROM gallery WHERE postid = '{$delpostid}'";
            $connect->query($sqldelgalarry);
            // xoá like ảnh và bình luận
            $sqldelpostaction = "DELETE FROM postaction WHERE postid = '{$delpostid}'";
            $connect->query($sqldelpostaction);
            // delete cmt
            $sqldelpostcmt = "DELETE FROM comment WHERE postid = '{$delpostid}'";
            $connect->query($sqldelpostcmt);
            // delete post
            $sqldelpost = "DELETE FROM post WHERE id = '{$delpostid}'";
            $connect->query($sqldelpost);
            if (mysqli_query($connect, $sqldelpost)) {
                $result_data['success'] = true;
                //delete img AWS3
                if ($imgdataarray != null) {
                    foreach ($imgdataarray as $key => $val) {
                        $fileNameimg = $imgdataarray[$key];
                        deletedataAWS3($fileNameimg, $s3);
                    }
                }

            } else {
                $result_data['success'] = false;
                $result_data['name'] = $connect->error;
            }
            echo json_encode($result_data);
            break;
        case "likepost":
            $result_data = array();
            $sqllikeuser = $resultlikeuser = $rowlikeuser = 0;
            $likepostid = checkdata($_POST['likepostid']);
            $sqllikeuser = "SELECT * from postaction where postid = '{$likepostid}' and membersid = '{$userid}' and react = 'like'";
            $resultlikeuser = mysqli_query($connect, $sqllikeuser);
            if ($resultlikeuser) {
                $rowlikeuser = mysqli_num_rows($resultlikeuser);
                if ($rowlikeuser > 0) {
                    $sqlfunctionlike = "DELETE FROM postaction WHERE postid = '{$likepostid}' and membersid = '{$userid}' and react = 'like'";
                    $sqlresultfunctionlike = mysqli_query($connect, $sqlfunctionlike);
                    if ($sqlresultfunctionlike) {
                        $result_data['success'] = true;
                        $result_data['name'] = 'unlike';
                    } else {
                        $result_data['success'] = false;
                        $result_data['name'] = $connect->error;
                    }
                } else {
                    $sqlfunctionlike = "INSERT INTO `postaction`(`postid`, `membersid`, `react`) VALUES ('{$likepostid}','{$userid}','like')";
                    $sqlresultfunctionlike = mysqli_query($connect, $sqlfunctionlike);
                    if ($sqlresultfunctionlike) {
                        $result_data['success'] = true;
                        $result_data['name'] = 'like';

                    } else {
                        $result_data['success'] = false;
                        $result_data['name'] = $connect->error;
                    }
                }
            }
            echo json_encode($result_data);
            break;
        case "loaddataeditform":
            $result_data = array();
            $filedata = array();
            $Postid = checkdata($_POST['postid']);
            $sqlloadata = "SELECT p.id as pid,p.*,g.* FROM `post` p LEFT JOIN gallery g on p.id = g.postid WHERE p.id = '{$Postid}'";
            $result = $connect->query($sqlloadata);
            if (!empty($result) && $result->num_rows > 0) {
                while ($rowloaddata = $result->fetch_assoc()) {
                    if (isset($rowloaddata['pid'])) {$result_data['id'] = $rowloaddata['pid'];}
                    if (isset($rowloaddata['Title'])) {$result_data['content'] = $rowloaddata['Title'];}
                    if (isset($rowloaddata['url'])) {$result_data['name'] = $rowloaddata['url'];}
                    if (isset($rowloaddata['isvideo'])) {$result_data['isvideo'] = $rowloaddata['isvideo'];}
                    array_push($filedata, $result_data);
                }
            }
            echo json_encode($filedata);
            break;
        case "updatepost":
            $result_data = array();
            $Postcontent = $postidupdate = 0;
            $Postcontent = checkdata($_POST['Postcontent']);
            $postidupdate = checkdata($_POST['postid']);

            $sqlupdatepost = "UPDATE `post` SET Title= '{$Postcontent}' Where id = {$postidupdate}";
            $sqlresultupdatepost = mysqli_query($connect, $sqlupdatepost);

            if ($sqlresultupdatepost) {
                $result_data['success'] = true;
            } else {
                $result_data['success'] = false;
                $result_data['name'] = $connect->error;
            }
            echo json_encode($result_data);
            break;
        case "deleteimggal":
            $lastidimg = $fileNameimg = $sqlinsertimgpost = 0;
            if (isset($_POST['id'])) {$lastidimg = $_POST['id'];}
            if (isset($_POST['filesdelete'])) {
                foreach ($_POST['filesdelete'] as $key => $val) {
                    // File upload path
                    $fileNameimg = $_POST['filesdelete'][$key];
                    $sqlinsertimgpost = "DELETE FROM `gallery` WHERE postid = {$lastidimg} and url = '{$fileNameimg}'";
                    $connect->query($sqlinsertimgpost);
                    deletedataAWS3($fileNameimg, $s3);
                }
            }
            break;

    }

}
if (isset($_FILES['files'])) {
    $fileNameimg = $tempfileimg = $sqlinsertimgpost = null;
    if (isset($_POST['id'])) {$lastidimg = $_POST['id'];}
    foreach ($_FILES['files']['name'] as $key => $val) {
        // File upload path
        $fileNameimg = $_FILES['files']['name'][$key];
        $tempfileimg = $_FILES['files']['tmp_name'][$key];
        //check file type
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $file_type = $finfo->file($tempfileimg);
        if (array_key_exists($file_type, $fileExtensionvideo)) {
            $sqlinsertimgpost = "INSERT INTO `gallery`(`postid`, `url`,`isvideo`,`datecreate`) VALUES ('{$lastidimg}','{$fileNameimg}','1',unix_timestamp())";
            $connect->query($sqlinsertimgpost);
            // move_uploaded_file($_FILES['files']['tmp_name'][$key], $path . $fileNameimg);
            UploaddataAWS3($fileNameimg, $tempfileimg, $s3);
        } else {
            // echo $fileName;
            $sqlinsertimgpost = "INSERT INTO `gallery`(`postid`, `url`, `datecreate`) VALUES ('{$lastidimg}','{$fileNameimg}',unix_timestamp())";
            $connect->query($sqlinsertimgpost);
            // move_uploaded_file($_FILES['files']['tmp_name'][$key], $path . $fileNameimg);
            UploaddataAWS3($fileNameimg, $tempfileimg, $s3);
        }

    }
}

?>