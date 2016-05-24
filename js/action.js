
	
	

	function pilih(id_anu){
		jumlahPesan = 0;
		qty = $("#jumlah_"+id_anu+"").val();
		namaItem = $("#item_"+ id_anu +"").attr('title');
		hargaItem = $("#item_"+ id_anu +"").attr('value');
		dataid = $("#item_"+ id_anu +"").attr('id_data');
		
		if(qty != "")
		{
			kosong_edit(id_anu);
			//alert(qty);
			$("#item_"+ id_anu +"").attr('class','pilih');
			$("#frmBtn").attr('class','frmBtn');
			$("#frmBtn").show(200);
			var table = document.getElementById("myTable");
			var rows = table.getElementsByTagName('tr');
			jmlrow = rows.length;
			urutan = +jmlrow + 1;
						
			hargakali = +qty * +hargaItem;
			
			var row = table.insertRow(jmlrow);
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var cell3 = row.insertCell(2);
			var cell4 = row.insertCell(3);
			var cell5 = row.insertCell(4);

			row.setAttribute("data_row", dataid);
			row.setAttribute("id_row", id_anu);
			row.setAttribute("id", "u"+urutan);
			row.setAttribute("jml", qty);
			
			cell1.innerHTML = urutan;
			cell2.innerHTML = namaItem;
			cell3.innerHTML = qty;
			cell4.innerHTML = formatnum(hargakali);
			cell5.innerHTML = "<a href='javascript:;' onclick='deleteRow("+ id_anu +");' class='tombolhapus'>Remove <img src='img/x.png' border='0'/></a>";
			
			cell1.setAttribute("class", "tdright");
			cell2.setAttribute("class", "tdleft");
			cell4.setAttribute("class", "tdright");
			
			cell1.setAttribute("id", "id");
			cell2.setAttribute("id", "tdleft");
			cell4.setAttribute("id", "tdright");
			
			cell1.setAttribute("width", "21px");
			cell3.setAttribute("width", "23px");
			cell4.setAttribute("width", "116px");
			cell5.setAttribute("width", "104px");
			
			total = 0;
			
			for (i = 0; i <= jmlrow; i++) {
				str = rows[i].cells[3].innerHTML;
				strNumber = str.replace(/[\D\s]/g, '');

				total += +strNumber;
			}
			$("#total").html("Total &nbsp; &nbsp; Rp. &nbsp; "+ formatnum(total));
			$("#jmlpilih").val(urutan);
			if(total<=0){
				$(".frmtombol").hide();
			}else{
				$(".frmtombol").show();
			}
	
		}else{
			$("#item_"+ id_anu +"").attr('class','');
			jmlmenu = $("#jmlmenu").val();
			for(i=1;i<=jmlmenu;i++){
				jumlahPesan += $("#jumlah_"+i).val();
			}
			
			if(jumlahPesan==0){
				$("#frmBtn").hide(200);
			}
			
			kosong_edit(id_anu);
		}
	}







	function kosong_edit(idn){
		/* kosong atau edit saat klik select jumlah menu*/
			
		var table = document.getElementById("myTable");
		var rowCount = table.rows.length;
		
		for(i=0; i<rowCount; i++) {
		
			var idm = table.rows[i].getAttribute("id_row");
			var row = table.rows[i].cells[0].innerHTML = +i + 1;
			var row2 = table.rows[i].setAttribute("id","u"+row) ;
			if(idm == idn) {
				table.deleteRow(i);
				rowCount--;
				i--;
			}
		}
		
		total = 0;
			
		for (i = 0; i < rowCount; i++) {
			
			str = table.rows[i].cells[3].innerHTML;
			
			strNumber = str.replace(/[\D\s]/g, '');

			total += +strNumber;
		}
		$("#total").html("Total &nbsp; &nbsp; Rp. &nbsp; "+ formatnum(total));
		if(total<=0){
			$(".frmtombol").hide();
		}else{
			$(".frmtombol").show();
		}
	}
	
	$("#cat_1").click(function(){
		
		$("#catMinuman").hide(0);
		$("#catJajanan").hide(0);
		$("#catlist").hide(0);
		$("#catMakanan").hide().fadeIn(10);
		
		$("#cat_1").attr('class','pilih');
		$("#cat_2").attr('class','');
		$("#cat_3").attr('class','');
		
		var table = document.getElementById("myTable");
		jmlrow = table.getElementsByTagName('tr').length;
		if(jmlrow>=1){
			$("#frmBtn").show(200);
		}
		
	});
	$("#cat_2").click(function(){
		
		$("#catMakanan").hide(0);
		$("#catJajanan").hide(0);
		$("#catlist").hide(0);
		$("#catMinuman").hide().fadeIn(10);
		
		$("#cat_1").attr('class','');
		$("#cat_2").attr('class','pilih');
		$("#cat_3").attr('class','');
		
		var table = document.getElementById("myTable");
		jmlrow = table.getElementsByTagName('tr').length;
		if(jmlrow>=1){
			$("#frmBtn").show(200);
		}
		
	});
	$("#cat_3").click(function(){
		
		$("#catMinuman").hide(0);
		$("#catMakanan").hide(0);
		$("#catlist").hide(0);
		$("#catJajanan").hide().fadeIn(10);
		
		$("#cat_1").attr('class','');
		$("#cat_2").attr('class','');
		$("#cat_3").attr('class','pilih');
		
		var table = document.getElementById("myTable");
		jmlrow = table.getElementsByTagName('tr').length;
		if(jmlrow>=1){
			$("#frmBtn").show(200);
		}
		
	});
	$("#cat_4").click(function(){
		
		$("#catMinuman").hide(0);
		$("#catMakanan").hide(0);
		$("#catJajanan").hide(0);
		$("#catlist").hide().fadeIn(10);
		
		$("#cat_1").attr('class','');
		$("#cat_2").attr('class','');
		$("#cat_3").attr('class','');
		
		$("#frmBtn").hide(100);
	});
	
$(document).ready(function(){
	$("#frmBtn").hide(0);
	$("#catlist").hide(0);
	$("#catMinuman").hide(0);
	$("#catJajanan").hide(0);
	

	
	$.ajax({
		type: "POST",
		url: "inc/aksi_stasiun.php",
		data: "&aksi=onload",
		cache: false,
		beforeSend: function()
		{
			
		},
		success: function(response)
		{
			$("#loaded_contents_brought").hide().fadeIn(500).html(response);
			totalygdipesan = $("#totalygdipesan").val();
			$("#totalygdipesan2").html('Rp. &nbsp; &nbsp; '+totalygdipesan);
		}
	});
	
	var ajax_call = function() {
		$.ajax({
			type: "POST",
			url: "inc/aksi_stasiun.php",
			data: 'costomer=ada&aksi=2',
			cache: false,
			beforeSend: function()
			{
			},
			success: function()
			{
			}
		});
	};
	
	var interval = 6000; // 1000 = 1 detik
	setInterval(ajax_call, interval);
	
});	
	
	$("#btnpesan").click(function(){
		jmlpilih = $("#jmlpilih").val();
		if(jmlpilih != "" || jmlpilih != "0")
		{ 	dataString = "";
			for (i = 1; i <= jmlpilih; i++) {
				dataString = dataString + "u" + i + "=" + $("#u"+i).attr("data_row") + "&jml" + i + "=" + $("#u"+i).attr("jml") + "&";
			}
			dataString = dataString + "jmlpilih=" + jmlpilih + "&aksi=pesanbaru";
			$.ajax({
				type: "POST",
				url: "inc/aksi_stasiun.php",
				data: dataString,
				cache: false,
				beforeSend: function()
				{
					$("#loaded_contents_brought").html('<br clear="all"><div align="center"><font style="font-family:Arial,Tahoma;font-size:16px;">Sedang Mengirim<br /></font><img src="img/loadings.gif"/></div><br clear="all">');
					$("#btnpesan").hide();
					$("#btnbatal").hide();
				},
				success: function(response)
				{
					$("#loaded_contents_brought").hide().fadeIn(500).html(response);
					$("#btnpesan").show();
					$("#btnbatal").show();
					batal();
					totalygdipesan = $("#totalygdipesan").val();
					$("#totalygdipesan2").html('Rp. &nbsp; &nbsp; '+totalygdipesan);
				}
			});
		}
	});

	
	
	function batal(){
		
		var table = document.getElementById("myTable");
		jmlrow = table.getElementsByTagName('tr').length;
		jmlrow = +jmlrow - 1;
		for (i = jmlrow; i >=0 ; i--) {
			table.deleteRow(i);
		}
		jmlmenu = $("#jmlmenu").val();
		for(i=1;i<=jmlmenu;i++){
			$("#dikali"+i).html('');
			$("#item_"+i).attr('class','');
			$("#jumlah_"+i).val('');
			
		}
		
		$("#total").html("Total &nbsp; &nbsp; Rp. &nbsp; 0");
		$("#jmlpilih").val("");
		$(".frmtombol").hide(0);
		$("#cat_1").attr('class','pilih');
		$("#catlist").hide(0);
		$("#frmBtn").hide(0);
		$("#catMakanan").hide(0).fadeIn(300);

	}
	
	
	
	
	
	
	
	
	function deleteRow(idn){
		var table = document.getElementById("myTable");
		var rowCount = table.rows.length;
		
		for(i=0; i<rowCount; i++) {
			
			idm = table.rows[i].getAttribute("id_row");
			row = table.rows[i].cells[0].innerHTML = +i + 1;
			row2 = table.rows[i].setAttribute("id","u"+row) ;
			
			if(idm == idn) {
				table.deleteRow(i);
				rowCount--;
				i--;
				
				$("#item_"+ idn).attr('class','');
				$("#jumlah_"+idn).val("")
			}
		}
		
		total = 0;
			
		for (i = 0; i < rowCount; i++) {
			
			str = table.rows[i].cells[3].innerHTML;
			
			strNumber = str.replace(/[\D\s]/g, '');

			total += +strNumber;
		}
		$("#total").html("Total &nbsp; &nbsp; Rp. &nbsp; "+ formatnum(total));
		$("#jmlpilih").val(rowCount);
		if(total<=0){
			$(".frmtombol").hide();
		}else{
			$(".frmtombol").show();
		}
	}
	
	
	
	
	
	
	
	
	function formatnum(num){
		var n = num.toString(), p = n.indexOf(',');
		return n.replace(/\d(?=(?:\d{3})+(?:\.|$))/g, function($0, i){
			return p<0 || i<p ? ($0+'.') : $0;
		});
	}