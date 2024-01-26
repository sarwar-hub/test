
// tags slider open

const tagsBox = document.querySelector(".bppm-tags-slider-wrapper .tags-box"),
        allTags = tagsBox.querySelectorAll(".bppm-tags-slider-wrapper .tag"),
        arrowIconsTag = document.querySelectorAll(".bppm-tags-slider-wrapper .icon i");

    let isDragging = false;

    const handleIconsTag = (scrollVal) => {
        let maxScrollableWidth = tagsBox.scrollWidth - tagsBox.clientWidth;
        arrowIconsTag[0].parentElement.style.display = scrollVal <= 0 ? "none" : "flex";
        arrowIconsTag[1].parentElement.style.display = maxScrollableWidth - scrollVal <= 1 ? "none" : "flex";
    }

    arrowIconsTag.forEach(icon => {
        icon.addEventListener("click", () => {
            // if clicked icon is left, reduce 350 from tagsBox scrollLeft else add
            let scrollWidth = tagsBox.scrollLeft += icon.id === "left" ? -340 : 340;
            handleIconsTag(scrollWidth);
        });
    });

    const dragging = (e) => {
        if (!isDragging) return;
        tagsBox.classList.add("dragging");
        tagsBox.scrollLeft -= e.movementX;
        handleIconsTag(tagsBox.scrollLeft)
    }

    const dragStop = () => {
        isDragging = false;
        tagsBox.classList.remove("dragging");
    }

    tagsBox.addEventListener("mousedown", () => isDragging = true);
    tagsBox.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);

// tags slider closed