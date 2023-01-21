function isOverOffset(el, anchor = null, options) {
    var rect = el.getBoundingClientRect();
    if (anchor && document.documentElement.scrollTop <= anchor) return false;
    switch (options.direction) {
        case "top":
            if (rect.top <= options.offset) return true;
            return false;
        case "left":
            if (rect.left <= options.offset) return true;
            return false;
        case "right":
            if (rect.right <= options.offset) return true;
            return false;
        case "bottom":
            if (rect.bottom <= options.offset) return true;
            return false;
    }
}

export function stick(el) {
    el.style.width = el.clientWidth + "px";
    el.style.height = el.clientHeight + "px";
    el.classList.add("is-sticky");
}

export function unstick(el) {
    el.classList.remove("is-sticky");
}

export function isSticky(el, options = { direction: "top", offset: 0 }) {
    let element = el;
    let anchor = null;
    if (typeof el === "string") element = document.getElementById(el);
    element.style.setProperty(
        "--offset" + options.direction.toUpperCase(),
        options.offset + "px"
    );
    document.addEventListener("scroll", (event) => {
        if (isOverOffset(element, anchor, options)) {
            if (!anchor) anchor = document.documentElement.scrollTop;
            stick(element);
        } else {
            anchor = null;
            unstick(element);
        }
    });
}
