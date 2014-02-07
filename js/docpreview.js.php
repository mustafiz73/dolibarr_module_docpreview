<?
	if(is_file('../../master.inc.php'))  require('../../master.inc.php');
	else require('../../../master.inc.php');
?>

function docPreview_set_link() {
	$('a[href]').each(function() {
		
		var url = $(this).attr('href');
		
		if(url.indexOf('document.php?')!=-1 && url.indexOf('.pdf')!=-1 ) {
			filename = $(this).text();
			if(filename == '') filename = $(this).find('img').attr('alt');
			
			url = "javascript:docPreview_pop('<?= dol_buildpath('/docpreview/Viewer.js',1) ?>#"+url+"', filename)";
			link = '&nbsp;<a href="'+url+'"><?= img_object('Preview','docpreview@docpreview') ?></a>';
			
			$(this).after(link);
		}
		
	});
}

function docPreview_pop(url, filename) {
	
	if($('#docpreview').length==0) {
		$('body').append('<div id="docpreview"><iframe src="#" width="100%" height="98%" allowfullscreen webkitallowfullscreen></iframe></div>');
	}
	
	$('#docpreview').dialog({
		title: "<?= $langs->trans('PreviewOf') ?> " + filename
		,width:'80%'
		,height:600
		,modal:true
		,resizable: false
		,close:function() {
			$('#docpreview iframe').attr('src', '#');
		}
	});
	
	$('#docpreview iframe').attr('src', url);
	
}

$(document).ready(function() {
	docPreview_set_link();
});