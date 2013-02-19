function PopUpWindow (hname, type, sz) 
{

				if (type == 'r')
				{
						if (sz == 1)
						{
								popNew = window.open(hname,"puNew","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=600,height=300"); 
						}
						else	if (sz == 2)
						{
								popNew = window.open(hname,"puNew","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=900,height=600"); 		
						}
						else	if (sz == 3)
						{
								popNew = window.open(hname,"puNew","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=400,height=600"); 		
						}
						else	if (sz == 4)
						{
								popNew = window.open(hname,"puNew","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=400,height=400"); 		
						}
						else	if (sz == 5)
						{
								popNew = window.open(hname,"puFile","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=700,height=60"); 		
						}
						else	if (sz == 6)
						{
								popNew = window.open(hname,"puFile","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=700,height=650"); 		
						}
				}	
				else if (type == 'f')
				{
						if (sz == 1)
						{
								popNew = window.open(hname,"puNew","toolbar=yes,location=yes,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=600,height=300"); 
						}
						else	if (sz == 2)
						{
								popNew = window.open(hname,"puNew","toolbar=yes,location=yes,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=900,height=600"); 		
						}	
						else	if (sz == 3)
						{
								popNew = window.open(hname,"puNew","toolbar=yes,location=yes,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=400,height=600"); 		
						}	
						else	if (sz == 4)
						{
								popNew = window.open(hname,"puNew","toolbar=yes,location=yes,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=900,height=400"); 		
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

function ShowStatusBarMsg(msg)
{
	window.status = "msg";
}
