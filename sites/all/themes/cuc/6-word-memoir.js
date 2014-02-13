/**
 * @author mhugos
 */
/* SMITH CUSTOM FUNCS */
function wordcount( limit, id, e) {
	var el = document.getElementById( id); 	/* Get element name*/
	var val = el.value;											/* Get element value*/
	val.replace(/\s+/," ");									/* replace ???*/
	var words = val.split(" ");							/* split string of words into an array */
	var wc = words.length;									/* get number of elements in array */
	
	var keynum;
	var keychar;
	var numcheck;
	
	if(window.event) // IE
	{
		keynum = e.keyCode;
	}
	else if (e.which) // Netscape/Firefox/Opera
	{
		keynum = e.which;
	}
	if (keynum == 8)  /* backspace*/
	{
		if (words[words.length-1] == "")
			wc = words.length - 1;
		
	}

	/** If there are too many words, don't allow any more to be written by rewriting contents of textarea field with the limit  */
	var str = '';														/* initialize var to empty */
	if (wc > limit) 												/* if word count is greater than limit... */
	{																				 
		for (i = 0; i < limit; i++)						/* ...then loop thru words array until limit is reached (e.g. if limit = 6, get first 6 words)*/ 
		{
			str = str + words[i];								/* ...and string each word into a string variable */
			if (i < (limit - 1)) 								
			{																		/*  if not the last word... */
				str =  str + " ";									/* ...add a space */
			}
		}
		wc = limit;														/* set word count to the limit */
		el.value = str + " ";									/* set the value of the form element to the new words string */
	}
	
	var wcel;
	if (wcel = document.getElementById( 'word_count')) /* get word count element and replace its value to the new word count */
	{
		wcel.innerHTML = wc;
	}
}