var vxodik = document.querySelector(".hide-for-planshet");
var openVxod = document.querySelector(".title-vxod");
			
var vxodik2 = document.querySelector(".hide-for-planshet-and-mobil");
var openVxod2 = document.querySelector(".title-vxod-for-mobil");
			
var burger = document.querySelector(".click-na-vkusn9shky");
var openBurger = document.querySelector(".hide-for-mobil");
			
var content = document.querySelector(".content");
var footer = document.querySelector("footer");
var body = document.querySelector("body");




var linkForOpenMenu = document.querySelector(".open-submenu-user");
var subenu = document.querySelector(".submenu-user");

var linkForOpenMenu2 = document.querySelector(".open-submenu-user2");
var subenu2 = document.querySelector(".submenu-user2");
			
			
function showHide(showElement) {
	if(showElement.style.display !=  'block' ) {
		showElement.style.display = 'block';
	}
				
	else {
		showElement.style.display = 'none';
	}
}
			
openVxod.addEventListener('click', function() {showHide(vxodik)});
			
burger.addEventListener('click', function() {showHide(openBurger)});


if (openVxod2 != null ) {	
	openVxod2.addEventListener('click', function() {
			
	if(vxodik2.style.display != 'block') {
		content.style.display='none';
		footer.style.display='none';
		body.style.background='white';
	}
	else {
		content.style.display='block';
		footer.style.display='block';
		body.style.background='#edeef0';
	}
					
	if(vxodik2.style.display !=  'block' ) {
		vxodik2.style.display = 'block';
	}
					
	else {
		vxodik2.style.display = 'none';
	}
});


}

	


if (linkForOpenMenu != null ) {
   
   linkForOpenMenu.addEventListener('click', function(eee) {
			eee.preventDefault();
			showHide(subenu)
	});
   
}

if (linkForOpenMenu2 != null ) {
   
   linkForOpenMenu2.addEventListener('click', function(eee) {
			eee.preventDefault();
			showHide(subenu2)
	});
   
}


