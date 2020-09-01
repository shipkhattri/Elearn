
var resize = $('#upload-demo-sq').croppie({
    enableExif: true,
    enableOrientation: true,    
    viewport: { // Default { width: 100, height: 100, type: 'square' } 
        width: 300,
        height: 225,
        type: 'square' //square
    },
    boundary: {
        width: 400,
        height: 300
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
  resize.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (img) {
    $.ajax({
      url: "croppie.php",
      type: "POST",
      data: {"image":img},
      success: function (data) {
			//alert("Successfully Updatedeee");
			 html = '<input type="text" name="photo" id="photo" value="' + img + '" hidden/>';
        $("#preview-crop-image").html(html);
      }
    });
  });
});
