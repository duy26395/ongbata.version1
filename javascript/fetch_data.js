$.ajax({
    url : "../index/fetch_video_tab3.php",
    type : "POST",
    cache: false,
    success:function(data){
    $("#video").html(data);
    }
});
$(document).on('click', '.fetch_anh,.tab_3', function() {
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
});
$(document).on('click', '.fetch_anh3,.tab_3', function() {
    function fetchData(){
  
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
        $.ajax({
            url : "../index/fetch_video_tab3.php",
            type : "POST",
            cache: false,
            success:function(data){
            $("#video").html(data);
            $("#video").load("../index/fetch_video_tab3.php");
            }
        });
        
        }
        fetchData();
        loadlibrary();
        loadlibraryson();
});
$(document).on('click', '.tab_home,.fet_data', function() {
    function fetchData(){
     
        $.ajax({
            url : "../Process/Post.php",
            type : "POST",
            cache: false,
            success:function(data){
            $("#anh_bia_tab3").html(data);
            }
        });
        $.ajax({
            url : "../index/fetch_anh_modal_tab1.php",
            type : "POST",
            cache: false,
            success:function(data){
            $("#anh_nho_tab1").html(data);
            }
        });
        $.ajax({
            url: '../process/Post.php',
            type: 'POST',
            // data: loadstatuspost,
            // dataType: 'json',
            cache: false,
            success: function (data) {
                if (data.success == false) {
                    alert(data.name);
                } else {
                    
                }
            }
        })
    
        
        }
        fetchData();
        function Loadstatuspost(){
            var loadstatuspost = {
                method: 'loadstatuspost'
            }
            $.ajax({
                url: '../process/Post.php',
                type: 'POST',
                data: loadstatuspost,
                dataType: 'json',
                cache: false,
                success: function (data) {
                    if (data.success == false) {
                        alert(data.name);
                    } else {
                        
                    }
                }
            })
        }
        Loadstatuspost();
});