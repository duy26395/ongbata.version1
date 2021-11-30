function Loadstatuspost() {
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
            loadlink();
            $(".check_anh8,.check_video7,.check_video9,.check_video10").remove();
        }
    })
}
var fileimgpost;
var filedataarray = [];
var filedatadeleteimg = [];
var postidupdate;
var pathAMS3 = 'https://labtoidayhoc.s3.ap-southeast-1.amazonaws.com/duy_dev/';

$(document).ready(function () {

    // check file type img
    $("#uploadFileimg").change(function () {
        var fi = document.getElementById('uploadFileimg');
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        for (var i = 0; i < fi.files.length; i++) {
            if ($.inArray(fi.files.item(i).name.split('.').pop().toLowerCase(), fileExtension) ==
                '-1') {
                alert("Only formats are allowed : " + fileExtension.join(', '));
                $("#uploadFileimg").val('');

            } else {
                filedataarray.push(fi.files.item(i))
                $('.previewfile').append("<div data-value='"+fi.files.item(i).name+"' class='col pd_5 position-relative'> <div> <img src='" + URL.createObjectURL(event.target.files[i]) + "' style='height: 100px;'> </div> <span class='material-icons position-absolute top-0 end-0 pd_5 cursor_p delete--imgloader' data-bs-toggle='tooltip' data-placement='top' title='Xóa ảnh'> remove_circle_outline </span> </div>")
            }
        }
    })
        // check file type video
        $("#uploadFilevideo").change(function () {
            var fi = document.getElementById('uploadFilevideo');
            var fileExtension = ['m4v', 'avi', 'mpg', 'mp4'];
            for (var i = 0; i < fi.files.length; i++) {
                if ($.inArray(fi.files.item(i).name.split('.').pop().toLowerCase(), fileExtension) ==
                    '-1') {
                    alert("Only formats are allowed : " + fileExtension.join(', '));
                    $("#uploadFileimg").val('');
    
                } else {
                    filedataarray.push(fi.files.item(i))
                    // $('.previewfile').append("<div data-value='"+fi.files.item(i).name+"' class='col pd_5 position-relative'> <div> <img src='" + URL.createObjectURL(event.target.files[i]) + "' style='height: 100px;'> </div> <span class='material-icons position-absolute top-0 end-0 pd_5 cursor_p delete--imgloader' data-bs-toggle='tooltip' data-placement='top' title='Xóa ảnh'> remove_circle_outline </span> </div>")
                    $('.previewfile').append('<div data-value="'+fi.files.item(i).name+'" class="col pd_5 position-relative"><video controls><source src="' + URL.createObjectURL(event.target.files[i]) +'" type="video/mp4"></video><span class="material-icons position-absolute top-0 end-0 pd_5 cursor_p delete--videoloader" data-bs-toggle="tooltip" data-placement="top" title="Xóa video"> remove_circle_outline </span></div>');
                }
            }
        })
        $(document).on('click', '.delete--videoloader', function (e) {
            var value = $(this).parent().attr('data-value')
            for (var i = 0; i < filedataarray.length; i++) {
                if(filedataarray[i].name == value){
                    filedatadeleteimg.push(filedataarray[i]);
                    filedataarray.splice(i,1);
                }
            }
            $(this).parent().remove();
        })


    $(document).on('click', '.delete--imgloader', function (e) {
        var value = $(this).parent().attr('data-value')
        for (var i = 0; i < filedataarray.length; i++) {
            if(filedataarray[i].name == value){
                filedatadeleteimg.push(filedataarray[i]);
                filedataarray.splice(i,1);
            }
        }
        $(this).parent().remove();
    })

    //delete post
    $(document).on('click', '.btn--del', function (e) {

        var idpost = $(this).attr('data-id');
        var delpost = {
            delpostid: idpost,
            method: 'deletepost'
        }
        Postdata = $(this).closest(".postroot").get(0)
        $.ajax({
            url: '../process/Post.php',
            type: 'POST',
            data: delpost,
            dataType: 'json',
            cache: false,
            success: function (data) {
                if (data.success == false) {
                    alert(data.name);
                } else {
                    alert("Delete POST successfully!");
                    Postdata.remove();
                }
                loadlink();
                $(".check_anh8,.check_video7,.check_video9,.check_video10").remove();
            }
        })
    })
    
    $(".btn-closecreatepost").on("click", function (e) {
        $("#uploadFileimg").val("");
        $(".previewfile").empty();
        editor.setData("");
        filedataarray = [];
        filedatadelete = [];
    })
    //createpost Post
    $("#PushPost").on("click", function (e) {
        fi = document.getElementById('uploadFileimg');
        $('#name + .throw_error').empty(); //Clear the messages first
        $('#success').empty();
        var Postcontent = editor.getData();
        filedata = new FormData();
        var filedatadelete = new FormData();
        for (var i = 0; i < filedataarray.length; i++) {
            filedata.append("files[]", filedataarray[i]);
        }
        for (var i = 0; i < filedatadeleteimg.length; i++) {
            filedatadelete.append("filesdelete[]", filedatadeleteimg[i].name);
        }
        if (filedata != null) {
            fileimgpost = 'true'
        } else {
            fileimgpost = 'false'
        }
        if (filedatadelete != null) {
            filedeletegal = 'true'
        } else {
            filedeletegal = 'false'
        }
        var update ={
            postid : postidupdate,
            Postcontent: Postcontent,
            // fileimgpost: fileimgpost,
            method: 'updatepost'
        }
        var insert = {
            Postcontent: Postcontent,
            fileimgpost: fileimgpost,
            method: 'createpost'
        }
        if (postidupdate != null) {
        // UPdate post
        $.ajax({
            url: '../process/Post.php',
            type: 'POST',
            data: update,
            dataType: 'json',
            cache: false,
            success: function (data) {
                if (data.success == false) {
                    alert(data.name);
                } else {
                    alert("Update record successfully!");
                    // update gallery if new img
                    if(fileimgpost == 'true')
                    {
                        filedata.append("id",postidupdate)
                        $.ajax({
                            url: '../process/Post.php',
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: filedata,
                            type: 'post',
                            success: function () {}
                        })
                    }
                    // update gallery if del img
                    if(filedeletegal == 'true') {
                        filedatadelete.append("id",postidupdate)
                        filedatadelete.append("method","deleteimggal")
                        $.ajax({
                            url: '../process/Post.php',
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: filedatadelete,
                            type: 'post',
                            success: function () {}
                        })

                    }
                    $("#uploadFileimg").val("");
                    $(".previewfile").empty();
                    editor.setData("");
                    filedataarray = [];
                    filedatadelete = [];
                 } 
            }
        })

        } else {
            // create post
            $.ajax({
                url: '../process/Post.php',
                type: 'POST',
                data: insert,
                dataType: 'json',
                cache: false,
                success: function (data) {
                    if (data.success == false) {
                        alert(data.name);
                    } else {
                        // console.log(data.lat)
                        $(document).ready(function () {
                            alert("New record created successfully!");
                            if (data.lastid != null) {
                                filedata.append("id", data.lastid)
                                $.ajax({
                                    url: '../process/Post.php',
                                    dataType: 'text',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: filedata,
                                    type: 'post',
                                    success: function () {
                                        $(".check_anh8,.check_video7,.check_video9,.check_video10").remove();
                                        $(".add_add9").addClass("rounded-circle  border border-3 border-white");
                                        $(".add_add9").parent().addClass("bg-light bg-gradient pd_15 d-flex justify-content-center");
                                        $('#them_bai_viet').modal('hide');
                                    }
                                });
                            }
                        })
                        reload();
                        loadlink();
                        $(".check_anh8,.check_video7,.check_video9,.check_video10").remove();
                        $('#them_bai_viet').modal('hide');
                        $("#uploadFileimg").val("");
                        $(".previewfile").empty();
                        editor.setData("");
                        filedataarray = [];
                        filedatadelete = [];
                    }
                }
            });
        }

    });
    //edit - post --- load data into form edit post
    $(".btn-editpost").on("click", function (e) {
        postidupdate = $(this).attr("data-id")
        $.ajax({
            url: '../process/Post.php',
            type: 'POST',
            data: {
                method: 'loaddataeditform',
                postid :postidupdate
            },
            dataType: 'json',
            cache: false,
            success: function (data) {
                var postcontent = data[0].content;
                editor.setData(postcontent);
                for (var i = 0; i < data.length; i++) {
                    $('.previewfile').append("<div data-value='"+data[i].name+"' class='col pd_5 position-relative'> <div> <img src='"+ pathAMS3+data[i].name +"' style='height: 100px;'> </div> <span class='material-icons position-absolute top-0 end-0 pd_5 cursor_p delete--imgloader' data-bs-toggle='tooltip' data-placement='top' title='Xóa ảnh'> remove_circle_outline </span> </div>")
                    filedataarray.push(data[i])
                }
            }
        })

    })


})
