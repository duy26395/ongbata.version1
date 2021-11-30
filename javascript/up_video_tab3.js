$(document).ready(function () {
  $(document).on('change', '#multipleVideo', function () {
      var count_file = $(this)[0].files.length;
      var file_data = document.getElementById('multipleVideo')
      var form_data = new FormData();
      var file = this.files[0];
      var  fileType = file['type'];
      var validvideo = ['video/ogg', 'video/mp4', 'video/webm','video/x-matroska'];
      if (validvideo .includes(fileType)) {
        for (var i = 0; i < file_data.files.length; i++) {
          form_data.append('multipleFile3[]', file_data.files.item(i));
          }
      }
      else {
          alert("wrong format");
          $("#multipleVideo").val('');
          return;
      }
      //khởi tạo đối tượng form data
      form_data.append("method", "Uploadimgcover")
      var insert = {
          Postcontent: "Thêm "+count_file+" Video",
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
                              url: '../process/upload_video_tab3.php',
                              dataType: 'text',
                              cache: false,
                              contentType: false,
                              processData: false,
                              data: form_data,
                              type: 'post',
                              success: function () { 
                                //   $("#multipleVideo").val("");
                                //   $('#video').load("../process/upload_video_tab3.php").fadeIn("slow");
                                  $(".check_anh8,.check_video7,.check_video9,.check_video10").remove();
                                  $(".load_sussce").show().delay(5000).fadeOut();
                                  fetchData();
                                  
                              }
                          });
                      }
                  })
              }
          }
      });
  });
  // setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
  //   $('#list_posts').load("../process/Post.php").fadeIn("slow");
  //   //load() method fetch data from fetch.php page
  //  }, 30000);
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
      $.ajax({
        url : "../index/fetch_video_tab3.php",
        type : "POST",
        cache: false,
        success:function(data){
        $("#video").html(data);
        }
    });
      
      }
      fetchData();
 
})