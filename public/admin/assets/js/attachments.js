///// Multiple Images  ////////


function single_attachment(input,ext,fsize) {
        var validExtensions = ext; //array of valid extensions
        var fileName = input.files[0].name;
        var filesize = input.files[0].size / 1024 / 1024;
       
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1) {
            input.type = ''
            input.type = 'file'
            
            alert("Only these file types are accepted : "+validExtensions.join(', '));
        }
        else
        {
        if (input.files && input.files[0]) {
            var filerdr = new FileReader();
            filerdr.onload = function (e) {
             
            }
            filerdr.readAsDataURL(input.files[0]);
             if(filesize >= fsize)
              {
                    input.type = ''
                   input.type = 'file'
                alert("Upload File Less Than "+fsize+" MB ");

              }
        }
        }
       
    }

function multiple_attachment(input,ext,fsize) {
    for (var i = 0; i <= input.files.length - 1; i++) {
        var validExtensions = ext; //array of valid extensions
        var fileName = input.files[i].name;
        var filesize = input.files[i].size / 1024 / 1024;
       
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1) {
            input.type = ''
            input.type = 'file'
            
            alert("Only these file types are accepted : "+validExtensions.join(', '));
        }
        else
        {
        if (input.files && input.files[i]) {
            var filerdr = new FileReader();
            filerdr.onload = function (e) {
             
            }
            filerdr.readAsDataURL(input.files[i]);
             if(filesize >= fsize)
              {
                    input.type = ''
                   input.type = 'file'
                alert("Upload File Less Than "+fsize+" MB ");

              }
        }
        }
       
    }
  }




function single_attachment(input,ext,fsize) {
        var validExtensions = ext; //array of valid extensions
        var fileName = input.files[0].name;
        var filesize = input.files[0].size / 1024 / 1024;
       
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1) {
            input.type = ''
            input.type = 'file'
            
            alert("Only these file types are accepted : "+validExtensions.join(', '));
        }
        else
        {
        if (input.files && input.files[0]) {
            var filerdr = new FileReader();
            filerdr.onload = function (e) {
             
            }
            filerdr.readAsDataURL(input.files[0]);
             if(filesize >= fsize)
              {
                    input.type = ''
                   input.type = 'file'
                alert("Upload File Less Than "+fsize+" MB ");

              }
        }
        }
       
    }









$(document).ready(function() {
if (window.File && window.FileList && window.FileReader) {
$("#pm_logo").on("change", function(e) {
var input = this,
files = input.files;
if (files.length > 0) {
var regExp = new RegExp('image.(jpg|jpeg|png)', 'i');
for (var i = 0; i < files.length; i++)
{
var file = file = files[i];
var matcher = regExp.test(file.type);
 var FileSize = file.size / 1024 / 1024;
if (!matcher)
{
alert("please select jpg or jpeg or png format image.!");
$('#pm_logo').val('');

}
 if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $('#pm_logo').val('');
           // $(file).val(''); //for clearing with Jquery
        } else {

        }

}
} else {
//alert('please add 1 file');
}


var files = e.target.files,
filesLength = files.length;
for (var i = 0; i < filesLength; i++) {
var f = files[i]
var fileReader = new FileReader();
fileReader.onload = (function(e) {
var file = e.target;
$("<span class=\"pip\">" +
  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
  "<br/><span class=\"remove\">Remove image</span>" +
"</span>").insertAfter("#show_e_wc_attachment_image");
$(".remove").click(function(){
$(this).parent(".pip").remove();
});
});
fileReader.readAsDataURL(f);
}
});
} else {
alert("Your browser doesn't support to File API")
}
});
///// Close Multiple Images  ////////
$(document).ready(function() {
if (window.File && window.FileList && window.FileReader) {
$("#pm_img_path ").on("change", function(e) {
var input = this,
files = input.files;
if (files.length > 0) {
var regExp = new RegExp('image.(jpg|jpeg|png)', 'i');
for (var i = 0; i < files.length; i++)
{
var file = file = files[i];
var matcher = regExp.test(file.type);
 var FileSize = file.size / 1024 / 1024;
if (!matcher)
{
alert("please select jpg or jpeg or png format image.!");
$('#pm_img_path ').val('');

}
if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $('#pm_img_path').val('');
           // $(file).val(''); //for clearing with Jquery
        } else {

        }
}
} else {
//alert('please add 1 file');
}
var files = e.target.files,
filesLength = files.length;
for (var i = 0; i < filesLength; i++) {
var f = files[i]
var fileReader = new FileReader();
fileReader.onload = (function(e) {
var file = e.target;
$("<span class=\"pip\">" +
  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
  "<br/><span class=\"remove\">Remove image</span>" +
"</span>").insertAfter("#show_e_wc_attachment_image");
$(".remove").click(function(){
$(this).parent(".pip").remove();
});
});
fileReader.readAsDataURL(f);
}
});
} else {
alert("Your browser doesn't support to File API")
}
});
///// Close Multiple Images  ////////



////////////////////////// Brand /////////////////////////////////////////////


///// Multiple Images  ////////
$(document).ready(function() {
if (window.File && window.FileList && window.FileReader) {
$("#pmb_logo").on("change", function(e) {
var input = this,
files = input.files;
if (files.length > 0) {
var regExp = new RegExp('image.(jpg|jpeg|png)', 'i');
for (var i = 0; i < files.length; i++)
{
var file = file = files[i];
var matcher = regExp.test(file.type);
 var FileSize = file.size / 1024 / 1024;
if (!matcher)
{
alert("please select jpg or jpeg or png format image.!");
$('#pmb_logo').val('');

}

if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $('#pmb_logo').val('');
           // $(file).val(''); //for clearing with Jquery
        } else {

        }

}
} else {
//alert('please add 1 file');
}


var files = e.target.files,
filesLength = files.length;
for (var i = 0; i < filesLength; i++) {
var f = files[i]
var fileReader = new FileReader();
fileReader.onload = (function(e) {
var file = e.target;
$("<span class=\"pip\">" +
  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
  "<br/><span class=\"remove\">Remove image</span>" +
"</span>").insertAfter("#show_e_wc_attachment_image");
$(".remove").click(function(){
$(this).parent(".pip").remove();
});
});
fileReader.readAsDataURL(f);
}
});
} else {
alert("Your browser doesn't support to File API")
}
});
///// Close Multiple Images  ////////
$(document).ready(function() {
if (window.File && window.FileList && window.FileReader) {
$("#pmb_img_path ").on("change", function(e) {
var input = this,
files = input.files;
if (files.length > 0) {
var regExp = new RegExp('image.(jpg|jpeg|png)', 'i');
for (var i = 0; i < files.length; i++)
{
var file = file = files[i];
var matcher = regExp.test(file.type);
 var FileSize = file.size / 1024 / 1024;
if (!matcher)
{
alert("please select jpg or jpeg or png format image.!");
$('#pmb_img_path ').val('');

}
if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $('#pmb_img_path').val('');
           // $(file).val(''); //for clearing with Jquery
        } else {

        }

}
} else {
//alert('please add 1 file');
}
var files = e.target.files,
filesLength = files.length;
for (var i = 0; i < filesLength; i++) {
var f = files[i]
var fileReader = new FileReader();
fileReader.onload = (function(e) {
var file = e.target;
$("<span class=\"pip\">" +
  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
  "<br/><span class=\"remove\">Remove image</span>" +
"</span>").insertAfter("#show_e_wc_attachment_image");
$(".remove").click(function(){
$(this).parent(".pip").remove();
});
});
fileReader.readAsDataURL(f);
}
});
} else {
alert("Your browser doesn't support to File API")
}
});
///// Close Brand Multiple Images  ////////




$(document).ready(function() {
if (window.File && window.FileList && window.FileReader) {
$("#p_blog_image").on("change", function(e) {
var input = this,
files = input.files;
if (files.length > 0) {
var regExp = new RegExp('image.(jpg|jpeg|png)', 'i');
for (var i = 0; i < files.length; i++)
{
var file = file = files[i];
var matcher = regExp.test(file.type);
 var FileSize = file.size / 1024 / 1024;
if (!matcher)
{
alert("please select jpg or jpeg or png format image.!");
$('#p_blog_image').val('');

}

if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $('#p_blog_image').val('');
           // $(file).val(''); //for clearing with Jquery
        } else {

        }

}
} else {
//alert('please add 1 file');
}


var files = e.target.files,
filesLength = files.length;
for (var i = 0; i < filesLength; i++) {
var f = files[i]
var fileReader = new FileReader();
fileReader.onload = (function(e) {
var file = e.target;
$("<span class=\"pip\">" +
  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
  "<br/><span class=\"remove\">Remove image</span>" +
"</span>").insertAfter("#show_e_wc_attachment_image");
$(".remove").click(function(){
$(this).parent(".pip").remove();
});
});
fileReader.readAsDataURL(f);
}
});
} else {
alert("Your browser doesn't support to File API")
}
});



$(document).ready(function() {
if (window.File && window.FileList && window.FileReader) {
$("#p_event_image").on("change", function(e) {
var input = this,
files = input.files;
if (files.length > 0) {
var regExp = new RegExp('image.(jpg|jpeg|png)', 'i');
for (var i = 0; i < files.length; i++)
{
var file = file = files[i];
var matcher = regExp.test(file.type);
 var FileSize = file.size / 1024 / 1024;
if (!matcher)
{
alert("please select jpg or jpeg or png format image.!");
$('#p_event_image').val('');

}


if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $('#p_event_image').val('');
           // $(file).val(''); //for clearing with Jquery
        } else {

        }
}
} else {
//alert('please add 1 file');
}


var files = e.target.files,
filesLength = files.length;
for (var i = 0; i < filesLength; i++) {
var f = files[i]
var fileReader = new FileReader();
fileReader.onload = (function(e) {
var file = e.target;
$("<span class=\"pip\">" +
  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
  "<br/><span class=\"remove\">Remove image</span>" +
"</span>").insertAfter("#show_e_wc_attachment_image");
$(".remove").click(function(){
$(this).parent(".pip").remove();
});
});
fileReader.readAsDataURL(f);
}
});
} else {
alert("Your browser doesn't support to File API")
}
});








$(document).ready(function() {
if (window.File && window.FileList && window.FileReader) {
$("#p_offer_image").on("change", function(e) {
var input = this,
files = input.files;
if (files.length > 0) {
var regExp = new RegExp('image.(jpg|jpeg|png)', 'i');
for (var i = 0; i < files.length; i++)
{
var file = file = files[i];
var matcher = regExp.test(file.type);
 var FileSize = file.size / 1024 / 1024;
if (!matcher)
{
alert("please select jpg or jpeg or png format image.!");
$('#p_offer_image').val('');

}

if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $('#p_offer_image').val('');
           // $(file).val(''); //for clearing with Jquery
        } else {

        }

}
} else {
//alert('please add 1 file');
}


var files = e.target.files,
filesLength = files.length;
for (var i = 0; i < filesLength; i++) {
var f = files[i]
var fileReader = new FileReader();
fileReader.onload = (function(e) {
var file = e.target;
$("<span class=\"pip\">" +
  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
  "<br/><span class=\"remove\">Remove image</span>" +
"</span>").insertAfter("#show_e_wc_attachment_image");
$(".remove").click(function(){
$(this).parent(".pip").remove();
});
});
fileReader.readAsDataURL(f);
}
});
} else {
alert("Your browser doesn't support to File API")
}
});

$(document).ready(function() {
if (window.File && window.FileList && window.FileReader) {
$("#p_about_image").on("change", function(e) {
var input = this,
files = input.files;
if (files.length > 0) {
var regExp = new RegExp('image.(jpg|jpeg|png)', 'i');
for (var i = 0; i < files.length; i++)
{
var file = file = files[i];
var matcher = regExp.test(file.type);
 var FileSize = file.size / 1024 / 1024;
if (!matcher)
{
alert("please select jpg or jpeg or png format image.!");
$('#p_about_image').val('');

}

if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $('#p_about_image').val('');
           // $(file).val(''); //for clearing with Jquery
        } else {

        }

}
} else {
//alert('please add 1 file');
}


var files = e.target.files,
filesLength = files.length;
for (var i = 0; i < filesLength; i++) {
var f = files[i]
var fileReader = new FileReader();
fileReader.onload = (function(e) {
var file = e.target;
$("<span class=\"pip\">" +
  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
  "<br/><span class=\"remove\">Remove image</span>" +
"</span>").insertAfter("#show_e_wc_attachment_image");
$(".remove").click(function(){
$(this).parent(".pip").remove();
});
});
fileReader.readAsDataURL(f);
}
});
} else {
alert("Your browser doesn't support to File API")
}
});



$(document).ready(function() {
if (window.File && window.FileList && window.FileReader) {
$("#p_banner_image").on("change", function(e) {
var input = this,
files = input.files;
if (files.length > 0) {
var regExp = new RegExp('image.(jpg|jpeg|png)', 'i');
for (var i = 0; i < files.length; i++)
{
var file = file = files[i];
var matcher = regExp.test(file.type);
 var FileSize = file.size / 1024 / 1024;

if (!matcher)
{
alert("please select jpg or jpeg or png format image.!");
$('#p_banner_image').val('');

}


if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $('#p_banner_image').val('');
           // $(file).val(''); //for clearing with Jquery
        } else {

        }
}
} else {
//alert('please add 1 file');
}


var files = e.target.files,
filesLength = files.length;
for (var i = 0; i < filesLength; i++) {
var f = files[i]
var fileReader = new FileReader();
fileReader.onload = (function(e) {
var file = e.target;
$("<span class=\"pip\">" +
  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
  "<br/><span class=\"remove\">Remove image</span>" +
"</span>").insertAfter("#show_e_wc_attachment_image");
$(".remove").click(function(){
$(this).parent(".pip").remove();
});
});
fileReader.readAsDataURL(f);
}
});
} else {
alert("Your browser doesn't support to File API")
}
});




$(document).ready(function() {
if (window.File && window.FileList && window.FileReader) {
$("#pjs_attach_photo").on("change", function(e) {
var input = this,
files = input.files;
 
if (files.length > 0) {
var regExp = new RegExp('image.(jpg|jpeg|png)', 'i');
for (var i = 0; i < files.length; i++)
{
var file = file = files[i];
var matcher = regExp.test(file.type);
 var FileSize = file.size / 1024 / 1024;
if (!matcher)
{
alert("please select jpg or jpeg or png format image.!");
$('#pjs_attach_photo').val('');

}


 if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $('#pjs_attach_photo').val('');
           // $(file).val(''); //for clearing with Jquery
        } else {

        }
}
} else {
//alert('please add 1 file');
}
var files = e.target.files,
filesLength = files.length;
for (var i = 0; i < filesLength; i++) {
var f = files[i]
var fileReader = new FileReader();
fileReader.onload = (function(e) {
var file = e.target;
$("<span class=\"pip\">" +
  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
  "<br/><span class=\"remove\">Remove image</span>" +
"</span>").insertAfter("#show_e_wc_attachment_image");
$(".remove").click(function(){
$(this).parent(".pip").remove();
});
});
fileReader.readAsDataURL(f);
}
});
} else {
alert("Your browser doesn't support to File API")
}
});



var _validFileExtensions = [".gif",".jpg", ".jpeg", ".pdf", ".png"];    
function checkAttachment(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}

var _validFileExtensions = [".gif",".jpg", ".jpeg", ".pdf", ".png", ".doc", ".docx", ".xl", ".xls", ".csv", ".xlsx"];    
function checkAttachmentFile(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}


///// Attachment  ////////
function checkPdf(fieldObj)
{

	var abc=fieldObj;
  var control = document.getElementById(abc);
  var filelength = control.files.length;


  for (var i = 0; i < control.files.length; i++) {
    var file = control.files[i];
    var FileName = file.name;
      var FileSize = file.size / 1024 / 1024;;
  
    var FileExt = FileName.substr(FileName.lastIndexOf('.') + 1);
    if ((FileExt.toUpperCase() != "PDF" || FileExt.toUpperCase() != "DOC" || FileExt.toUpperCase() != "DOCX" )) {
      var error = "File type : " + FileExt + "\n\n";
      error += "Please make sure your file is in pdf  format .\n\n";
      console.error(error);
     alert(error);
    $('#'+abc).val('');
    }

    if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $('#'+abc).val('');
           // $(file).val(''); //for clearing with Jquery
        } else {

        }
  }
}
///// Close Attachment  ////////

