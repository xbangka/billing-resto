
function afterSuccess()
{
	$("#myrespon").modal('hide');

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#imageInput').val()) //check empty input filed
		{
			$("#boxperingatan").hide().fadeIn(500).html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Maaf, gambar harus diisi.</div>');
			return false
		}
		
		var fsize = $('#imageInput')[0].files[0].size; //get file size
		var ftype = $('#imageInput')[0].files[0].type; // get file type
		

		//allow only valid image file types 
		switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
            default:
				$("#boxperingatan").hide().fadeIn(500).html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><b>'+ftype+'</b> type file tidak suport.</div>');
				return false
        }
		
		//Allowed file size is less than 1 MB (1048576)
		if(fsize>1048576) 
		{
			$("#boxperingatan").hide().fadeIn(500).html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><b>'+bytesToSize(fsize) +'</b> terlalu besar untuk di upload.</div>');
			return false
		}
		
		//validasi Nama Menu
		if($('#inputnamamenu').val() == '') 
		{
			$("#boxperingatan").hide().fadeIn(500).html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Mohon nama menu harus di isi.</div>');
			$("#divvalidationinputnama").removeClass();
			$("#divvalidationinputnama").addClass("has-warning has-feedback");
			$("#iconwarningnama").removeClass();
			$("#iconwarningnama").addClass("fa fa-warning form-control-feedback");
			return false
		}
		
		//validasi Harga Menu
		if($('#inputharga').val() == '') 
		{
			$("#boxperingatan").hide().fadeIn(500).html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Mohon harga menu harus di isi.</div>');
			$("#divvalidationinputharga").removeClass();
			$("#divvalidationinputharga").addClass("has-warning has-feedback");
			$("#iconwarningharga").removeClass();
			$("#iconwarningharga").addClass("fa fa-warning form-control-feedback");
			return false
		}
		
		$("#boxperingatan").html("");
		$("#BaruModal").modal('hide');
		$("#myrespon").modal('show');
	}
	else
	{
		//Output error to older browsers that do not support HTML5 File API
		$("#boxperingatan").hide().fadeIn(500).html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Maaf, mohon untuk upgrade browser-mu, saat ini browser-mu tidak mendukung fitur ke-kinian.</div>');
		return false;
	}
}


//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}




//function to check file size before uploading.
function beforeSubmit2(){
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( $('#imageedit').val() != '') //check empty input filed
		{

			var fsize = $('#imageedit')[0].files[0].size; //get file size
			var ftype = $('#imageedit')[0].files[0].type; // get file type
			
	
			//allow only valid image file types 
			switch(ftype)
			{
				case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
					break;
				default:
					$("#boxperingatan2").hide().fadeIn(500).html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><b>'+ftype+'</b> type file tidak suport.</div>');
					return false
			}
			
			//Allowed file size is less than 1 MB (1048576)
			if(fsize>1048576) 
			{
				$("#boxperingatan2").hide().fadeIn(500).html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><b>'+bytesToSize(fsize) +'</b> terlalu besar untuk di upload.</div>');
				return false
			}
			
		}
		
		
		
		
		//validasi Nama Menu
		if($('#editnamamenu').val() == '') 
		{
			$("#boxperingatan2").hide().fadeIn(500).html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Mohon nama menu harus di isi.</div>');
			$("#divvalidationeditnama").removeClass();
			$("#divvalidationeditnama").addClass("has-warning has-feedback");
			$("#iconwarningnama2").removeClass();
			$("#iconwarningnama2").addClass("fa fa-warning form-control-feedback");
			return false
		}
		
		//validasi Harga Menu
		if($('#editharga').val() == '') 
		{
			$("#boxperingatan2").hide().fadeIn(500).html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Mohon harga menu harus di isi.</div>');
			$("#divvalidationeditharga").removeClass();
			$("#divvalidationeditharga").addClass("has-warning has-feedback");
			$("#iconwarningharga2").removeClass();
			$("#iconwarningharga2").addClass("fa fa-warning form-control-feedback");
			return false
		}
		
		$("#boxperingatan2").html("");
		$("#EditModal").modal('hide');
		$("#myrespon").modal('show');
	}
	else
	{
		//Output error to older browsers that do not support HTML5 File API
		$("#boxperingatan2").hide().fadeIn(500).html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Maaf, mohon untuk upgrade browser-mu, saat ini browser-mu tidak mendukung fitur ke-kinian.</div>');
		return false;
	}
}