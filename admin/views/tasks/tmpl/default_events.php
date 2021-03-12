<?php defined('_JEXEC') or die; ?>

<script>
    // Task
    document.querySelectorAll("[id^='tid-']").forEach(e =>
        {
            e.addEventListener(
                "click",
                e =>
                {
                    focusTask(e.currentTarget)
                    focusTaskID(e.currentTarget.id.split('-')[1])
                },
                true
            )
        }
    )

    // Auto-save task title when user stops typing
    let timeoutID;
    document.querySelectorAll("[id^='t-t-']").forEach(e =>
        {
            e.addEventListener(
                "input",
                e =>
                {
                    clearTimeout(timeoutID);
                    timeoutID = setTimeout(() =>
                    {
                        updateTask(e.target.innerHTML)
                    }, 1000);
                },
                true
            )
        }
    )

    // Add choice click
    document.querySelectorAll("[id^='a-t-c-']").forEach(e =>
        {
            e.addEventListener(
                "click",
                () => openModal(),
                true
            )
        }
    )

    // Update task logic (or) click
    document.querySelectorAll("[id^='u-t-l-']").forEach(e =>
        {
            e.addEventListener(
                "click",
                e =>
                {
                    logicToggle(parseInt(e.currentTarget.id.split('-')[3]))
                },
                true
            )
        }
    )

    // Choice click
    document.querySelectorAll("[id^='t-cid-']").forEach(e =>
        {
            e.addEventListener(
                "click",
                e =>
                {
                    focusChoiceID(e.currentTarget.id.split('-')[3])
                    focusChoice(e.currentTarget)
                },
                true
            )
        }
    )

    // Remove choice click
    document.querySelectorAll("[id^='r-t-c-']").forEach(
        e =>
        {
            e.addEventListener("click", () => removeChoice(), true)
        }
    )

    // Modal choice click
    document.querySelectorAll("[id^='a-c-']").forEach(e =>
        {
            e.addEventListener(
                "click",
                e =>
                {
                    focusChoiceID(e.currentTarget.id.split('-')[2])
                    addChoice()
                })
        }
    )
</script>