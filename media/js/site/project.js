function openModal(projectID)
{
    // Get the modal
    let modal = document.getElementById("clientModal")
    modal.style.display = "block"

    // Get the <span> element that closes the modal
    let span = document.getElementById("cmClose")

    // When the user clicks on <span> (x), close the modal
    span.onclick = () => modal.style.display = "none"

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = (event) =>
    {
        if (event.target === modal)
        {
            modal.style.display = "none"
        }
    }
}

function submitProjectForm(task)
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