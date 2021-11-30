$(document).ready(function () {
 
   
    $(document).on('click', '.edit_data', function () {
        // alert("da vao")
        var cong_viec_id = $(this).attr("id");
      
        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {cong_viec_id:cong_viec_id },
            dataType: "json",
            success: function (data) {
                // console.log(data);
                $('#nhap_noi_lv').val(data.noi_lam_viec);
                $('#cong_viec_id').val(data.id);
                $('#insert').val("Update");
                $('#them_cong_viec').modal('show');
                
                //    console.log(data)
                // console.log(data)
                
            }
            // error: function (xhr, error) {
            //     console.debug(xhr); 
            //     console.debug(error);
            //   }
           
            

            

        });
       
    });
    $('#add').click(function () {
        $('#insert').val("Insert");
        $('#insert_form')[0].reset();
    });
    $('#insert_form').on("submit", function (event) {
        event.preventDefault();
        if ($('#nhap_noi_lv').val() == "") {
            alert("nhap_noi_lv is required");
        }
        //  else if($('#address').val() == '')  
        //  {  
        //       alert("Address is required");  
        //  }  

        else {
            $.ajax({
                url: "../process/cong_viec.php",
                method: "POST",
                data: $('#insert_form').serialize(),
                beforeSend: function () {
                    $('#insert').val("Đang thêm");
                },
                success: function (data) {
                    $('#insert_form')[0].reset();
                    $('#them_cong_viec').modal('hide');
                    $('#display_area_cv').html(data);

                }
            });
        }
    });
     // toggle icon 

    // them noi song


    $('#add_2').click(function () {
        $('#them_ns').val("Insert");
        $('#insert_form_2')[0].reset();
    });
    $(document).on('click', '.edit_data_2', function () {
        var noi_song_id = $(this).attr("id");
        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: { noi_song_id: noi_song_id },
            dataType: 'json',         
            success: function (data) {
                // console.log(data);
                $('#nhap_noi_song').val(data.noi_song);
                $('#mot_ta').val(data.mo_ta);
                $('#mot_ta').text(data.mo_ta);
                $('#noi_song_id').val(data.id);
                $('#them_ns').val("Update");
                $('#them_noi_song').modal('show');

               
            }
           


        });
    });
    $('#insert_form_2').on("submit", function (event) {
        event.preventDefault();
        if ($('#nhap_noi_song').val() == "") {
            alert("nhap noi song is required");
        }
        else if ($('#mo_ta').val() == '') {
            alert("Mo ta is required");
        }

        else {
            $.ajax({
                url: "../process/noi_song.php",
                method: "POST",
                data: $('#insert_form_2').serialize(),
                beforeSend: function () {
                    $('#them_ns').val("Đang thêm");
                },
                success: function (data) {
                    $('#insert_form_2')[0].reset();
                    $('#them_noi_song').modal('hide');
                    $('#display_area_ns').html(data);
                    // $(this).find(".Xã-Phường").addClass(" fa-house-user");
                    // $(this).find(".Quê, .quán").addClass(" fa-home");
                    // $(this).find(".Huyện-Quận").addClass(" fa-building");
                    // $(this).find(".Tỉnh-Thành").addClass(" fa-city");


                }
            });
        }
    });

  



    // them lien hệ

    $('#add_3').click(function () {
        $('#them_lh').val("Insert");
        $('#insert_form_3')[0].reset();
    });
    $(document).on('click', '.edit_data_3', function () {
        var lien_he_id = $(this).attr("id");
        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: { lien_he_id: lien_he_id },
            dataType: "json",
            success: function (data) {
                // console.log(data)
                $('#nhap_lien_he').val(data.thong_tin_lien_he);
                $('#loai_lienhe').val(data.loai_lien_he);
                $('#lien_he_id').val(data.id);
                $('#them_lh').val("Update");
                $('#them_thong_tin_lien_he').modal('show');


            }



        });
    });
    $('#insert_form_3').on("submit", function (event) {
        event.preventDefault();
        if ($('#nhap_lien_he').val() == "") {
            alert("lien he is required");
        }
        else if ($('#loai_lienhe').val() == '') {
            alert("lien he is required");
        }

        else {
            $.ajax({
                url: "../process/thong_tin_lien_he.php",
                method: "POST",
                data: $('#insert_form_3').serialize(),
                beforeSend: function () {
                    $('#them_lh').val("Đang thêm");
                },
                success: function (data) {
                    $('#insert_form_3')[0].reset();
                    $('#them_thong_tin_lien_he').modal('hide');
                    $('#display_area_lh').html(data);
                    // $(this).find(".Điện,.thoại").addClass("fa fa-phone");
                    // $(this).find(".Email").addClass(" fas fa-envelope");
                    // $(this).find(".Telegram").addClass(" fa fa-telegram");
                    // $(this).find(".Zalo").addClass(" fas fa-comment-alt");


                }
            });
        }
    });

 




    // them thong tin co ban

    $('#add_4').click(function () {
        $('#them_cb').val("Insert");
        $('#insert_form_4')[0].reset();
    });
    $(document).on('click', '.edit_data_4', function () {
        var co_ban_id = $(this).attr("id");
        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: { co_ban_id: co_ban_id },
            dataType: "json",
            success: function (data) {
                // console.log(data)
                $('#nhap_thong_tin_cb').val(data.thong_tin_co_ban);
                $('#chon_loai_tt').val(data.loai_thong_tin);
                $('#co_ban_id').val(data.id);
                $('#them_cb').val("Update");
                $('#them_thong_tin_co_ban').modal('show');



            }



        });
    });
    $('#insert_form_4').on("submit", function (event) {
        event.preventDefault();
        if ($('#nhap_thong_tin_cb').val() == "") {
            alert("lien he is required");
        }
        else if ($('#chon_loai_tt').val() == '') {
            alert("lien he is required");
        }

        else {
            $.ajax({
                url: "../process/thong_tin_co_ban.php",
                method: "POST",
                data: $('#insert_form_4').serialize(),
                beforeSend: function () {
                    $('#them_cb').val("Đang thêm");
                },
                success: function (data) {
                    $('#insert_form_4')[0].reset();
                    $('#them_thong_tin_co_ban').modal('hide');
                    $('#display_area_cb').html(data);
                    // $(this).find(".trú").addClass(" fa-home");
                    // $(".kiem_tra:contains(Nam)");
                    // $(this).addClass("fa-mars");
                    // $(".kiem_tra:contains(Nữ)");
                    // $(this).addClass("fa-venus");
                    // $(".kiem_tra:contains(Ngày)");
                    
                

                }
            });
        }
    });

    // toggle icon 
    $(this).find(".Ngày").addClass(" fa-birthday-cake");
    $(this).find(".trú").addClass(" fa-home");


    // $(".kiem_tra:contains(Nam)");
    // $(this).addClass("fa-mars");


    $(".kiem_tra:contains(Nữ)");
    $(this).addClass("fa-venus");



    // them tieu su

    $('#add_5').click(function () {
        $('#them_ts').val("Insert");
        $('#insert_form_5')[0].reset();
    });
    $(document).on('click', '.edit_data_5', function () {
        var tieu_su_id = $(this).attr("id");
        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: { tieu_su_id: tieu_su_id },
            dataType: "json",
            success: function (data) {
                // console.log(data)
                $('#nhap_mta_tieu_su').val(data.mo_ta);
                $('#chi_tiet_tieu_su').val(data.noidung_ts);
                $('#tieu_su_id').val(data.id);
                $('#them_ts').val("Update");
                $('#them_tieu_su').modal('show');



            }



        });
    });
    $('#insert_form_5').on("submit", function (event) {
        event.preventDefault();
        if ($('#nhap_mta_tieu_su').val() == "") {
            alert("lien he is required");
        }
        else if ($('#chi_tiet_tieu_su').val() == '') {
            alert("lien he is required");
        }

        else {
            $.ajax({
                url: "../process/tieu_su.php",
                method: "POST",
                data: $('#insert_form_5').serialize(),
                beforeSend: function () {
                    $('#them_ts').val("Đang thêm");
                },
                success: function (data) {
                    $('#insert_form_5')[0].reset();
                    $('#them_tieu_su').modal('hide');
                    $('#display_area_ts').html(data);
                    $(this).find(".trú").addClass(" fa-home");
                    $(".kiem_tra:contains(Nam)");
                    $("this").addClass("fa-mars");
                    $(".kiem_tra:contains(Nữ)");
                    $("this").addClass("fa-venus");
                    $(this).find(".Ngày").addClass("fa-birthday-cake");
                   

                }
            });
        }
    });

    // toggle icon 
    $(this).find(".trú").addClass(" fa-home");


    


     // them su kien
     $('#add_6').click(function () {
        $('#them_sk').val("Insert");
        $('#insert_form_6')[0].reset();
    });
    $(document).on('click', '.edit_data_6', function () {
        var su_kien_id = $(this).attr("id");
        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: { su_kien_id: su_kien_id },
            dataType: "json",
            success: function (data) {
                // console.log(data)
                $('#nhap_thoi_gian').val(data.thoi_gian);
                $('#nhap_sk').val(data.su_kien);
                $('#chi_tiet_su_kien').val(data.chi_tiet_su_kien);
                $('#su_kien_id').val(data.id);
                $('#them_sk').val("Update");
                $('#them_su_kien').modal('show');



            }



        });
    });
    $('#insert_form_6').on("submit", function (event) {
        event.preventDefault();
        if ($('#nhap_thoi_gian').val() == "") {
            alert("thoi gian is required");
        }
        else if ($('#nhap_sk').val() == '') {
            alert("Su kien is required");
        }
        else if ($('#chi_tiet_su_kien').val() == '') {
            alert("lien he is required");
        }

        else {
            $.ajax({
                url: "../process/su_kien.php",
                method: "POST",
                data: $('#insert_form_6').serialize(),
                beforeSend: function () {
                    $('#them_sk').val("Đang thêm");
                },
                success: function (data) {
                    $('#insert_form_6')[0].reset();
                    $('#them_su_kien').modal('hide');
                    $('#display_area_sk').html(data);
                    $(this).find(".trú").addClass(" fa-home");
                    $(".kiem_tra:contains(Nam)");
                    $("this").addClass("fa-mars");
                    $(".kiem_tra:contains(Nữ)");
                    $("this").addClass("fa-venus");
                    $(".kiem_tra:contains(Ngày)");
                    $("this").addClass("fa-birthday-cake");

                }
            });
        }
    });

   

      $(".clikc_vl").click(function(){
        $('.value_0').val(' ');
        });

    //     $("#show").click(function(){
    //         $(".body").show();
    //       });

    
    
});

