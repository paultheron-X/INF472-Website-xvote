// calInit
//
// initialise 
//
// divId = identifiant du bloc <div> qui va contenir le calendrier
// btName = nom qui sera afcihé sur le bouton pour afficher / masquer la calendrier (facultatif)
// fieldId = identifiant du champ dans lequel sera affiché la date
// classTable = class du tableau
// classTable = class des <tr>
// classSel = class de la date sélectionné
//
function calInit(divId, btName, fieldId, classTable, classDay, classSel){
	calDiv = document.getElementById(divId);
	dateEl = document.getElementById(fieldId);
	// vérifie l'existance de divId et fieldId
	if(calDiv==undefined || dateEl==undefined) return 0;
	var h = "";
	// si btName est définit, un bouton est créer. En cliquant sur ce bouton le calendrier est affiché / masqué
	// si btName n'est pas définit, on attache la fonction calToogle au champ de texte qui contiendra la date
	if(btName=="") dateEl.addEventListener('click', function(){	calToogleFromField(fieldId); }, false);
	else h = '<input type="button" value="'+btName+'" onclick="calToogle('+jsSDPId+');" />';
	// créer un bloc div qui contient des boutons de navigation, le titre et le bloc dans lequel sera affiché le calendrier
	h += '<div id="calendarWrap'+jsSDPId+'" class="calendarWrap"><ul><li><input type="button" value="&lsaquo;" onclick="calMonthNav('+jsSDPId+', \'-1\');" /></li><li id="calendarTitle'+jsSDPId+'" class="calendarTitle"></li><li><input type="button" value="&rsaquo;" onclick="calMonthNav('+jsSDPId+', \'+1\');" /></li></ul><div id="calendar'+jsSDPId+'"></div></div><div class="spacer"></div>';
	// ajoute le code HTML
	calDiv.innerHTML = h;
	// initialise l'objet jsSimpleDatePickr
	obj = new jsSimpleDatePickr('calendar'+jsSDPId);
	obj.funcDateClic = 'calClick';
	obj.classTable = classTable;
	obj.classTd = classDay;
	obj.classSelection = classSel;
	// sauvegarde l'objet, le champ de texte rattaché et l'id envoyé à jsSimpleDatePickr
	jsSDPObj[jsSDPId] = [obj, fieldId, 'calendar'+jsSDPId];
	jsSDPId++;
	return 1;
}
//
// affiche / masque le calendrier
//
function calToogle(id){
	if(jsSDPObj[id] == undefined) return 0;
	var el = document.getElementById('calendarWrap'+id);
	field = document.getElementById(jsSDPObj[id][1]);
	if(el.style.display=="block"){
		el.style.display = "none";
	}else{
		jsSDPObj[id][0].setDate(String(field.value));
		jsSDPObj[id][0].show('calendar');
		calShowTitle(id);
		el.style.display = "block";
	}
}
//
// affiche / masque le calendrier (clic depuis un champ de texte)
//
function calToogleFromField(fieldId){
	for(var i = 0; i<jsSDPObj.length; i++){
		if(jsSDPObj[i][1]==fieldId){
			calToogle(i);
			break;
		}
	}
}
//
// navigation par mois
//
function calMonthNav(id, val){
	if(jsSDPObj[id] == undefined) return 0;
	jsSDPObj[id][0].setMonth(val);
	jsSDPObj[id][0].show();
	calShowTitle(id);
}
//
// navigation par année
//
function calYearNav(id, val){
	if(jsSDPObj[id] == undefined) return 0;
	jsSDPObj[id][0].setYear(val);
	jsSDPObj[id][0].show();
	calShowTitle(id);
}
//
// callback : gère une clic sur une date
//
function calClick(dateStr, id){
	// cherche l'objet
	for(var i = 0; i<jsSDPObj.length; i++){
		if(jsSDPObj[i][2]==id){
			id = i;
			break;
		}
	}
	if(jsSDPObj[id] == undefined) return 0;
	var dateArr = dateStr.split('/');
	if(parseInt(dateArr[0], 10)<10) dateArr[0] = '0'+dateArr[0];
	if(parseInt(dateArr[1], 10)<10) dateArr[1] = '0'+dateArr[1];
	field = document.getElementById(jsSDPObj[id][1]);
	field.value = dateArr[0]+'/'+dateArr[1]+'/'+dateArr[2];
	document.getElementById('calendarWrap'+id).style.display = "none";
}
//
// affiche le titre
//
function calShowTitle(id){
	if(jsSDPObj[id] == undefined) return 0;
	document.getElementById('calendarTitle'+id).innerHTML = ' '+jsSDPMonthName[jsSDPObj[id][0].dateDisp.getMonth()]+' '+jsSDPObj[id][0].dateDisp.getFullYear()+' ';
}
//
// crée l'objet jsSimpleDatePickr
var jsSDPObj = Array();
var jsSDPId = 0;
var jsSDPMonthName = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'];