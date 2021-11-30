$(document).ready(function () {
    $(document).on('change', '#multipleFile_tab3', function () {
        var count_file = $(this)[0].files.length;
        var file_data = document.getElementById('multipleFile_tab3')
        var form_data = new FormData();

        if (checkfileimg(file_data)) {
            for (var i = 0; i < file_data.files.length; i++) {
                form_data.append('multipleFile3[]', file_data.files.item(i));
            }
        } else {
            alert("wrong format");
            $("#multipleFile_tab3").val('');
            return;
        }
        //khởi tạo đối tượng form data
        form_data.append("method", "Uploadimgcover")
        var insert = {
            Postcontent: "Thêm "+count_file+" ảnh",
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
                                url: '../process/upload_anh_baiviet.php',
                                dataType: 'text',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',
                                success: function () { 
                                    $("#multipleFile_tab3").val("");
                                    $(".load_sussce").show().delay(5000).fadeOut();
                                    $(".check_anh8,.check_video7,.check_video9,.check_video10").remove();
                                    $('#anh_cua_ban_tab3').load("../index/fecth_anh_cua_ban.php").fadeIn("slow");
                                    fetchData();
                                }
                            });
                        }
                    })
                }
            }
        });
    });
    function fetchData(){
  
        $.ajax({
            url : "../index/fecth_anh_cua_ban.php",
            type : "POST",
            cache: false,
            success:function(data){
            $("#anh_cua_ban_tab3").html(data);
            }
        });

        $.ajax({
            url : "../index/fecth_anh_cua_ban_modal.php",
            type : "POST",
            cache: false,
            success:function(data){
            $("#anh_cua_ban_modal").html(data);
            }
        });
        
        }
        fetchData();
   
})