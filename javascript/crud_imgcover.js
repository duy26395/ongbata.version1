$(document).ready(function () {
    $(document).on('change', '#multipleFile3', function () {
        var file_data = document.getElementById('multipleFile3')
        var form_data = new FormData();

        if (checkfileimg(file_data)) {
            for (var i = 0; i < file_data.files.length; i++) {
                form_data.append('multipleFile3[]', file_data.files.item(i));
            }
        } else {
            alert("wrong format");
            $("#multipleFile3").val('');
        }
        //khởi tạo đối tượng form data
        form_data.append("method", "Uploadimgcover")
        var insert = {
            Postcontent: "Cập nhật ảnh bìa",
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
                            form_data.append("id",data.lastid)
                            $.ajax({
                                url: '../process/coverimg.php',
                                dataType: 'text',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',
                                success: function () { 
                                    fetchData();
                                    $("#multipleFile3").val("");
                                    $(".load_sussce").show().delay(5000).fadeOut();                                 
                                    $('#anh_bia_tab3').load("../index/fecth_anh_bia_tab3.php").fadeIn("slow");
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

    // Fetch Data from Database
    function fetchData() {
        $.ajax({
            url: '../process/coverimg.php',
            type: "POST",
            cache: false,
            data: {
                method: 'Loadingcover'
            },
            success: function (data) {
                $(".gallery_bia").html(data);
            }
        });
        $.ajax({
            url : "../index/fecth_anh_bia_tab3.php",
            type : "POST",
            cache: false,
            success:function(data){
            $("#anh_bia_tab3").html(data);
            }
        });
        
        $.ajax({
            url : "../index/fecth_anh_bia_modal.php",
            type : "POST",
            cache: false,
            success:function(data){
            $("#anh_bia_modal").html(data);
            }
        });
        
        

    }
    fetchData();
})