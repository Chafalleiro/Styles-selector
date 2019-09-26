var eleArray = []; //Array of options

function hexToRgbA(hex)
{
	var c;
	if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex))
	{
		c= hex.substring(1).split('');
		if(c.length== 3)
		{
			c= [c[0], c[0], c[1], c[1], c[2], c[2]];
		}
		c= '0x'+c.join('');
		return {
			ssR: (c>>16)&255,
			ssG: (c>>8)&255,
			ssB: c&255,
	    };

	}
	throw new Error('Bad Hex');
}
//Styles options
var changes = {
	option: '', isClass:'', eleName:'', rgbColor:'', rgbFont:'', alfaBg:'', alfaFn:'', restore:false,
	bgColor: function()
	{
		var tcolr = hexToRgbA(this.rgbColor);
		return "rgba(" + tcolr.ssR + ", " + tcolr.ssG + ", " + tcolr.ssB + ","+ this.alfaBg+ ")";
	},
	fnColor: function()
	{
		var tcolr = hexToRgbA(this.rgbFont);
		return "rgba(" + tcolr.ssR + ", " + tcolr.ssG + ", " + tcolr.ssB + ","+ this.alfaFn+ ")";
	}
}
//Add new values
function addOption(a_option,a_class,a_name,a_color,a_font,a_alfab,a_alfaf,dontcare)
{
	var exists = false;
	var j,k=0;
	for (k=0;k < eleArray.length;k++)//Check if entry already exists
	{
		if(eleArray[k].eleName == a_name && eleArray[k].option == a_option)
		{
		exists = true;
		}
	}
	if(!exists)
	{
		eleArray.push(Object.create(changes,{option:{value:a_option}, isClass:{value:a_class}, eleName:{value:a_name},
		rgbColor:{value:a_color}, rgbFont:{value:a_font}, alfaBg:{value:a_alfab}, alfaFn:{value:a_alfaf}}));
	}
}
//Change colors
function changeProps(wichOption)
{
	var i,j=0;
	for(i=0;i<eleArray.length;i++)
	{
		if(wichOption == eleArray[i].option)
		{
			if(eleArray[i].isClass == 0)
			{
				var x = document.getElementsByClassName(eleArray[i].eleName);
				for (j = 0; j < x.length; j++)
				{
					if (eleArray[i].option == "Restore")
					{
						x[j].style.backgroundColor = eleArray[i].rgbColor;
						x[j].style.color = eleArray[i].rgbFont;
					}
					else
					{
						x[j].style.backgroundColor = eleArray[i].bgColor();
						x[j].style.color = eleArray[i].fnColor();
					}
				}
			}
			else
			{
				if (eleArray[i].option == "Restore")
				{
					document.getElementById(eleArray[i].eleName).style.backgroundColor = eleArray[i].rgbColor;
					document.getElementById(eleArray[i].eleName).style.color = eleArray[i].rgbFont;
				}
				else
				{
					document.getElementById(eleArray[i].eleName).style.backgroundColor = eleArray[i].bgColor();
					document.getElementById(eleArray[i].eleName).style.color = eleArray[i].fnColor();
				}
			}
		}
	}
	setCookie("ss_Option",wichOption,365);
}
//Save previous values
function saveValues(i)
{
	var exists = false;
	var j,k=0;
	var s_bgcolor,s_fncolor = "";
	for (k;k < eleArray.length;k++)//Check if entry already exists.
	{
		if(eleArray[k].eleName == eleArray[i].eleName && eleArray[k].restore != false)
		{
		exists = true;
		}
	}
	
	if(!exists)
	{
		if(eleArray[i].isClass == 0)
		{
			var x = document.getElementsByClassName(eleArray[i].eleName);
			for (j = 0; j < x.length; j++)
			{
				s_bgcolor = getStyle(x[j], "background-color"); //Since every browser puts this info in their own way is faster to just store it
				s_fncolor = getStyle(x[j], "color");
			}
		}
		else
		{	
			s_bgcolor = getStyle(document.getElementById(eleArray[i].eleName), "background-color");
			s_fncolor = getStyle(document.getElementById(eleArray[i].eleName), "color");
		}
		eleArray.push(Object.create(changes,{option:{value:'Restore'}, isClass:{value:eleArray[i].isClass}, eleName:{value:eleArray[i].eleName},
		rgbColor:{value:s_bgcolor}, rgbFont:{value:s_fncolor}, alfaBg:{value:''}, alfaFn:{value:''},restore:{value:true}}));
	}
}
//Function to extract a style property
var getStyle = function(element, property) {
    return window.getComputedStyle ? window.getComputedStyle(element, null).getPropertyValue(property) : element.style[property.replace(/-([a-z])/g, function (g) { return g[1].toUpperCase(); })];
};
//Function to convert rgb format to Hex
function rgb2hex(rgb){
 rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
 return (rgb && rgb.length === 4) ? "#" +
  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
}
//Cookies functions. From w3c schools
function setCookie(cname,cvalue,exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires=" + d.toGMTString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie() {
  var option=getCookie("ss_Option");
  if (option != "") {
	  changeProps(option);
  }
}
