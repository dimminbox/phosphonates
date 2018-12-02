function setLanguage()
{
  languageElement = document.getElementById('newLanguage').value;
  newURI = self.location.protocol + '//' + self.location.host + self.location.pathname + '?mode=login&newLanguage=' + languageElement;

  location.href = newURI;
}


function checkInputValue( iv, defVal )
{
  if ( iv.value == defVal )
  {
    iv.value = '';
  }
}


function checkInputValueOut( iv, defVal )
{
  if ( iv.value == '' )
  {
    iv.value = defVal;
  }
}


function checkInputPassValue( iv, defVal )
{
  if ( iv.value == defVal )
  {
    iv.value = '';
    iv.type = 'password';
  }
}


function checkInputPassValueOut( iv, defVal )
{
  if ( iv.value == '' )
  {
    iv.type = 'text';
    iv.value = defVal;
  }
}


function showCal( name, cal_names )
{
  var skip = false;
  
  element = document.getElementById(name);
  
  if ( element.style.display == 'block' )
  {
    skip = true;
  }
  
  for ( var x = 0; x < cal_names.length; x++ )
  {
    document.getElementById(cal_names[x]+'cal').style.display = 'none';
  }
  
  if ( skip == false )
  {
    document.getElementById(name).style.display = 'block';
  }
}


function setFocus( field  )
{
  var command = 'document.' + field + '.focus();';
  eval(command);
}


function setErrorPatched( field, count )
{
  var newImgPath = bp + 'media/msg/';
  
  for ( var x = 1; x <= count; x++ )
  {
    document.getElementById( field + x ).src = newImgPath + document.getElementById( field + x ).alt + '_done.gif';
  }
}


function jslink( link )
{
  window.location.href = link;
}


function resize()
{
  var width  = 0;
  var height = 0;

  if (window.innerWidth)
  {
    width = window.innerWidth;
  }
  else if (document.body && document.body.offsetWidth)
  {
    width = document.body.offsetWidth;
  }


  if ( window.innerHeight )
  {
    height = window.innerHeight;
  }
  else if ( document.body && document.body.offsetHeight )
  {
    height = document.body.offsetHeight;
  }

  if ( width < 702 )
  {
    document.getElementById('splash_holder_3').style.left   = '0px';
    document.getElementById('splash_holder_3').style.margin = '5px';
  }
  else
  {
    document.getElementById('splash_holder_3').style.left       = '50%';
    document.getElementById('splash_holder_3').style.marginLeft = '-351px';
  }

  if ( height < 469 )
  {
    document.getElementById('splash_holder_3').style.top       = '0px';
    document.getElementById('splash_holder_3').style.marginTop = '5px';
  }
  else
  {
    document.getElementById('splash_holder_3').style.top       = '50%';
    document.getElementById('splash_holder_3').style.marginTop = '-234px';
  }
}


function resizeMain()
{
  var width  = 0;
  var height = 0;

  if (window.innerWidth)
  {
    width = window.innerWidth;
  }
  else if (document.body && document.body.offsetWidth)
  {
    width = document.body.offsetWidth;
  }


  if ( window.innerHeight )
  {
    height = window.innerHeight;
  }
  else if ( document.body && document.body.offsetHeight )
  {
    height = document.body.offsetHeight;
  }

  if ( width < 900 )
  {
    document.getElementById('mainpage_holder').style.marginLeft = '60px';
    document.getElementById('bg_holder').style.backgroundPosition = '-889px 0';
  }
  else
  {
    document.getElementById('mainpage_holder').style.margin = 'auto';
    document.getElementById('bg_holder').style.backgroundPosition = 'top center';
  }
}


function PopUp(link)
{
	fenster = window.open(link,"vert_detail","width=400,height=500,scrollbars=yes");
	fenster.focus();
}


function PopUp1(type, name)
{
	var sel = document.getElementById('land').value;
	
	if ( type != null )
	{
	  var addType = '&typ='+type;
	}
	else
	{
	  var addType = '';
	}
	
	if ( sel != '' )
	{
  	fenster = window.open(name+'/6.html?land='+sel+addType,"vert_detail","width=400,height=500,scrollbars=yes");
  	fenster.focus();
	}
}


function PopUp2(link)
{
	fenster2 = window.open(link,"prod_download","width=500,height=400,scrollbars=yes,resizable= yes");
	fenster2.focus();
}


function PopUp3(link, id)
{
  var sel = document.getElementById(id).value;
  if ( sel != '' )
  {
  	fenster2 = window.open(link+sel,"prod_download","width=500,height=400,scrollbars=yes,resizable= yes");
  	fenster2.focus();
  }
}


function setFilter( type, id, alpha )
{
  var sel = document.getElementById(id).value;
  
  new Ajax.Updater('produkte', '7.html', {evalScripts:true, parameters:'typ='+type+'&filter='+sel+'&alpha='+alpha});
}


function checkInputValue( iv, defVal )
{
  if ( iv.value == defVal )
  {
    iv.value = '';
  }
}


function checkInputValueOut( iv, defVal )
{
  if ( iv.value == '' )
  {
    iv.value = defVal;
  }
}


function viewLink( link, target )
{
  if ( target != '' )
  {
    window.open( link, target );
  }
  else
  {
    window.location.href = link;
  }
}


function showReps( link )
{
  $.nyroModalManual({
    url: link
  });

}