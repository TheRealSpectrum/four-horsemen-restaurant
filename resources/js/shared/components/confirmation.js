let confirmationMap = new Map();

function showConfirmation(confirmation) {
    confirmation.classList.remove("hidden");
}

function confirmationActionBack(confirmation) {
    confirmation.classList.add("hidden");
}

function confirmationActionContinue(confirmation) {
    confirmation.classList.add("hidden");
    document.getElementById(confirmation.dataset.formId).submit();
}

export function confirm(confirmationId) {
    if (!confirmationMap.has(confirmationId)) {
        return;
    }

    let confirmation = confirmationMap.get(confirmationId);
    showConfirmation(confirmation);
}

{
    const CONFIRMATIONS = document.getElementsByClassName("confirmation");
    const CONFIRMATION_TRIGGERS = document.getElementsByClassName(
        "confirmation-trigger"
    );

    for (const confirmation of CONFIRMATIONS) {
        if (confirmation.dataset.instantTrigger === "1") {
            setTimeout(() => {
                showConfirmation(confirmation);
            }, 500);
        }

        confirmationMap.set(confirmation.id, confirmation);

        const backButton = document.querySelector(
            `#${confirmation.id} .confirmation-back`
        );
        const continueButton = document.querySelector(
            `#${confirmation.id} .confirmation-continue`
        );

        backButton.addEventListener("click", () => {
            confirmationActionBack(confirmation);
        });
        continueButton.addEventListener("click", () => {
            confirmationActionContinue(confirmation);
        });
    }

    for (const trigger of CONFIRMATION_TRIGGERS) {
        if (!confirmationMap.has(trigger.dataset.confirmationId)) {
            continue;
        }

        trigger.addEventListener("click", () => {
            showConfirmation(
                confirmationMap.get(trigger.dataset.confirmationId)
            );
        });
    }
}
