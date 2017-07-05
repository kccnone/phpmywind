/*******************************************************************************
* KindEditor - WYSIWYG HTML Editor for Internet
* Copyright (C) 2006-2011 kindsoft.net
*
* @author Roddy <luolonghao@gmail.com>
* @site http://www.kindsoft.net/
* @licence http://www.kindsoft.net/license.php
*******************************************************************************/

KindEditor.plugin('colorfore', function(K) {
	var self = this, name = 'colorfore';
	self.clickToolbar(name, function() {
		var key = "#999999";
		self.cmd.toggle('<span style="color:' + key + ';"></span>', {span : '.color=' + key});
	});
});
