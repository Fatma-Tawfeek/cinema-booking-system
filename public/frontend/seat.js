const container = document.querySelector(".seat-container");
const couches = document.querySelectorAll(".row i.fa-solid.fa-couch:not(.occupied)");
let total = document.getElementById("total");
let totalButton = document.getElementById("totalButton"); // Button element

let ticketPrice = 200; // Ticket price is 200 leke

function setMovieData(movieIndex, moviePrice) {
  const couchIndexArray = Array.from(document.querySelectorAll(".row i.fa-solid.fa-couch.selected")).map((couch) => {
    return [...couches].indexOf(couch);
  });
  localStorage.setItem("couchIndex", JSON.stringify(couchIndexArray));
  localStorage.setItem("selectedMovieIndex", movieIndex);
  localStorage.setItem("selectedMoviePrice", moviePrice);
}

function updateCountAndTotal() {
  let selectedCouchesCount = document.querySelectorAll(".row i.fa-solid.fa-couch.selected");
  let totalPrice = selectedCouchesCount.length * ticketPrice;
  total.innerText = totalPrice + " leke";

  // Enable/disable button based on total price
  if (totalPrice > 0) {
    totalButton.disabled = false;
  } else {
    totalButton.disabled = true;
  }

  const couchIndexArray = Array.from(selectedCouchesCount).map((couch) => {
    return [...couches].indexOf(couch);
  });
  localStorage.setItem("couchIndex", JSON.stringify(couchIndexArray));
}

function populateUI() {
  const selectedCouches = JSON.parse(localStorage.getItem("couchIndex"));

  if (selectedCouches !== null && selectedCouches.length > 0) {
    selectedCouches.forEach((index) => {
      couches[index].classList.add("selected");
    });
  }
}

container.addEventListener("click", (e) => {
  if (
    e.target.classList.contains("fa-solid") &&
    e.target.classList.contains("fa-couch") &&
    !e.target.classList.contains("occupied")
  ) {
    e.target.classList.toggle("selected");
    updateCountAndTotal();
  }
});

updateCountAndTotal();
