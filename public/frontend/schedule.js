const dateButtons = document.querySelectorAll(".date-button");
const dateCards = document.querySelectorAll(".date-card");
const showtimeLinks = document.querySelectorAll(".showtime-link");
const showtimeContents = document.querySelectorAll(".showtime-content");
const venueContainers = document.querySelectorAll(".venue-container");
const venueNames = document.querySelectorAll(".venue-name");
const showtimesContainers = document.querySelectorAll(".showtimes-container");
const datesContainers = document.querySelectorAll(".dates-container");
const dates = document.querySelectorAll(".date-card");
const showtimes = document.querySelectorAll(".showtime");
const showtimeButtons = document.querySelectorAll(".showtime-button");

dateButtons.forEach((button, index) => {
    button?.addEventListener("click", () => {
        dateCards.forEach((dateCard) => {
            dateCard.classList.remove("active");
        });
        dateCards[index].classList.add("active");
        showtimesContainers.forEach((showtimesContainer) => {
            showtimesContainer.classList.remove("active");
        });
        showtimesContainers[index].classList.add("active");
    });
});
