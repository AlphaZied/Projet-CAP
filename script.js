function show(continent){
	for(var i = 0; i < 6; i++){
		if(continent == i)document.getElementById('the_bouton'+i).style.display = "block";
    }
}

function deshow(continent){
	for(var i = 0; i < 6; i++){
		if(continent == i)document.getElementById('the_bouton'+i).style.display = "none";
    }
}

function plongeon(bp, bs){
	document.getElementById('all').style.background = "url('carte.jpg')";
	document.getElementById('all').style.backgroundPosition = bp;
	document.getElementById('all').style.backgroundSize = bs;
	all_disap();
}

function all_disap(){
	document.getElementById('the_bouton').style.display = "none";
	document.getElementById('ameriqueN').style.display = "none";
	document.getElementById('ameriqueS').style.display = "none";
	document.getElementById('europe').style.display = "none";
	document.getElementById('afrique').style.display = "none";
	document.getElementById('asie').style.display = "none";
	document.getElementById('oceanie').style.display = "none";
}