{
    const SHOW_BOX_ROOT = document.getElementById("show-box-root");
    const SHOW_BOX_CLOSE = document.getElementById("show-box-close");
    const SHOW_BOX_DISPLAYS =
        document.getElementsByClassName("show-box-display");
    const SHOW_BOX_TRIGGERS =
        document.getElementsByClassName("show-box-trigger");
    if (SHOW_BOX_ROOT) {
        const SHOW_BOX_JSON = JSON.parse(SHOW_BOX_ROOT.dataset.showBoxJson);

        for (const showBoxTrigger of SHOW_BOX_TRIGGERS) {
            const displayData =
                SHOW_BOX_JSON[showBoxTrigger.dataset.showBoxIndex];
            showBoxTrigger.addEventListener("click", () => {
                for (const showBoxDisplay of SHOW_BOX_DISPLAYS) {
                    showBoxDisplay.textContent =
                        displayData[showBoxDisplay.dataset.showBoxDisplay];
                }
                SHOW_BOX_ROOT.classList.remove("hidden");
            });
        }

        SHOW_BOX_CLOSE.addEventListener("click", () => {
            SHOW_BOX_ROOT.classList.add("hidden");
        });
    }
}
