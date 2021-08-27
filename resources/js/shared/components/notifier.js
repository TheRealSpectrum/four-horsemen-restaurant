let notifierMap = new Map();

function moveNotifier(notifier) {
    notifier.style.transform = "none";
    setTimeout(() => {
        notifier.style.removeProperty("transform");
    }, 3000);
}

export function notify(notifyId) {
    if (!notifierMap.has(notifyId)) {
        return;
    }

    let notifier = notifierMap.get(notifyId);
    moveNotifier(notifier);
}

{
    const NOTIFIERS = document.getElementsByClassName("notifier");

    for (const notifier of NOTIFIERS) {
        if (notifier.dataset.instantTrigger === "1") {
            setTimeout(() => {
                moveNotifier(notifier);
            }, 400);
        }

        notifierMap.set(notifier.id, notifier);
    }
}
