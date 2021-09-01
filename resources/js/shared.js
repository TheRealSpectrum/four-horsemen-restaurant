import "./reservations/dynamicShowBox";
import { notify } from "./shared/components/notifier";
import { confirm } from "./shared/components/confirmation";

window.shared = {};
window.shared.notify = notify;
window.shared.confirm = confirm;
