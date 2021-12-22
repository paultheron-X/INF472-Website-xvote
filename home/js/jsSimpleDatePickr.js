/*http://blog.niap3d.com/jsSimpleDatePickr*/
function jsSimpleDatePickr(id){
var me = this;
me.dateDisp = new Date();
me.dateSel = new Date();
me.dayOrder = '1234560';
me.dayName = ['D', 'L', 'M', 'M', 'J', 'V', 'S'];
me.id = id;
me.funcDateClic = me.classTable = me.classTd = me.classSelection = '';
me.setDate = function(dateStr){
	if(!dateStr) return 0;
	var dateArr = dateStr.split('/');
	if(isNaN(dateArr[0])) return 0;
	today = new Date();
	if(isNaN(dateArr[1])) dateArr[1] = today.getMonth();
	else dateArr[1] = parseInt(dateArr[1], 10)-1;
	if(isNaN(dateArr[2])) dateArr[2] = today.getFullYear();
	else if(parseInt(dateArr[2], 10)<100) dateArr[2] = parseInt(dateArr[2], 10)+2000;
	me.dateSel = new Date(dateArr[2], dateArr[1], dateArr[0]);
	me.dateDisp = new Date(dateArr[2], dateArr[1], dateArr[0]);
}
me.setMonth = function(val){
	var v = parseInt(val, 10);
	if(val.charAt(0)=='+' || val.charAt(0)=='-') v = me.dateDisp.getMonth()+v;
	me.dateDisp.setMonth(v);
}
me.setYear = function(val){
	var v = parseInt(val, 10);
	if(val.charAt(0)=='+' || val.charAt(0)=='-') v = me.dateDisp.getFullYear()+v;
	me.dateDisp.setFullYear(v);
}
me.show = function(){
	var nb = today = 0;
	var month = me.dateDisp.getMonth();
	var year = me.dateDisp.getFullYear();
	if(month==me.dateSel.getMonth() && year==me.dateSel.getFullYear()) today = me.dateSel.getDate();
	var h = '<table class="'+me.classTable+'"><tr>';
	for(var i=0; i<7; i++){
		h += '<th>'+me.dayName[me.dayOrder[i]]+'</th>';
	}
	h += '</tr><tr>';
	var d = new Date(year, month, 1);
	for(nb=0; nb<me.dayOrder.indexOf(d.getDay()); nb++){
		h += '<td> </td>';
	}
	d.setMonth(month+1, 0);
	for(i=1; i<=d.getDate(); i++){
		nb++;
		if(nb>7){
			nb = 1;
			h += '</tr><tr>';
		}
		h += '<td class="'+(i==today ? me.classSelection:me.classTd)+'"><a href="#"'+(me.funcDateClic!='' ? ' onclick="'+me.funcDateClic+'(\''+i+'/'+(month+1)+'/'+year+'\', \''+me.id+'\');return false;"':'')+'>'+i+'</a></td>';
	}
	for(i=nb; i<7; i++){
		h += '<td> </td>';
	}
	h += '</tr></table>';
	document.getElementById(me.id).innerHTML = h
}
}