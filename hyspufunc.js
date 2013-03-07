function PopUpWindow (hname, type, sz) 
{

				if (type == 'r')
				{
						if (sz == 0)
						{
								popup = window.open(hname,"puExt","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=600,height=300"); 
						}
						else    if (sz == 1)
						{
								popup = window.open(hname,"puExt","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=600,height=300"); 
						}
						else	if (sz == 2)
						{
								popup = parent.window.open(hname,"puExt","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=900,height=600"); 		
						}
						else	if (sz == 3)
						{
								popup = window.open(hname,"puExt","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=400,height=600"); 		
						}
				}	
				else if (type == 'f')
				{
						if (sz == 1)
						{
								popup = window.open(hname,"puExt","toolbar=yes,location=yes,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=600,height=300"); 
						}
						else	if (sz == 2)
						{
								popup = window.open(hname,"puExt","toolbar=yes,location=yes,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=900,height=600"); 		
						}		
				}	
				
				return false;
}

function printDoc()
{

	if (self.print)
		self.print();
	else
		alert("Your browser does not support this feature.");
	
		
}