var layerShown;
var navtimer;

function navroll (tag, state) 
{
  changeimg (tag + "nav", "/mainnav/" + tag + "-" + state + ".gif");
  var img = document.images[tag+"nav"];

  // Voodoo below
  // There is an attempt to locate the popup layers near the corresponding
  // nav button, but this depends on all sorts of astrological alignments.
  // If the structure of this page changes, the correct adjustment of the 
  // following voodoo parameters may only be achieved through the use of
  // human sacrifice - MS 07/13/01

  //alert ("platform=" + platform + "browser=" + browser);
  if (state=="over") 
  {
      var layer;
      if (browser == "netscape") {
        if (document.getElementById)
        {
            layer = document.getElementById(tag + "layer").style;
        } else {
            layer = document.layers[tag + "layer"];
        }
        if (platform == "mac") {
            layer.top=img.y - 101;
        } else {
            layer.top=img.y - 101;
        }
        layer.left=img.x + img.width - 1;
        if (do_hideform)
            hideform(0);
      } else {
          var layer = document.all[tag + "layer"].style;
          if (platform == "mac") {
              layer.pixelTop=img.offsetTop +
                  document.all["navtable"].offsetTop +
                  document.all["maintable"].offsetTop - 101;
          } else {
              layer.pixelTop=img.offsetTop +
                  document.all["navtable"].offsetTop +
                  document.all["maintable"].offsetTop - 15;
          }
          layer.pixelLeft=img.width +
              document.all["navtable"].offsetLeft +
              document.all["maintable"].offsetLeft + 9;
      }
      layer.visibility = "visible";
      layer.zindex=100;
      if (layerShown && layerShown != layer)
      {
          layerShown.visibility = "hidden";
          layer.zindex = 0;
      }
      layerShown=layer;
      if (navtimer)
      {
        clearTimeout (navtimer);
        navtimer = 0;
      }
  }
  if (state == "default")
  {
     navtimer = setTimeout ("layerout()", 5000);
  }
}

function layerout ()
{
  // alert ("layerout");
  if (layerShown)
  {
    layerShown.visibility="hidden";
    layerShown = null;
    if (browser=="netscape" && do_hideform)
      hideform(1);
    if (navtimer)
    {
      clearTimeout (navtimer);
      navtimer = 0;
    }
  }
}

// preload some rollover graphics

if (document.images)
{
  var img = new Image;
  img.src = "/mainnav/news-over.gif";
  img.src = "/mainnav/howto-over.gif";
  img.src = "/mainnav/magazinearchive-over.gif";
  img.src = "/mainnav/buyersguide-over.gif";
  img.src = "/mainnav/observing-over.gif";
  img.src = "/mainnav/resources-over.gif";
  img.src = "/mainnav/shopatsky-over.gif";
  img.src = "/mainnav/home-over.gif";
}

// standard JavaScript library for form initialization, popups, etc:

// code for doing popups
var popupCounter=0;
function destroyPopup(window_base, counter, w, h) {
	var txt = "height=" + h + ",width=" + w;
    if (counter > 0) {
        oldWin = window.open("", window_base + (counter-1), txt);
        oldWin.close();
    };
}

function createPopup(url_name, window_base, counter, w, h)
{
 var txt = "toolbar=no,location=no,menubar=no,resizable=yes,scrollbars=yes,width=";
	txt = txt + w + ",height=" + h;
    destroyPopup(window_base, counter, w, h);
    window.open(url_name, window_base + counter,txt);
}

// end of code for doing popups

function init_select (tag, value, form_index, layer)
{
  var elts = layer ? layer.document.forms[form_index].elements :
         document.forms[form_index].elements;
  var options = elts[tag].options;
  var i;
  for (i=0; i< options.length; i++)
  {
    if (options[i].value == value)
    {
      elts[tag].selectedIndex = i;
      return;
    }
  }
  elts[tag].selectedIndex = 0;
}

function init_radio (tag, value, form_index, layer)
{
  var elts = layer ? layer.document.forms[form_index].elements :
         document.forms[form_index].elements;
  var radios = elts[tag];
  var i;
  for (i=0; i< radios.length; i++)
  {
    if (radios[i].value == value)
    {
      radios[i].checked = true;
      return;
    }
  }
}

function init_checkbox (tag, value, form_index, layer)
{
  var elts = layer ? layer.document.forms[form_index].elements :
         document.forms[form_index].elements;
  var boxes = elts[tag];
  var i, j;
  var vals = value.split(", ");
  if (!boxes.length) 
  {
    // special case when only a single checkbox
    boxes.checked = (boxes.value == vals[0]);
  }
  else
  {
    for (i=0; i< boxes.length; i++)
      boxes[i].checked = false;
    for (j in vals)
    {
      for (i=0; i< boxes.length; i++)
      {
        if (boxes[i].value == vals[j])
        {
          boxes[i].checked = true;
          break;
        }
      }
    }
  }
}

//
// 4/10/01 PJ
//	added no_def param to allow the date field to NOT have a default value
//	also allow for option[0]=00 for year
//
// 4/24/01 MS
//      added start_year; if set, all years starting with start_year until    
//      next year are stuffed into the year select.  Default is last year. 
//      Q: does this work for Netscape?

function init_dates (tag, form_index, no_def, start_year, layer, end_year)
{
  var elts = layer ? layer.document.forms[form_index].elements :
         document.forms[form_index].elements;
  var dtm;
  var initNull = false;

  var allowNulls;
  if (elts[tag+"_year"].options[0].value == "00")
      allowNulls = true;
  else
      allowNulls = false;

  var now = new Date;
  if (elts[tag] && elts[tag].value != '')
  {
       var year,month,day;
       var datestring = elts[tag].value;
       year = datestring.substring(0,4);
       month = parseInt(datestring.substring(5,7),10) - 1;
       day = datestring.substring(8,10);
       //alert (datestring + ": (" + year + "," + month + "," + day + ")");

       if (isNaN(year) || isNaN(month) || isNaN (day)) {
        if (no_def == 1) {
          initNull = true;
        }
         dtm = now;
       } else {
          dtm = new Date (year, month, day);
       }
    } else {
       if (no_def)
         initNull = true;
        dtm = now;
    }
    var yy = dtm.getFullYear ();
    if (start_year == null || start_year == 0) {
        start_year = yy-1;
    }
    if (end_year == null || ! end_year)
    {
      end_year = now.getFullYear () + 1;
    }
    var sdopts = elts [tag +"_year"].options;
    if (navigator.appName == "Netscape")
    {
        // Netscape
        var init_year = 0
        if (!initNull)
        {
          var sd = new Array (dtm.getFullYear(), dtm.getMonth(), dtm.getDate());
          init_year = sd[0];
        }
        // alert ("init_dates: years=" + start_year + "," + end_year);
        if (allowNulls) 
        {
          if (start_year < 0)
          {
            for (i=end_year; i >= -start_year; i--)
            {
              sdopts[end_year-i+1] = new Option (i, i, i==init_year, i==init_year);
            }
          }
          else
          {
            for (i=start_year; i <= end_year; i++)
            {
              sdopts[i-start_year+1] = new Option (i, i, i==init_year, i==init_year);
            }
          }
        } 
        else 
        {
          if (start_year < 0)
          {
            for (i=end_year; i >= -start_year; i--)
            {
              sdopts[end_year-i] = new Option (i, i, false, false);
            }
          }
          else
          {
            for (i=start_year; i <= end_year; i++)
            {
              sdopts[i-start_year] = new Option (i, i, false, false);
            }
          }
        }
    } else {
      // Internet Explorer
      for (i=sdopts.length-1; i > 0; i--)
          sdopts.remove (i);
      if (!allowNulls)
          sdopts.remove (0);
      if (start_year < 0)
      {
          for (i=end_year; i >= -start_year; i--)
          {
            var newElem = document.createElement ("OPTION");
            newElem.text = i;
            newElem.value = i;
            sdopts.add(newElem);
          }
      }
      else
      {
          for (i=start_year; i <= end_year; i++)
          {
            var newElem = document.createElement ("OPTION");
            newElem.text = i;
            newElem.value = i;
            sdopts.add(newElem);
          }
      }
    }
    if (!initNull)
    {
      var sd = new Array (dtm.getFullYear(), dtm.getMonth(), dtm.getDate());

      if (start_year < 0) 
        elts [tag + "_year"].selectedIndex = 
          end_year - sd[0] + (allowNulls ? 1 : 0);
      else
        elts [tag + "_year"].selectedIndex = 
          sd[0] - start_year + (allowNulls ? 1 : 0);

      elts [tag + "_month"].selectedIndex = sd[1] +
         ((elts[tag+"_month"].options[0].value == "00") ? 1 : 0);
      if (elts [tag + "_day"])
        elts [tag + "_day"].selectedIndex = sd[2]-1 + 
           ((elts[tag+"_day"].options[0].value == "00") ? 1 : 0);
    } else {
      elts [tag + "_year"].selectedIndex = 0;
      elts [tag + "_month"].selectedIndex = 0;
      if (elts [tag + "_day"])
        elts [tag + "_day"].selectedIndex = 0;
    }

    on_date(tag, form_index, layer);
}

function on_date (tag, form_index, layer)
{
    var elts = layer ? layer.document.forms[form_index].elements :
         document.forms[form_index].elements;
    var days = elts[tag+"_day"];
    if (days) 
        days = days.options;
    else
        return;

    var allowNulls;
    if (elts[tag+"_month"].options[0].value == "00")
        allowNulls = true;
    else
        allowNulls = false;
    var mm = elts[tag+"_month"].selectedIndex;
    if (mm < 0)
      return;
    var ndays;
    if (allowNulls)
        --mm;
    if (mm == 1) {
      // deal with year that could be either a select or a text input
      var type = elts[tag+"_year"].type;
      var is_select =  (type == "text") ? false : true;
      var yy =  is_select ? elts[tag+"_year"].selectedIndex
        : elts[tag+"_year"].value;
      //      alert ("is_select=" + is_select + ", yy=" + yy + ", type=" + elts[tag+"_year"].type)
      if (yy >= 0) {
        yy = parseInt (is_select ? elts[tag+"_year"].options[yy].value : yy);
        if (yy % 4 == 0 && (yy % 100 != 0 || yy % 400 == 0))
          ndays = 29;
        else
          ndays = 28;
      } else {
        ndays = 28;
      }
    } else {
      ndays = (new Array (31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31))[mm];
    }
    for (i = days.length; i <= ndays + (allowNulls ? 1 : 0); i++) 
    {
      var daynum = i + (allowNulls ? 0 : 1);
      if (navigator.appName == "Netscape")
      {
        days[i] = new Option (daynum, daynum, false, false);
      } else {
        var newElem = document.createElement ("OPTION");
        newElem.text = daynum;
        newElem.value = daynum;
        days.add(newElem);
      }
    }
    while (days.length > ndays + (allowNulls ? 1 : 0)) {
      if (navigator.appName == "Netscape")
      {
        days[days.length-1] = null;
      } else {
        days.remove (days.length-1);
      }
    }
}



function submit_date(tag, form_index, layer)
{
  var elts = layer ? layer.document.forms[form_index].elements :
         document.forms[form_index].elements;

  // deal with year that could be either a select or a text input
  var type = elts[tag+"_year"].type;
  var is_select =  (type == "text") ? false : true;
  var yy =  is_select ? 
          elts[tag + "_year"].options[elts[tag + "_year"].selectedIndex].value
        : elts[tag+"_year"].value;
  // insert date value in hidden field
  if ((!elts[tag + "_day"] ||
        elts[tag + "_day"].options[elts[tag + "_day"].selectedIndex].value == "00")
       && elts[tag + "_month"].options[elts[tag + "_month"].selectedIndex].value == "00"
       && yy == "00")
  {
    elts[tag].value = "NULL";
    return;
  }

  elts[tag].value = 
    yy + "-" +
    elts[tag + "_month"].options[elts[tag + "_month"].selectedIndex].value +
    "-";
  if (elts[tag + "_day"] && elts[tag + "_day"].options)
      elts[tag].value += elts[tag + "_day"].options[elts[tag + "_day"].selectedIndex].text;
  else
      elts[tag].value += "01";
}

function changeimg(name, img) 
{
  if (document.images) document.images[name].src=img;
} 

function submitform(formtag, eltname, eltval, layer)
{
  var frm = layer ? layer.document.forms[formtag] : document.forms[formtag];
  if (!frm) { alert ("no form named " + formtag); }
  frm.elements[eltname].value = eltval;
  if (!frm.onsubmit || frm.onsubmit())
  {
    frm.submit();
  }
}

function openLargeImage(img_url, height, width)
{
    window.open("/largeimage.asp?img_url=" + img_url, "_largeimage", "width=" + width + ",height=" + height + ",resizable=yes,scrollbars=yes,toobar=no,menubar=no");
}
