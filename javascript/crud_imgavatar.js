
    function Loadavatarimg() {
        $.ajax({
            url: '../process/avatarimg.php',
            type: "POST",
            data: {
                method: 'Loadingimgavatardad'
            },
            cache: false,
            success: function (data) {
                $(document).ready(function () {
                $(".gallery_dd_big").html(data);
              
                })
            }
        });
        $.ajax({
            url: '../process/avatarimg.php',
            type: "POST",
            data: { 
                method: 'Loadingimgavatarson'
            },
            cache: false,
            success: function (data) {
                $(document).ready(function () {
               
                $(".gallery_dd_s").html(data);
                })
            }
        });
        $.ajax({
            url: '../index/fetch_anh_dai_dien_tab3.php',
            type: "POST",
            data: { 
                method: 'Loadingimgavatarson'
            },
            cache: false,
            success: function (data) {
                $(document).ready(function () {
               
                $("#gallery_dd_tab3").html(data);
                })
            }
        });
            $.ajax({
            url: "../index/fetch_anh_modal_tab1.php",
            type: "POST",
            cache: false,
            success: function(data) {
                $("#anh_nho_tab1").html(data);
            }
        });

    }
    Loadavatarimg();
    $(document).ready(function () {

    $(document).on('change', '#multipleFile2', function () {
     
        var file_data = document.getElementById('multipleFile2')
        var form_data = new FormData();

        if (checkfileimg(file_data)) {
            for (var i = 0; i < file_data.files.length; i++) {
                form_data.append('multipleFile3[]', file_data.files.item(i));
            }
        } else {
            alert("wrong format");
            $("#multipleFile2").val('');
        }
        //khởi tạo đối tượng form data
        form_data.append("method", "Uploadimgavatar")
        var insert = {
            Postcontent: "Cập nhật ảnh đại diện",
            fileimgpost: "true",
            method: 'createpost'
        }
        //thêm files vào trong form data
        $.ajax({
            url: '../process/Post.php',
            type: "POST",
            cache: false,
            data: insert,
            dataType: 'json',
            success: function (data) {
                if (data.success == false) {
                    alert(data.name);
                } else {
                    $(document).ready(function () {
                        $("#success").show();
                        if (data.lastid != null) {
                            form_data.append("id", data.lastid)
                            $.ajax({
                                url: '../process/avatarimg.php',
                                dataType: 'text',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',
                                success: function () {
                                    Loadavatarimg();
                                    $("#multipleFile2").val("");
                                    $(".add_add9").addClass("rounded-circle  border border-3 border-white");
                                    $(".add_add9").parent().addClass("bg-light bg-gradient pd_15 d-flex justify-content-center");
                                    $(".load_sussce").show().delay(5000).fadeOut();
                                    $('#gallery_dd_tab3').load("../index/fetch_anh_dai_dien_tab3.php").fadeIn("slow");
                                    reload();
                                    $(".check_anh8,.check_video7,.check_video9,.check_video10").remove();
                                }
                            });
                        }
                    })
                }
            }
        });
    });


})
