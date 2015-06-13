var banner_index = 2,prv_banner_index=1;
var banner_num ;
var s ;
var delayTime ;
var obj ;
$(document).ready(function(){
	
	$(".banner_ctrl a").hover(function(){
		$(this).fadeTo(100,.5);
		},function(){
		$(this).fadeTo(100,.1);
	});
			
	var tNum=$(".m_banner .banner").length-1;
	var nNum=0;		
	$(".banner_ctrl .prev").click(function(){
		(nNum-1)<0?n2=tNum:n2=nNum-1;
		bSwitch(nNum,n2);
		nNum=n2;
	});	
	$(".banner_ctrl .next").click(function(){
		(nNum+1)>tNum?n2=0:n2=nNum+1;
		bSwitch(nNum,n2);
		nNum=n2;
	});
	function bSwitch(nNum,n2){
		$(".m_banner .banner:eq("+nNum+")").fadeOut();
		$(".m_banner .banner:eq("+n2+")").fadeIn();
	};
							
	$(function(){
		var switchTime;
	 	$(".m_banner").hover(function(){
			clearInterval(switchTime);
		},function(){
		switchTime = setInterval(function(){
			(nNum+1)>tNum?n2=0:n2=nNum+1;
			bSwitch(nNum,n2);
			nNum=n2;
		},8000);
		}).trigger("mouseleave");
	});
	
	$(".notice_box").animate({bottom:0});
	$(".notice_box_t .close").click(function(){
		$(".notice_box").fadeOut();
	});

});

function delayHide(){
	$(obj).children(".s_nav").removeClass("fade_in");
	if(delayTime)
		clearTimeout(delayTime);
	delayTime = null;
	obj = null;
}

function slide() {
	if (banner_index > banner_num) {banner_index = 1;} 
	$('#c'+banner_index).addClass("curr");
	if(prv_banner_index > 0){
		$('#c'+prv_banner_index).removeClass("curr");
	}
	$('#banner'+banner_index).fadeIn(500);
	if(prv_banner_index > 0){
		$('#banner'+prv_banner_index).hide(); 
	}
	prv_banner_index=banner_index;
	banner_index++;
}
function convert(index){
	if($('#c'+index).hasClass("curr"))
		return ;
	
	if(s != null){
		clearInterval(s);
		s = null ;
	}
	banner_index = index ;
	prv_banner_index = ( prv_banner_index == 0 ? 1 : prv_banner_index );
	$('#c'+banner_index).addClass("curr");
	$('#c'+prv_banner_index).removeClass("curr");
	$('#banner'+banner_index).fadeIn(500);
	$('#banner'+prv_banner_index).hide();
	prv_banner_index=banner_index;banner_index++;
	if(s == null )
		s=setInterval(slide, 8000); 
}
function go(url){
	$("#gform").attr("action",url);
	$("#gform").submit();
}



/* 
* MyCxcPlug 1.0 
* Copyright (c) 2013 ChenXiaoChuan 157972671
* Date: 2013-09-15
* 多种Jquery效果集合，调用简单，转载或者修改请保存原有作者信息。
*/
;(function ($) {
   //按像素无缝滑动
   PixelScroll=function(Pixel){
       Pixel=$.extend({
          Id:"",//第一个ID
          IdOne:"",//第二个ID
          IdTwo:"",//第三个ID
          Space:0,//每次滚动像素
          Direction:"",//移动方向
          Speed:5000//滚动速度
       },Pixel);
       var lst=$("#"+Pixel.Id);
       var lst1=$("#"+Pixel.IdOne);
       var lst2=$("#"+Pixel.IdTwo);
       lst2.html(lst1.html());
       function Top(){
          if(lst.scrollTop()>=lst1.height()){
             lst.scrollTop(0);
          }lst.animate({scrollTop:lst.scrollTop()+ Pixel.Space},{ duration:600 , queue:false });
       }
       function Down(){
          if(lst.scrollTop()==0){
             lst.scrollTop(lst1.height());
          }lst.animate({scrollTop:lst.scrollTop()-Pixel.Space},{ duration:600 , queue:false });
       }
       function Left(){
          if(lst.scrollLeft()>=lst1.width()){
             lst.scrollLeft(0);
          }lst.animate({scrollLeft:lst.scrollLeft()+ Pixel.Space},{ duration:600 , queue:false });   
       }
       function Right(){
          if(lst.scrollLeft()==0){
             lst.scrollLeft(lst1.width());
          }lst.animate({scrollLeft:lst.scrollLeft()- Pixel.Space},{ duration:600 , queue:false });   
       }
       function Marquee(){
          switch(Pixel.Direction){
             case "left": Left();break;
             case "right": Right();break;
             case "top":Top();break;
             case "down":Down();break;
          }
       }
       var MyMar=setInterval( function(){ Marquee()},Pixel.Speed)
       lst.mouseover(function(){
           clearInterval(MyMar);
       });
       lst.mouseout(function(){
           MyMar=setInterval(Marquee,Pixel.Speed);
       });
   }
   //按像素无缝滑动
   SeamLessScroll=function(Pixel){
       Pixel=$.extend({
          Id:"",//第一个ID
          IdOne:"",//第二个ID
          IdTwo:"",//第三个ID
          Direction:"",//移动方向
          Speed:5000//滚动速度
       },Pixel);
       var lst=$("#"+Pixel.Id);
       var lst1=$("#"+Pixel.IdOne);
       var lst2=$("#"+Pixel.IdTwo);
       lst2.html(lst1.html());
       function Top(){
          if(lst.scrollTop()>=lst1.height()){
             lst.scrollTop(0);
          }else{
             lst.scrollTop(lst.scrollTop()+1);
          }
       }
       function Down(){
          if(lst.scrollTop()==0){
             lst.scrollTop(lst1.height());
          }else{
             lst.scrollTop(lst.scrollTop()-1);
          }
       }
       function Left(){
          if(lst.scrollLeft()>=lst1.width()){
             lst.scrollLeft(0);
          }else{
             lst.scrollLeft(lst.scrollLeft()+1);
          } 
       }
       function Right(){
          if(lst.scrollLeft()==0){
             lst.scrollLeft(lst1.width());
          }else{
             lst.scrollLeft(lst.scrollLeft()-1);
          } 
       }
       function Marquee(){
          switch(Pixel.Direction){
             case "left": Left();break;
             case "right": Right();break;
             case "top":Top();break;
             case "down":Down();break;
          }
       }
       var MyMar=setInterval( function(){ Marquee()},Pixel.Speed)
       lst.mouseover(function(){
           clearInterval(MyMar);
       });
       lst.mouseout(function(){
           MyMar=setInterval(Marquee,Pixel.Speed);
       });
   }
   //自动选项卡
   MyTab=function(Pixel){
       Pixel=$.extend({
          Content:"",
          LstId:"",//列表ID
          Active:"",//选中样式
          Normal:"",//没有选中样式
          Default:1,//默认选中
          Activation:"click",//执行事件
          Automatic:true,//是否自动执行
          Speed:2000,//每个几秒执行
          Delay:0//延迟几秒执行
       },Pixel);
       var timer;
       var Number=Pixel.Default;
       var len=$("#"+Pixel.LstId+" li").length;
       $("#"+Pixel.LstId+" li").each(function(TabI){
          if(TabI!=Pixel.Default){
             $("#"+Pixel.LstId+" li:eq("+TabI+")").addClass(Pixel.Normal);
          }else{
             $("#"+Pixel.LstId+" li:eq("+Pixel.Default+")").addClass(Pixel.Active);
          }
       });
       function TabEvent(Num){
           $("#"+Pixel.LstId+" li").removeClass();
           for(var i=0;i<$("#"+Pixel.LstId+" li").length;i++){
              if(i==Num){
                 $("#"+Pixel.LstId+"_Content"+i).show();
                 $("#"+Pixel.LstId+" li:eq("+i+")").addClass(Pixel.Active);
                 Number=i;
              }else{
                 $("#"+Pixel.LstId+"_Content"+i).hide();
                 $("#"+Pixel.LstId+" li:eq("+i+")").addClass(Pixel.Normal);
              }
           }
       }
       switch(Pixel.Activation){
          case "click":$("#"+Pixel.LstId+" li").click(function(){var Index=$(this).index();setTimeout(function(){TabEvent(Index)},Pixel.Delay)});break;
          case "hover":$("#"+Pixel.LstId+" li").hover(function(){var Index=$(this).index();timer= setTimeout(function(){TabEvent(Index)},Pixel.Delay)},function(){clearTimeout(timer)});break;
       }
       var MyTab=setInterval(function(){if(Pixel.Automatic==true){TabEvent((Number+1)%len)}},Pixel.Speed)
       $("#"+Pixel.Content).mouseover(function(){
           clearInterval(MyTab);
       });
       $("#"+Pixel.Content).mouseout(function(){
           MyTab=setInterval(function(){if(Pixel.Automatic==true){TabEvent((Number+1)%len)}},Pixel.Speed);
       });
   }
    //图片淡入淡出切换
   ImgSwitch=function(Pixel){
       Pixel=$.extend({
          Id:"",//主ID
          Element:"p",//执行切换元素
          Speed:2000//每个几秒执行
       },Pixel);
       var ImgNum=0;
       var ImgLst=$("#"+Pixel.Id +" "+Pixel.Element+"");
       var ImgLen=ImgLst.length;
       $("#"+Pixel.Id +" "+Pixel.Element+":not(:first)").hide();
       function Switch(){
         var Nest=(ImgNum+1)%ImgLen;
         $("#"+Pixel.Id +" "+Pixel.Element+":eq("+ImgNum%ImgLen+")").fadeOut("slow",function(){
            $("#"+Pixel.Id +" "+Pixel.Element+":eq("+Nest+")").fadeIn("slow"); 
         });
         ImgNum++
       }
       var MyMar=setInterval( function(){ Switch()},Pixel.Speed)
       $("#"+Pixel.Id).mouseover(function(){
           clearInterval(MyMar);
       });
       $("#"+Pixel.Id).mouseout(function(){
           MyMar=setInterval(Switch,Pixel.Speed);
       });
    }
   //焦点幻灯片
   CxcFocus=function(FocusNum){
       FocusNum=$.extend({
          Id:"",
          Time:5000
       },FocusNum);
       $("#"+FocusNum.Id).css("position","relative");
       $("#"+FocusNum.Id+" ul").attr("id","pic")
       var Li="#"+FocusNum.Id+" li";
       $(Li+":not(:first)").hide();
       var i=0;
       var len=$(Li).length;
       var LstUL ="<ul class='num'>";
       $(Li).each(function(NumI){
          var Numi=NumI+1;
          LstUL +="<li>"+Numi+"</li>";
       });
       LstUL +="</ul>";
       $("#"+FocusNum.Id).append(LstUL);
       $("#"+FocusNum.Id+" .num li:eq(0)").addClass("active");
       function Objstr(){
         var mo=(i+1)%len;
         $(Li+":eq("+i%len+")").fadeOut("slow",function(){
            $(Li+":eq("+mo+")").fadeIn("slow"); 
            $("#"+FocusNum.Id+" .num li").removeClass("active");
            $("#"+FocusNum.Id+" .num li:eq("+mo+")").addClass("active");
         });
         i++
       }
       var onload= setInterval(function(){Objstr()},FocusNum.Time)
       $("#"+FocusNum.Id+"").hover(function(){
          clearInterval(onload);
       },function(){
          onload=setInterval(function(){Objstr()},FocusNum.Time)
       });
       $("#"+FocusNum.Id+" .num li").click(function(){
          $("#pic li").hide();
          $(Li+":eq("+$(this).index()%len+")").fadeOut("slow",function(){
             $(Li+":eq("+$(this).index()+")").fadeIn("slow"); 
             $("#"+FocusNum.Id+" .num li").removeClass("active");
             $("#"+FocusNum.Id+" .num li:eq("+($(this).index())%len+")").addClass("active");
          });
          i=$(this).index();
       });
   }  
   //弹出层
   Popuplayer=function(Pixel){
       Pixel=$.extend({
          LayerId:"",//层ID
          Masklayer:"",//遮罩层ID
          CloseID:"",//退出id
          Fun:function(){} //关闭时是否回调函数
       },Pixel);
       var File=$("#"+Pixel.LayerId);
       var Mask=$("#"+Pixel.Masklayer);
       var Close=$("#"+Pixel.CloseID);
       Mask.css({
          "filter":"alpha(opacity=40)",
          "opacity": "0.4",
          "background": "#fff",
          "width":"100%",
          "height":$(document).height(), 
          "position":"absolute",
          "top":"0",
          "left":"0",
          "z-index":"100",
          "display":"none"
       });
       Mask.show();
       File.fadeIn();
       var dialog_w=File.width();
       var dialog_h=File.height();
       var Browser_w=$(window).width();
       var Browser_h=$(window).height();
       var boxdiv_l=(Browser_w-dialog_w)/2;
       var boxdiv_t=((Browser_h-dialog_h)/2)+$(document).scrollTop();
       File.css({
          "z-index":"200",
          "position":"absolute",
          "left":boxdiv_l,
          "top":boxdiv_t
       });
       window.onresize=function(){
          var Browser_ws=$(window).width();
          var Browser_hs=$(window).height();
          var boxdiv_ls=(Browser_ws-dialog_w)/2;
          var boxdiv_ts=((Browser_hs-dialog_h)/2)+$(document).scrollTop();
          File.css({
             "z-index":"200",
             "position":"absolute",
             "left":boxdiv_ls,
             "top":boxdiv_ts
          });
       }
       $(window).scroll(function (){
         var offsetTop = ((Browser_h-dialog_h)/2) +$(document).scrollTop() +"px"; 
         File.animate({top : offsetTop },{ duration:600 , queue:false });  
       });
       Close.click(function(){
          Mask.hide();
          File.fadeOut();
          Pixel.Fun();
       });
       Mask.click(function() {
         if (File.is(":visible")) {
            Mask.hide();
            File.fadeOut();
            Pixel.Fun();
         }
      });
   }
   //自定义滚动条
   PalyScroll=function(Pixel){
       Pixel=$.extend({
          ScrollContent:"",//滚动最大内容id
          ContentOneId:"",//内容外层id
          ContentTwoId:"",//内容id
          ScrollOneId:"",//滚动条外层id
          ScrollTwoId:""//滚动条id
       },Pixel);
       var Bool=false;
       var Scro=$("#"+Pixel.ScrollOneId);
       var Scrp=$("#"+Pixel.ScrollTwoId);
       var Scrobd=$("#"+Pixel.ContentOneId);
       var Scroul=$("#"+Pixel.ContentTwoId);
       var Scrp_Height =Scrp.outerHeight()/2;
       var Num2=Scro.outerHeight()-Scrp.outerHeight();
       var offsetX=0;
       var offsetY=0;
       Scrp.mousedown(function(e){  
          Bool=true;  //当鼠标在移动元素按下的时候将bool设定为true
       });
       $(document).mouseup(function(){
          Bool=false;//当鼠标在移动元素起来的时候将bool设定为false
       });
       $(document).mousemove(function(e){
          if(Bool){
             var Num1= e.clientY - Scro.position().top;
             var y=Num1 - Scrp_Height;
             if(y<=1){
                Scrll(0);
                Scrp.css("top",1);
             }else if(y>=Num2){
                Scrp.css("top",Num2);
                Scrll(Num2);
             }else{
                Scrll(y);
             }
          }
       });
       function Scrll(y){
          Scrp.css("top",y);
          Scroul.css("margin-top",-(y/(Scro.outerHeight()-Scrp.outerHeight()))*(Scroul.outerHeight()-Scrobd.height()));
       }
       if(document.getElementById(Pixel.ScrollContent).addEventListener) 
          document.getElementById(Pixel.ScrollContent).addEventListener('DOMMouseScroll',wheel,true);
       document.getElementById(Pixel.ScrollContent).onmousewheel=wheel;
       var Distance=Num2*0.1;
       function wheel(e){
          var evt = e || window.event;
          var wheelDelta = evt.wheelDelta || evt.detail;
          if(wheelDelta == -120 || wheelDelta == 3) {
             var Distances=Scrp.position().top+Distance;
             if(Distances>=Num2){
                Scrp.css("top",Num2);
                Scrll(Num2);
             }else{
                Scrll(Distances);
             }
             return false;
          }else if (wheelDelta == 120 || wheelDelta == -3){
             var Distances=Scrp.position().top-Distance;
             if(Distances<=1){
                Scrll(0);
                Scrp.css("top",1);
             }else{
                Scrll(Distances);
             }
             return false;
          }   
       }
   }
})(jQuery);


