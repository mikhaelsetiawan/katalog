//$( document ).ready(function() {
//	var drag = false;
//	$( "#pp1_preview" ).mousedown(function() {
//		drag = true;
//	});
//	$( "#pp1_preview" ).mouseup(function() {
//		drag = false;
//	});
//	$( "#pp1_preview" ).mousemove(function( event ) {
//		if (drag) {
//			var msg = "Handler for .mousemove() called at ";
//			msg += (event.pageX-parseInt($("#pp1_preview").position().left)) + ", " + (event.pageY-parseInt($("#pp1_preview").position().top));
//			$("#pp1_preview").position().left +=1;
//			console.log( "<div>" + msg + "</div>" );
//		}
//	});
//});
//var fileNum = 0;
var varInputType = 0;
function detectVerticalSquash(img) {
    var iw = img.naturalWidth, ih = img.naturalHeight;
    var canvas = document.createElement('canvas');
    canvas.width = 1;
    canvas.height = ih;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(img, 0, 0);
    var data = ctx.getImageData(0, 0, 1, ih).data;
    // search image edge pixel position in case it is squashed vertically.
    var sy = 0;
    var ey = ih;
    var py = ih;
    while (py > sy) {
        var alpha = data[(py - 1) * 4 + 3];
        if (alpha === 0) {
            ey = py;
        } else {
            sy = py;
        }
        py = (ey + sy) >> 1;
    }
    var ratio = (py / ih);
    return (ratio===0)?1:ratio;
}

function drawImageIOSFix(ctx, img, sx, sy, sw, sh, dx, dy, dw, dh) {
    var vertSquashRatio = detectVerticalSquash(img);
    // Works only if whole image is displayed:
    // ctx.drawImage(img, sx, sy, sw, sh, dx, dy, dw, dh / vertSquashRatio);
    // The following works correct also when only a part of the image is displayed:
    ctx.drawImage(img, sx * vertSquashRatio, sy * vertSquashRatio,
        sw * vertSquashRatio, sh * vertSquashRatio,
        dx, dy, dw, dh );
}

function uploadImageFile(oFile,id,fileNum,prefix)
{
    // Upload Foto
    oFReader = new FileReader(), rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

    var id = id;
    var fileNum = fileNum;
    oFReader.onload = function (oFREvent) {
        var img=new Image();
        img.onload=function(){
            var scaleHeight = 1;
            var scaleWidth  = 1;
            var canvas		= document.createElement("canvas"); // large
            var mCanvas		= document.createElement("canvas"); // medium
            var tCanvas		= document.createElement("canvas"); // thumb
            var ctx			= canvas.getContext("2d");
            var mCtx		= mCanvas.getContext("2d");
            var tCtx		= tCanvas.getContext("2d");

            var xMin		= 0;
            var yMin		= 0;
            var mxMin		= 0;
            var myMin		= 0;
            var txMin		= 0;
            var tyMin		= 0;

            var width		= 600;
            var height		= 600;
            var mWidth		= 300;
            var mHeight		= 300;
            var tWidth		= 100;
            var tHeight		= 100;

            canvas.width  = 600;
            canvas.height = 1000;
            mCanvas.width  = 300;
            mCanvas.height = 500;
            tCanvas.width  = 100;
            tCanvas.height = 167;

            if (img.width>img.height && img.width>600) {
                height = 1000;
                width  = (600/img.height) * img.width;
                //xMin   = (width - height) / 2;

                mHeight = height/2;
                mWidth  = width/2;
                //mxMin	= xMin/2;

                tHeight = height/6;
                tWidth  = width/6;
                //txMin	= xMin/6;
            }else if (img.height>600) {
                width  = 600;
                height = (1000/img.width) * img.height;
                //yMin   = (height - width) / 2;

                mHeight = height/2;
                mWidth  = width/2;
                //myMin	= yMin/2;

                tHeight = height/6;
                tWidth  = width/6;
                //tyMin	= yMin/6;
            }else {
                height = img.height;
                width  = img.width;

                if (img.width>img.height && img.width>300) {
                    mHeight = 300;
                    mWidth  = (300/img.height) * img.width;
                    //mxMin	= (mWidth - mHeight) / 2;

                    tHeight = mHeight/3;
                    tWidth  = mWidth/3;
                    //txMin	= mxMin/3;
                }else if (img.height>300) {
                    mWidth  = 300;
                    mHeight = (300/img.width) * img.height;
                    //myMin	= (mHeight - mWidth) / 2;

                    tHeight = mHeight/3;
                    tWidth  = mWidth/3;
                    //tyMin	= myMin/3;
                }else {
                    mHeight = img.height;
                    mWidth  = img.width;

                    if (img.width>img.height && img.width>100) {
                        tHeight = 100;
                        tWidth  = (100/img.height) * img.width;
                        //txMin	= (tWidth - tHeight) / 2;

                    }else if (img.height>100) {
                        tWidth  = 100;
                        tHeight = (100/img.width) * img.height;
                        //tyMin	= (tHeight - tWidth) / 2;

                    }else {
                        tHeight = img.height;
                        tWidth  = img.width;
                    }
                }
            }

            /*
             if (img.width>img.height && img.width>600) {
             canvas.width  = 600;
             canvas.height = (600/img.width) * img.height;
             //scaleWidth    = img.width/img.height;
             }else if (img.height>600) {
             canvas.height = 600;
             canvas.width  = (600/img.height) * img.width;
             //scaleHeight   = img.height/img.width;
             }else {
             canvas.height = img.height;
             canvas.width  = img.width;
             }

             if (canvas.width > canvas.height) {
             tCanvas.width  = 100;
             tCanvas.height = (100/img.width) * img.height;
             }else {
             tCanvas.height = 100;
             tCanvas.width  = (100/img.width) * img.height;
             }
             */
            //tCanvas.height = canvas.height/6;
            //tCanvas.width  = canvas.width/6;

            //ctx.drawImage(img,0,0,img.width,img.height,0,0,canvas.width,canvas.height);

            canvas.width   = (width<height)?width:height;
            canvas.height  = (width<height)?width:height;
            mCanvas.width  = (mWidth<mHeight)?mWidth:mHeight;
            mCanvas.height = (mWidth<mHeight)?mWidth:mHeight;
            tCanvas.width  = (tWidth<tHeight)?tWidth:tHeight;
            tCanvas.height = (tWidth<tHeight)?tWidth:tHeight;

            var vertSquashRatio = detectVerticalSquash(img);

            if (width>height) 	xMin  = (width - height)/2;
            if (width<height) 	yMin  = (height - width)/2;
            if (mWidth>mHeight) mxMin = (mWidth-mHeight)/2;
            if (mWidth<mHeight) myMin = (mHeight-mWidth)/2;
            if (tWidth>tHeight) txMin = (tWidth-tHeight)/2;
            if (tWidth<tHeight) tyMin = (tHeight-tWidth)/2;

            /*ctx.drawImage(img, 0, 0, img.width * vertSquashRatio, img.height * vertSquashRatio,
             0-xMin, 0-yMin, width, height );*/
            canvas.height = img.height;
            canvas.width = img.width;
            ctx.drawImage(img,0,0);

            mCtx.drawImage(img, 0, 0, img.width * vertSquashRatio, img.height * vertSquashRatio,
                0-mxMin, 0-myMin, mWidth, mHeight );

            tCtx.drawImage(img, 0, 0, img.width * vertSquashRatio, img.height * vertSquashRatio,
                0-txMin, 0-tyMin, tWidth, tHeight );

            console.log(id);

            //document.getElementById(id+'_image').value 		= canvas.toDataURL('image/jpeg', 0.8);
            document.getElementById(id+'_image').value 		= canvas.toDataURL('image/jpeg');
            document.getElementById(id+'_imageMed').value 	= mCanvas.toDataURL('image/jpeg', 0.9);
            document.getElementById(id+'_imageThumb').value = tCanvas.toDataURL('image/jpeg', 1.0);
            document.getElementById(id+'_preview').style.backgroundImage = "url('"+document.getElementById(id+'_image').value+"')";
            document.getElementById(id+'_preview').style.backgroundSize = "cover";
            document.getElementById(id+'_preview').style.backgroundPosition = "center center";
            document.getElementById(id+'_preview').style.marginBottom = "6px";
            document.getElementById(id+'_preview').style["boxShadow"] = "inset 0px 0px 0px 1px rgba(0,0,0,0.1)";

            if(varInputType == 1)
            {
                document.getElementById(id+'_preview').style.width = (300*scaleWidth)+"px";
                document.getElementById(id+'_preview').style.height = (300*scaleHeight)+"px";
            }else{
                if (id != "pr" && id != "resto") {
                    document.getElementById(id+'_preview').style.width = (185*scaleWidth)+"px";
                    document.getElementById(id+'_preview').style.height = (185*scaleHeight)+"px";
                }
            }
        }
        img.src=oFREvent.target.result;
    };
    oFReader.readAsDataURL(oFile);
    $("#count_images_"+prefix).val(fileNum);
}

function loadImageFile(inputFile,inputType,prefix) {
    //if (document.getElementById("uploadImage").files.length === 0) { return; }
    if (typeof inputType === "undefined" || inputType === null) {
        inputType = 0;
    }
    if (typeof prefix === "undefined" || prefix === null) {
			prefix = 'pp';
    }
    varInputType = inputType;
    $("#upload_"+prefix+"_result").html("");
    for(var i = 0; i < inputFile.files.length; i++)
    {
        var fileNum = i+1;
        var content = '';
        content += '<div id="'+prefix+fileNum+'_preview" name="uploadPreview"></div>';
        content += '<input id="'+prefix+fileNum+'_image" type="hidden" name="'+prefix+fileNum+'_image" value="">';
        content += '<input id="'+prefix+fileNum+'_imageMed" type="hidden" name="'+prefix+fileNum+'_imageMed" value="">';
        content += '<input id="'+prefix+fileNum+'_imageThumb" type="hidden" name="'+prefix+fileNum+'_imageThumb" value="">';
        if(inputType == 1)
        {
            content += '<p style="font-size: 13px;margin-bottom:2px;">' +
            '<input type="text" id="'+prefix+fileNum+'_caption" name="'+prefix+fileNum+'_caption" placeholder="Caption" style="margin-bottom:20px;border: 1px solid rgb(224, 224, 224);font-family: \'Arial\',sans-serif;font-size: 13px;padding: 4px 6px;width: 300px;"/>' +
            '</div><br/>';
        }
        $("#upload_"+prefix+"_result").html($("#upload_"+prefix+"_result").html()+content);
    }
    for(var i = 0; i < inputFile.files.length; i++)
    {
        var oFile = inputFile.files[i];
				id = prefix+(i+1);
        //if (!rFilter.test(oFile.type)) { alert("You must select a valid image file!"); return; }
        uploadImageFile(oFile,id,(i+1),prefix);
    }
}
