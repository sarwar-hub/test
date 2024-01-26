let initialPinchDistance = 0;
let initialScale = 1;
let currentScale = 1;

const zoomImage = document.getElementById('zoomImage');
const imageContainer = document.getElementById('imageContainer');

imageContainer.addEventListener('touchstart', (event) => {
  if (event.touches.length === 2) {
    initialPinchDistance = Math.hypot(
      event.touches[0].clientX - event.touches[1].clientX,
      event.touches[0].clientY - event.touches[1].clientY
    );
    initialScale = currentScale;
  }
});

imageContainer.addEventListener('touchmove', (event) => {
  if (event.touches.length === 2) {
    const currentPinchDistance = Math.hypot(
      event.touches[0].clientX - event.touches[1].clientX,
      event.touches[0].clientY - event.touches[1].clientY
    );
    const pinchDelta = currentPinchDistance - initialPinchDistance;
    currentScale = initialScale + pinchDelta * 0.01; 

    if (currentScale < 1) {
      currentScale = 1; 
    }

    zoomImage.style.transform = `scale(${currentScale})`;
  }
});
