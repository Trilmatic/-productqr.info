function isOverOffset(el, anchor = null, options) {
    var rect = el.getBoundingClientRect();
    if (anchor && document.documentElement.scrollTop <= anchor) return false;
    switch (options.direction) {
        case "top":
            if (rect.top <= options.offset) return true;
        case "left":
            if (rect.left <= options.offset) return true;
        case "right":
            if (rect.right <= options.offset) return true;
        case "bottom":
            if (rect.bottom <= options.offset) return true;
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

export function isSticky(
    el,
    options = { direction: "top", offset: 0, viewport: 0 }
) {
    const vw = Math.max(
        document.documentElement.clientWidth || 0,
        window.innerWidth || 0
    );
    if (vw < options.viewport) return;
    let element = el;
    let anchor = null;
    if (typeof el === "string") element = document.getElementById(el);
    if (!element) {
        console.error("not an valid element or id");
        return;
    }
    element.style.setProperty(
        "--offset" + options.direction.toUpperCase(),
        options.offset + "px"
    );
    if (isOverOffset(element, anchor, options)) {
        if (!anchor) anchor = document.documentElement.scrollTop;
        stick(element);
    } else {
        anchor = null;
        unstick(element);
    }
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
