Joomla.submitbutton = function(task)
{
	if (task === '')
	{
		return false;
	}
	else
	{
		let isValid = true;
		let action = task.split('.');
		if (action[1] !== 'cancel' && action[1] !== 'close')
		{
			let forms = jQuery('form.form-validate');
			for (let i = 0; i < forms.length; i++)
			{
				if (!document.formvalidator.isValid(forms[i]))
				{
					isValid = false;
					break;
				}
			}
		}
	
		if (isValid)
		{
			Joomla.submitform(task);
			return true;
		}
		else
		{
			alert(Joomla.JText._('Error, not accepted', /*'COM_HELLOWORLD_HELLOWORLD_ERROR_UNACCEPTABLE',*/ 'Some values are unacceptable'));
			return false;
		}
	}
}