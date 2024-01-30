// popular tags slider open

const tagsBoxS = document.querySelector(".bppm-tags-slider-wrapper .tags-box"),
        allTagsS = tagsBoxS.querySelectorAll(".bppm-tags-slider-wrapper .tag"),
        arrowIconsTagS = document.querySelectorAll(".bppm-tags-slider-wrapper .icon i");

    let isDraggingS = false;

    const handleIconsTagS = (scrollVal) => {
        let maxScrollableWidthS = tagsBoxS.scrollWidth - tagsBoxS.clientWidth;
        arrowIconsTagS[0].parentElement.style.display = scrollVal <= 0 ? "none" : "flex";
        arrowIconsTagS[1].parentElement.style.display = maxScrollableWidthS - scrollVal <= 1 ? "none" : "flex";
    }

    arrowIconsTagS.forEach(icon => {
        icon.addEventListener("click", () => {
            // if clicked icon is left, reduce 350 from tagsBoxS scrollLeft else add
            let scrollWidth = tagsBoxS.scrollLeft += icon.id === "left" ? -340 : 340;
            handleIconsTagS(scrollWidth);
        });
    });

    const draggingS = (e) => {
        if (!isDraggingS) return;
        tagsBoxS.classList.add("dragging");
        tagsBoxS.scrollLeft -= e.movementX;
        handleIconsTagS(tagsBoxS.scrollLeft)
    }

    const dragStopS = () => {
        isDraggingS = false;
        tagsBoxS.classList.remove("dragging");
    }

    tagsBoxS.addEventListener("mousedown", () => isDraggingS = true);
    tagsBoxS.addEventListener("mousemove", draggingS);
    document.addEventListener("mouseup", dragStopS);

// popular tags slider closed























// listing tags slider open

const listingTagsBox = document.querySelector(".bppm-listing-tags-slider-wrapper .listing-tags-box"),
        allListingTags = listingTagsBox.querySelectorAll(".bppm-listing-tags-slider-wrapper .listing-tag"),
        arrowIconsListingTag = document.querySelectorAll(".bppm-listing-tags-slider-wrapper .icon i");

    let isDraggingLT = false;

    const handleIconsListingTag = (scrollVal) => {
        let maxScrollableWidthLT = listingTagsBox.scrollWidth - listingTagsBox.clientWidth;
        arrowIconsListingTag[0].parentElement.style.display = scrollVal <= 0 ? "none" : "flex";
        arrowIconsListingTag[1].parentElement.style.display = maxScrollableWidthLT - scrollVal <= 1 ? "none" : "flex";
    }

    arrowIconsListingTag.forEach(icon => {
        icon.addEventListener("click", () => {
            // if clicked icon is left, reduce 350 from listingTagsBox scrollLeft else add
            let scrollWidthLT = listingTagsBox.scrollLeft += icon.id === "left" ? -340 : 340;
            handleIconsListingTag(scrollWidthLT);
        });
    });

    const draggingLT = (e) => {
        if (!isDraggingLT) return;
        listingTagsBox.classList.add("dragging");
        listingTagsBox.scrollLeft -= e.movementX;
        handleIconsListingTag(listingTagsBox.scrollLeft)
    }

    const dragStopLT = () => {
        isDraggingLT = false;
        listingTagsBox.classList.remove("dragging");
    }

    listingTagsBox.addEventListener("mousedown", () => isDraggingLT = true);
    listingTagsBox.addEventListener("mousemove", draggingLT);
    document.addEventListener("mouseup", dragStopLT);


// listing tags slider closed

