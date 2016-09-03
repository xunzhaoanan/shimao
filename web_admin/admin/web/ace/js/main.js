$(function(){
	var Oul=$(".special_template").find("ul");
	var Oli=$(".special_template").find("li");
	var Oliwidth=197;	
	var width_show=$(".special_template").width();
	var prev=$(".prev");
	var next=$(".next");
	var anLength=Math.ceil(Oliwidth*Oli.length/width_show);
	//alert(width_show);
	var cur=0;
	
	Oul.css("width",Oliwidth*Oli.length);
	
	next.click(function(){
		if(cur==anLength-1){
			cur=0;
		}else{
			cur=cur+1;	
		}
		var leftNow=-cur*width_show;
		Oul.stop(true,false).animate({"left":leftNow},2500);
	})
	prev.click(function(){
		if(cur==0){
			cur=anLength-1;	
		}else{
			cur=cur-1;	
		}
		var leftNow=-cur*width_show;
		Oul.stop(true,false).animate({"left":leftNow},2500);
	})
})
//滚动JS
