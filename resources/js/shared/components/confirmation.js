let confirmationMap = new Map();

function showConfirmation(confirmation) {
    confirmation.classList.remove("hidden");
}

function confirmationActionBack(confirmation) {
    confirmation.classList.add("hidden");
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
        backButton.addEventListener("click", () => {
            confirmationActionBack(confirmation);
        });
    }
}
