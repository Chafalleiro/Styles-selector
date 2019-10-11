//https://stackoverflow.com/questions/21646738/convert-hex-to-rgba ******************
//	console.trace(this);
	
var eleArray = []; //Array of options
var changes = {
	isTab:'', option:'', isClass:'', eleName:'', rgbColor:'', rgbFont:'', alfaBg:'', alfaFn:'', restore:false,
	bgColor: function()
	{
		var tcolr = hexToRgbA(this.rgbColor);
		return "rgba(" + tcolr.ssR + ", " + tcolr.ssG + ", " + tcolr.ssB + ", "+ this.alfaBg/100 + ")";
	},
	fnColor: function()
	{
		var tcolr = hexToRgbA(this.rgbFont);
		return "rgba(" + tcolr.ssR + ", " + tcolr.ssG + ", " + tcolr.ssB + ", "+ this.alfaFn/100 + ")";
	}
}
	
function hexToRgbA(hex){
    var c;
    if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
        c= hex.substring(1).split('');
        if(c.length== 3){
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
//Function to convert rgb format to Hex
function rgb2hex(rgb){
 rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
 return (rgb && rgb.length === 4) ? "#" +
  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
}
//Tab navigation routine ******************
function chngtab(ctvtb,tabclass,ndx)
{
//Hide all elements with the given class.
var elems = document.getElementsByClassName(tabclass);
	for(var i = 0; i < elems.length; i++) {
    elems[i].style.display = "none";
	}
//Make all the tab markers the same.
elems = document.getElementsByClassName("nav-tab");
	for(var i = 0; i < elems.length; i++) {
    elems[i].className = "nav-tab";
	}
//Display the element selected and change the tab marker class to highlight it.
elems[ndx].className = "nav-tab nav-tab-active"; 
document.getElementById(ctvtb).style.display = "block";
//Hide button
if(ndx == 5)
{document.getElementById("submit").style.display = "none";}
else{document.getElementById("submit").style.display = "block";}
}
//Select selector option ****************
function styleSelect(ss_element)
{
	document.getElementById("select_sheet_div_" + ss_element).disabled = true;
	document.getElementById("select_sheet_sel_" + ss_element).disabled = true;
	switch(parseInt(document.getElementById("select_style_" + ss_element).value))
	{
		case 0:
			document.getElementById("select_sheet_div_" + ss_element).value = '';
			document.getElementById("select_sheet_sel_" + ss_element).value = '';
		break;
		case 1:
			document.getElementById("select_sheet_div_" + ss_element).value = 'border-radius: 10px';
			document.getElementById("select_sheet_sel_" + ss_element).value = 'border-radius: 10px';
		break;
		case 2:
			document.getElementById("select_sheet_div_" + ss_element).disabled = false;
			document.getElementById("select_sheet_sel_" + ss_element).disabled = false;
		break;
	}
	document.getElementById("shortcode_sselector_" + ss_element).style = document.getElementById("select_sheet_div_" + ss_element).value;
	document.getElementById("widget_sselector_" + ss_element).style = document.getElementById("select_sheet_sel_" + ss_element).value;
	fillForm(ss_element);
}
//Color picker routine ******************
function clickColor(ss_element,ss_which)
{
	if(ss_which == 0){
    	c = document.getElementById('bg_colorPicker_' + ss_element).value;
    	var ss_colors = hexToRgbA(c);
        document.getElementById('test_color_' + ss_element).style.backgroundColor = "rgba(" + ss_colors.ssR + ", " + ss_colors.ssG + ", " + ss_colors.ssB + ",0.6)";
    }
    else{
    	c = document.getElementById('fn_colorPicker_' + ss_element).value;
    	var ss_colors = hexToRgbA(c);        
        document.getElementById('test_color_' + ss_element).style.color = "rgba(" + ss_colors.ssR + ", " + ss_colors.ssG + ", " + ss_colors.ssB + ",0.6)";
    }
	document.getElementById('test_color_' + ss_element).innerHTML = "rgba(" + ss_colors.ssR + ", " + ss_colors.ssG + ", " + ss_colors.ssB + ",0.6)";
	fillForm(ss_element);
}
//Transparency routine ******************
function myslider(ss_slider,ss_bf) {
	if(ss_bf == 0){
    	var ss_alfa = document.getElementById('myRange_' + ss_slider).value/100.2; //If value reaches 1, then the browser deletes the alfa atribute.
		var ss_bgcolor = document.getElementById('test_color_' + ss_slider).style.backgroundColor;
		document.getElementById('test_color_' + ss_slider).style.backgroundColor = ss_bgcolor.replace(/[^,]+(?=\))/, ss_alfa);
        document.getElementById('myRange_' + ss_slider).style.backgroundColor = ss_bgcolor.replace(/[^,]+(?=\))/, ss_alfa);
    }
    else{
    	var ss_alfa = document.getElementById('myRangeFont_' + ss_slider).value/100.2; //If value reaches 1, then the browser deletes the alfa atribute.
        var ss_bgcolor = document.getElementById('test_color_' + ss_slider).style.color;
        document.getElementById('test_color_' + ss_slider).style.color = ss_bgcolor.replace(/[^,]+(?=\))/, ss_alfa);
        document.getElementById('myRangeFont_' + ss_slider).style.backgroundColor = ss_bgcolor.replace(/[^,]+(?=\))/, ss_alfa);
        }
	document.getElementById('test_color_' + ss_slider).innerHTML = "Font color: " + document.getElementById('test_color_' + ss_slider).style.color + " BG Color: " + document.getElementById('test_color_' + ss_slider).style.backgroundColor;
	fillForm(ss_slider);
}
//Fill database data routine ******************
function fillForm(ss_option)
{
	var i = 0;
    var ss_fieldTypes = ["ss_disp_head", "ss_select_style", "ss_select_sheet_div", "ss_select_sheet_sel", "ss_selected_theme", "ss_opt_name", "ss_theme_option_type","ss_element","ss_bg_colorPicker","ss_fn_colorPicker","ss_myRange","ss_myRangeFont","ss_option"];
    if (ss_option.lastIndexOf("_") === -1)
    {	
		setChecked(document.getElementById(ss_fieldTypes[0].replace("ss_", "") + "_" + ss_option), document.getElementById(ss_fieldTypes[0] + "_" + ss_option));
        for (i=1; i < 5; i++)
        {
		document.getElementById(ss_fieldTypes[i] + '_' + ss_option).value = document.getElementById(ss_fieldTypes[i].replace("ss_", "") + "_" + ss_option).value;			
			if (document.getElementById(ss_fieldTypes[i].replace("ss_", "") + "_" + ss_option).value == "2")
			{
				document.getElementById(ss_fieldTypes[2].replace("ss_", "") + "_" + ss_option).disabled = false;
				document.getElementById(ss_fieldTypes[3].replace("ss_", "") + "_" + ss_option).disabled = false;
			}
        }		
    }
    else
    {
        for (i=5; i < ss_fieldTypes.length -1; i++)
        {
	        document.getElementById(ss_fieldTypes[i] + '_' + ss_option).value = document.getElementById(ss_fieldTypes[i].replace("ss_", "") + "_" + ss_option).value;
        }
	setChecked(document.getElementById(ss_fieldTypes[i].replace("ss_", "") + "_" + ss_option),document.getElementById(ss_fieldTypes[i] + '_' + ss_option));
    }
}
//Fill temporal data routine ******************
function ss_pass_stored()
{
    var ss_fieldTypes = ["ss_disp_head", "ss_select_style", "ss_select_sheet_div", "ss_select_sheet_sel", "ss_selected_theme", "ss_opt_name", "ss_theme_option_type","ss_element","ss_bg_colorPicker","ss_fn_colorPicker","ss_myRange","ss_myRangeFont","ss_option"];
    var ss_option, i, j, k = 0;
    var ss_colors = "";
    for(i=1;i < 6;i++)
    {
        checkedVal(document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + i),document.getElementById(ss_fieldTypes[k] + "_" + i).value);
		k++;
		if (document.getElementById(ss_fieldTypes[k] + "_" + i).value == "2")
		{
			document.getElementById(ss_fieldTypes[2].replace("ss_", "") + "_" + i).disabled = false;
			document.getElementById(ss_fieldTypes[3].replace("ss_", "") + "_" + i).disabled = false;
		}
        document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + i).value = document.getElementById(ss_fieldTypes[k] + "_" + i).value;
		k++;
        document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + i).value = document.getElementById(ss_fieldTypes[k] + "_" + i).value;
		k++;
        document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + i).value = document.getElementById(ss_fieldTypes[k] + "_" + i).value;
		k++;
        document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + i).value = document.getElementById(ss_fieldTypes[k] + "_" + i).value;
        for (j=1; j < 11; j++)
        {
            for (k=5; k < ss_fieldTypes.length - 5; k++)
            {
				ss_option = i + "_" + j;
                document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + ss_option).value = document.getElementById(ss_fieldTypes[k] + '_' + ss_option).value;
            }
//Some really simple yet hard to read code that renders the style colors we saved
// Need to read more about wrappers to make a nice method for the test_color element here. Next version maybe.
            document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + ss_option).value = document.getElementById(ss_fieldTypes[k] + '_' + ss_option).value;
        	ss_colors = hexToRgbA(document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + ss_option).value);
            document.getElementById('test_color_' + ss_option).style.backgroundColor = "rgba(" + ss_colors.ssR + ", " + ss_colors.ssG + ", " + ss_colors.ssB + ",0.6)";
            k++;
            document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + ss_option).value = document.getElementById(ss_fieldTypes[k] + '_' + ss_option).value;
        	ss_colors = hexToRgbA(document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + ss_option).value);
            document.getElementById('test_color_' + ss_option).style.color = "rgba(" + ss_colors.ssR + ", " + ss_colors.ssG + ", " + ss_colors.ssB + ",0.6)";
            k++;
            document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + ss_option).value = document.getElementById(ss_fieldTypes[k] + '_' + ss_option).value;
        	var ss_alfa = document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + ss_option).value/100.2; //If value reaches 1, then the browser deletes the alfa atribute.
    		var ss_bgcolor = document.getElementById('test_color_' + ss_option).style.backgroundColor;
    		document.getElementById('test_color_' + ss_option).style.backgroundColor = ss_bgcolor.replace(/[^,]+(?=\))/, ss_alfa);
            document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + ss_option).style.backgroundColor = ss_bgcolor.replace(/[^,]+(?=\))/, ss_alfa);
        	document.getElementById('test_color_' + ss_option).innerHTML = "Font color: " + document.getElementById('test_color_' + ss_option).style.color + " BG Color: " + document.getElementById('test_color_' + ss_option).style.backgroundColor;
            k++;
            document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + ss_option).value = document.getElementById(ss_fieldTypes[k] + '_' + ss_option).value;
        	ss_alfa = document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + ss_option).value/100.2; //If value reaches 1, then the browser deletes the alfa atribute.
    		ss_bgcolor = document.getElementById('test_color_' + ss_option).style.color;
    		document.getElementById('test_color_' + ss_option).style.color = ss_bgcolor.replace(/[^,]+(?=\))/, ss_alfa);
            document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + ss_option).style.backgroundColor = ss_bgcolor.replace(/[^,]+(?=\))/, ss_alfa);
        	document.getElementById('test_color_' + ss_option).innerHTML = "Font color: " + document.getElementById('test_color_' + ss_option).style.color + " BG Color: " + document.getElementById('test_color_' + ss_option).style.backgroundColor;
            k++;
			checkedVal(document.getElementById(ss_fieldTypes[k].replace("ss_", "") + "_" + ss_option), document.getElementById(ss_fieldTypes[k] + '_' + ss_option).value);
//Seriously, this is unreadable, it's a Must TODO.
        }
        k = 0;
		styleSelect("" + i);
    }
}
//Set checked according stored vals
function checkedVal(which, val)
{
	if(val == 1)
		{which.checked = 1;}
	else
		{which.checked = 0;}
}
//Set val according checked status
function setChecked(checkedOne, valOne)
{
	if(checkedOne.checked == 1)
		{valOne.value = 1;}
	else
		{valOne.value = 0;}
}

//Selector demo options.

//Styles options

//Add new values
function addOption(a_tab, a_option,a_class,a_name,a_color,a_font,a_alfab,a_alfaf,dontcare)
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
	if(!exists && (a_name == "shortcode_sselector" || a_name == "widget_sselector"))
	{
		eleArray.push(Object.create(changes,{isTab:{value:a_tab}, option:{value:a_option}, isClass:{value:a_class}, eleName:{value:a_name},
		rgbColor:{value:a_color}, rgbFont:{value:a_font}, alfaBg:{value:a_alfab}, alfaFn:{value:a_alfaf}}));
	}
}
//Change colors
// shortcode_sselector".$ss_tab."'
//sample_sselector".$ss_tab."
function changeProps(ss_element,tab)
{
	var i,j=0;
	var wichOption = ss_element.value;
			if (wichOption == "Restore")
			{
				ss_element.style.backgroundColor = "#ffffff";
				ss_element.style.color = "#000";
				document.getElementById("shortcode_sselector_" +tab).style.backgroundColor = "#ffffff";
				document.getElementById("shortcode_sselector_" +tab).style.color = "#000";
			}

	for(i=0;i<eleArray.length;i++)
	{
		if(wichOption == eleArray[i].option)
		{
				ss_element.style.backgroundColor = eleArray[i].bgColor();
				ss_element.style.color = eleArray[i].fnColor();
				document.getElementById("shortcode_sselector_" +tab).style.backgroundColor =  eleArray[i].bgColor();
				document.getElementById("shortcode_sselector_" +tab).style.color = eleArray[i].fnColor();
		}
	}
}

//Function to extract a style property
var getStyle = function(element, property) {
    return window.getComputedStyle ? window.getComputedStyle(element, null).getPropertyValue(property) : element.style[property.replace(/-([a-z])/g, function (g) { return g[1].toUpperCase(); })];
};
