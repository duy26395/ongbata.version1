

// tab-section

// Select show tab on load page
let indexOpen = 0;

let btnTab = document.querySelectorAll('.nav-tab .ul_tab .li_tab .button_tab');
let contentTab = document.querySelectorAll('.content-tab');

function tabCurrent(thisTab) {
  let idCurrent = thisTab.dataset.tab;

  for (let i = 0; i < btnTab.length; i++) {
    btnTab[i].classList.remove('tab-current');
  }
  thisTab.classList.add('tab-current');

  for (let i = 0; i < contentTab.length; i++) {
    if (idCurrent === contentTab[i].id) {
      contentTab[i].classList.add('current-content-tab');
    } else {
      contentTab[i].classList.remove('current-content-tab');
    }
  }
}

for (let i = 0, len = btnTab.length; i < len; i++) {
  btnTab[i].onclick = function () {
    tabCurrent(this);
  }
}

tabCurrent(btnTab[indexOpen]);

// like
function openToggle(evt) {
  $(document).ready(function () {
    var countlike = 0;
    var idpost = $(evt).attr('data-id');
    var likepost = {
      likepostid: idpost,
      method: 'likepost'
    }
    countlikehtml = $(evt).closest(".section_right-2_footer").find(".coutlike").get(0);
    countlike = $(countlikehtml).text().trim();
    if(countlike > 0){ countlike = countlike} else { countlike = 0 }
    console.log(countlikehtml);
    $.ajax({
      url: '../process/Post.php',
      type: 'POST',
      data: likepost,
      dataType: 'json',
      cache: false,
      success: function (data) {
        if (data.success == true) {
          if(data.name == 'like') {
            evt.classList.toggle("liked")
            countlike = parseInt(countlike) + 1;
            $(countlikehtml).html(countlike)

          } else {
            countlike = parseInt(countlike) - 1;
            $(countlikehtml).html(countlike)
            evt.classList.toggle("liked")
          }
        } else {
          alert(data.name)
        }
      }
    })
  })


}
// khu toggle
function openCommentdad(commentName) {
  $(document).ready(function () {
    var cmt = $(commentName).parent().parent().parent();
    var evt = $(cmt).find(".comment_nt_click")[0];
    evt.classList.toggle("click_commnet");
  });
}
// son comment
function openCommentson(evt, commentsonName) {
  var evt = document.getElementById(commentsonName);
  evt.classList.toggle("form_toggle_son")
}

function openTabson(evt, tabName) {
  var i, tabcontent_2, tablinks;
  tabcontent_2 = document.getElementsByClassName("tabcontent_2");
  for (i = 0; i < tabcontent_2.length; i++) {
    tabcontent_2[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active_2", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active_2";
}

// khu video
var supportsES6 = function () {
  // https://gist.github.com/bendc/d7f3dbc83d0f65ca0433caf90378cd95
  try {
    new Function("(a = 0) => a");
    return true;
  }
  catch (err) {
    return false;
  }
}();


// Add a full-screen toggle button where supported.
// Version 2.5 07/10/2019
// - Adding cross-browser support using prefixes.


// function launchFullWindow(config) {

//   "use strict";
//   if (!supportsES6) return false;

//   // Exit if unsupported
//   if (!(
//     document.fullscreenEnabled ||
//     document.webkitFullscreenEnabled ||
//     document.mozFullScreenEnabled ||
//     document.msFullscreenEnabled)) return false;

//   let cfg = {
//     launchObjSelect: '[data-fullScreen]',
//     launchBtnClass: 'fullScreen_btn',
//     svgClass: 'fullScreen_svg',
//     open: {
//       icon: 'icon-fullScreen-open',
//       extension: '-open',
//       label: 'Launch into full screen',
//       // title : 'Full screen [ f11]'

//     },
//     exit: {
//       icon: 'icon-fullScreen-exit',
//       extension: '-exit',
//       label: 'Exit full screen',
//       // title : 'Exit full screen [ f11, esc]'
//       // title : 'Exit full screen [f, f11, esc]'
//     }
//   };

//   // Blend the parameter config into the default cfg
//   Object.assign(cfg, config);

//   const svgData = {
//     open: {},
//     exit: {}
//   }


//   // Get symbols from the SVG definitions in the HTML
//   const setSvgData = (_ => {

//     const getData = param => {
//       const symbol = document.getElementById(cfg[param].icon);
//       if (!symbol) return false;
//       svgData[param].class = cfg.svgClass;
//       svgData[param].icon = cfg[param].icon;
//       svgData[param].symbol = symbol.innerHTML;
//       svgData[param].viewBox = symbol.getAttribute('viewBox');
//     };

//     getData('open');
//     getData('exit');
//   })();


//   const _openFullScreen = obj => {
//     if (obj.requestFullscreen) {
//       obj.requestFullscreen();
//     } else if (obj.webkitRequestFullscreen) {
//       obj.webkitRequestFullscreen();
//     } else if (obj.mozRequestFullScreen) {
//       obj.mozRequestFullScreen();
//     } else if (obj.msRequestFullscreen) {
//       obj.msRequestFullscreen();
//     }
//   };


//   const _exitFullScreen = _ => {
//     if (document.exitFullscreen) {
//       document.exitFullscreen();
//     } else if (document.webkitExitFullscreen) {
//       document.webkitExitFullscreen();
//     } else if (document.mozCancelFullScreen) {
//       document.mozCancelFullScreen();
//     } else if (document.msExitFullscreen) {
//       document.msExitFullscreen();
//     }
//   };


//   const _hasFullScreenElement = _ =>
//     document.fullscreenElement ||
//     document.webkitFullscreenElement ||
//     document.mozFullScreenElement ||
//     document.msFullscreenElement;


//   const _instantiateLaunchObj = launchObj => {

//     const _getCfg = (param, toOpen) => cfg[toOpen ? 'open' : 'exit'][param];

//     const _getSvgString = toOpen => {
//       const param = _getCfg('extension', toOpen).substr(1);
//       return `<svg class="${svgData[param].class}" aria-hidden="true" viewbox="${svgData[param].viewBox}">${svgData[param].symbol}</svg>`;
//     }

//     const _setBtnAttr = toOpen => {
//       btn.className = cfg.launchBtnClass + _getCfg('extension', toOpen);
//       btn.title = _getCfg('title', toOpen);
//       btn.setAttribute('aria-label', _getCfg('label', toOpen));
//       btn.innerHTML = _getSvgString(toOpen);
//     }

//     // Check to see if a button already exists in the html
//     let btn = launchObj.querySelector('.' + cfg.launchBtnClass);
//     if (!btn) {

//       // If not, create one
//       btn = document.createElement('button');
//       launchObj.prepend(btn);
//     }
//     _setBtnAttr(true);


//     const _toggleFullScreen = _ => {
//       if (!_hasFullScreenElement()) {
//         _openFullScreen(launchObj);
//       } else {
//         _exitFullScreen();
//       }
//       btn.focus();
//     };


//     const _onFullscreenChange = _ =>
//       _setBtnAttr(!_hasFullScreenElement());


//     {
//       btn.addEventListener('click', _toggleFullScreen);

//       // Toggle attr this way because esc key is not detected but change is!
//       document.addEventListener('fullscreenchange', _onFullscreenChange);
//       document.addEventListener('mozfullscreenchange', _onFullscreenChange);
//       document.addEventListener('webkitfullscreenchange', _onFullscreenChange);
//       document.addEventListener("MSFullscreenChange", _onFullscreenChange);

//       // Toggle if the f, or f11, key is pressed
//       // document.addEventListener('keydown', event => {
//       //   if (event.keyCode === 70 || event.keyCode === 112) {
//       //     _toggleFullScreen();
//       //   }
//       // });
//     }

//   }


// }
// // Attaches to any object with data-fullScreen attribute by default.
// // Pass in a customised config to overide default settings.
// launchFullWindow();
$(".kiem_tra:contains(Nam)");
  $(".ic").parent().addClass("fa-mars");


  $(".kiem_tra:contains(Nữ)");
  $("this").addClass("fa-venus");
  // 

  $(document).ready(function () {

    $(this).find("#toggle_anh_modal").addClass("active");
    $(this).find(".border_raidus1").addClass("img_top_left");
    $(this).find(".border_raidus3").addClass("img_top_right");
    $(this).find(".border_raidus7").addClass("img_bottom_left");
    $(this).find(".border_raidus9").addClass("img_bottom_right");

    $(this).find(".border_raidus_sk2").addClass("img_top_right");
    $(this).find(".border_raidus_sk2").addClass("img_bottom_right");
    $(this).find(".border_raidus_sk1").addClass("img_top_left");
    $(this).find(".border_raidus_sk1").addClass("img_bottom_left");

    $(this).find(".trú").addClass(" fa-home");
    $(this).find(".Nam").addClass("fa-mars");
    $(this).find(".Nữ").addClass("fa-venus");
    $(this).find(".học,.study,.studying,.Studying").addClass("fa-graduation-cap");
    $(this).find(".làm, .việc").addClass(" fa-toolbox");

      // toggle icon 
      $(this).find(".Xã-Phường").addClass(" fa-house-user");
      $(this).find(".Quê, .quán").addClass(" fa-home");
      $(this).find(".Huyện-Quận").addClass(" fa-building");
      $(this).find(".Tỉnh-Thành").addClass(" fa-city");


         // toggle icon 
    $(this).find(".Điện,.thoại").addClass("fa fa-phone");
    $(this).find(".Email").addClass(" fas fa-envelope");
    $(this).find(".Telegram").addClass(" fa fa-telegram");
    $(this).find(".Zalo").addClass(" fas fa-comment-alt");

  
    
      


    // read more
   
    // $('.readmore').click(function(event){
    //   var article_num = event.target.dataset.article;
  
    //   // window.testEvent = event;
    //   // Show the additional content
    //   $(`.${article_num} .show-this-on-click`).slideDown();
  
    //   // Toggle the controls
    //   $(`.${article_num} .readmore`).hide();
    //   $(`.${article_num} .readless`).show();
  
    //   event.preventDefault();
    // });
  
    // $('.readless').click(function(event){
    //   var article_num = event.target.dataset.article;
      
    //   // Hide the additional content
    //   $(`.${article_num} .show-this-on-click`).slideUp();
  
    //   // Toggle the controls
    //   $(`.${article_num} .readless`).hide();
    //   $(`.${article_num} .readmore`).show();
  
    //   event.preventDefault();
    // });
    
    // $('.background-control').click(function(){
    //   if ($('.post').hasClass('amarillo')) {
    //     $('.post').removeClass('amarillo');
    //     $('.background-status').text('article has class amarillo: false!');
    //   } else {
    //     $('.post').addClass('amarillo');
    //     $('.background-status').text('article has class amarillo: true!');
    //   }
    //   event.preventDefault();
    // });

    // $(".read-m").click(function(){
    //   $(this).parent().parent().toggleClass("pr_da");
    // });
    // $(".fullScreen_btn-open,.fullScreen_btn-exit").click(function(){
    //   $(this).parent().toggleClass("image_tg");
    // });
    // $(this).find(".fullScreen_btn-exit").addClass(" fa-birthday-cake");
    // $(this).find(".fullScreen_btn-open").removeClass(" fa-birthday-cake");
    $(this).find(".image_post5").parent().append("<span class='see_more fz_20 position-absolute top-50 start-50 translate-middle text-center' data-bs-toggle='modal' data-bs-target='#post_sm_3'><b>Xem thêm 2 ảnh nữa </b></span>");
    $(this).find(".image_post5").css("display", "none");
    
    $(".click_show,.bt_close_sm-media").click(function(){
      $(this).fadeOut(function () {
        $(this).parent().parent().parent().toggleClass("show_comment");
     })
    });
   

    
  });
  



