/*
 * jQuery GMenu v 1
 * http://
 *
 * Copyright 2010, Linnik
 * Free to use
 * 
 * September 2010
 */
jQuery.fn.LiFileType = function(options){
	var options = jQuery.extend({
		//gh: 25 //Высота пунктов меню
	},options);
	return this.each(function() {
		var loadFile = $(this);
		var fileIcon = $('<span>').addClass('fileIcon').prependTo(loadFile);
		var file = loadFile.attr('href')
		var reWin = /.*\\(.*)/;
		var fileTitle = file.replace(reWin, "$1"); //выдираем название файла для w*s
		reUnix = /.*\/(.*)/;
		var fileTitle = fileTitle.replace(reUnix, "$1"); //выдираем название для *nix
		var RegExExt =/.*\.(.*)/;
		var extPre = fileTitle.replace(RegExExt, "$1");//и его расширение
		ext = extPre.substr(0,3)
		var pos;
		if (ext){
			switch (ext.toLowerCase())
			{
				case 'doc': pos = '0'; break;
				case 'bmp': pos = '16'; break;                       
				case 'jpg': pos = '32'; break;
				case 'jpe': pos = '32'; break;
				case 'png': pos = '48'; break;
				case 'gif': pos = '64'; break;
				case 'psd': pos = '80'; break;
				case 'mp3': pos = '96'; break;
				case 'wav': pos = '96'; break;
				case 'ogg': pos = '96'; break;
				case 'avi': pos = '112'; break;
				case 'wmv': pos = '112'; break;
				case 'flv': pos = '112'; break;
				case 'pdf': pos = '128'; break;
				case 'exe': pos = '144'; break;
				case 'txt': pos = '160'; break;
				case 'xls': pos = '192'; break;
				case 'rar': pos = '208'; break;
				case 'zip': pos = '224'; break;
				default: pos = '176'; break;
			};
			fileIcon.css({backgroundPosition:'0 -'+pos+'px'})
		};
	});
};