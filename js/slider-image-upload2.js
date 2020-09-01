
var resize = $('#upload-demo').croppie({
    enableExif: true,
    enableOrientation: true,    
    viewport: { // Default { width: 100, height: 100, type: 'square' } 
        width: 800,
        height: 450,
        type: 'square' //circle
    },
    boundary: {
        width: 850,
        height: 480
    }
});

$('#image').on('change', function () { 
  var reader = new FileReader();
    reader.onload = function (e) {
      resize.croppie('bind',{
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});


$('.btn-upload-image').on('click', function (ev) {
     html = '<img style="height:60px; height:60px;"  src="img/lo.gif" /> Uploading ...';
    $("#loding_img").html(html);
    resize.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (img) {
    $.ajax({
      url: "slider-croppie2.php",
      type: "POST",
      data: {"image":img},
      success: function (data) {
	  location.reload();
	}
    });
  });
});






var rsize = $('#update-news-demo').croppie({
    enableExif: true,
    enableOrientation: true,    
    viewport: { // Default { width: 100, height: 100, type: 'square' } 
        width: 400,
        height: 350,
        type: 'square' //circle
    },
    boundary: {
        width: 350,
        height: 300
    }
});

$('#image').on('change', function () { 
  var reader = new FileReader();
    reader.onload = function (e) {
      rsize.croppie('bind',{
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});

$('.btn-update-image').on('click', function (ev) {
     html = '<img style="height:60px; height:60px;"  src="img/lo.gif" /> Uploading ...';
    $("#loding_img").html(html);
    rsize.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (img) {
    $.ajax({
      url: "post-croppie.php",
      type: "POST",
      data: {"image":img},
      success: function (data) {
	  location.reload();
	}
    });
  });
});
