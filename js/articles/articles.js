$(document).ready(function(){	
	var domain = '/dapsite';
	var oTable = $("#admin_table").dataTable({
		"oLanguage": {
			"sUrl": domain+"/js/dataTables_ru_RU.js"
		},
		"sPaginationType": "full_numbers",
		"bStateSave": true,
		"sDom": '<"top_table"f>rt<"bottom_table"lp>',
		"fnInitComplete":function(){
			$(".table_wraper").sloind_table();
			
		},
		//"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": domain+"/backend/index/articles?act=articles&method=get"
	});	
	
	$("select",$(".action_table",this)).live("change",function(){
		switch($(this).val()){
			case 'publish':{
				$.add_notify({type: 'warning',text: 'Внимание! Запись не была удалена!'});
			};break;
			case 'unpublish':{
				$.add_notify({type: 'successfull',text: 'Все отлично. Все изменения сохранены.'});
			};break;
			case 'move':{
				
			};break;
			case 'delete':{
						
			};break;
			default:{
			};break;
		}
	});
});	